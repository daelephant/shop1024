<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 15:17
 */
namespace Back\Controller;
use Think\Controller;
use Think\Model;

class GoodsController extends Controller{
//    列表展示
    public function showlist(){
        $goods = new \Model\GoodsModel();
        $nowinfo = $goods->fetchData();
        $info = $nowinfo['pageinfo'];//当前页数据信息
        $pagelist = $nowinfo['pagelist'];//页码列表信息


        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }
    //    添加商品
    public function tianjia(){
//        $goods = D('Goods');//实例化父类Model对象
        //弄不清楚就打印出来，看看是谁的对象dump($goods);
        $goods = new \Model\GoodsModel();//实例化GoodsModel对象
        //两个逻辑：展示，收集
        if(IS_POST){//收集表单
            $data = $goods->create();
            //htmlpurifier过滤
            $data['goods_introduce'] = \fanXSS($_POST['goods_introduce']);
            if($goods->add($data)){
                $this->success('添加商品成功',U('showlist'),2);//页面跳转
            }else{
                $this->error('添加商品失败',U('tianjia'),2);//页面跳转
            }
        }else{//展示表单
            $this->display();
        }

    }
    //    修改商品
    public function upd(){
        //两个逻辑：展示，收集
        $goods = new \Model\GoodsModel();//使用new的好处：本身自己定义的方法可以调用，父类的好的方法也可以调用，D（） M（）只能调用父类方法
        if($_POST){
            $data = $goods->create();//收集数据
            if($goods->save($data)){
                $this->success('修改成功',U('showlist'),2);
            }else{
                $this->error('修改失败',U('upd',array('goods_id'=>$data['goods_id'])),2);
            }
        }else {
            $goods_id = I('get.goods_id');// 相当于 $_GET['goods_id']
            $info = $goods->find($goods_id);//查询被修改的商品信息

            /*获取相册信息，在另外一张表里*/
            $picsinfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();
            if(!empty($picsinfo)){
                $this->assign('picsinfo',$picsinfo);
            }

            $this->assign('info', $info);

            $this->display();
        }
    }
    //删除单个相册图片
    function delPics(){
        $pics_id = I('get.pics_id');
        //1查询图片并删除[物理删除]
        $info = D('GoodsPics')->find($pics_id);
        unlink($info['pics_big']);
        unlink($info['pics_small']);

        //2删除数据记录信息
        $z = D('GoodsPics')->delete($pics_id);
        if($z){
            echo "删除成功";
        }
    }

    //删除商品（逻辑方式删除商品就是修改标志位）
    function delGoods(){
        $goods_id = I('get.goods_id');//get方式获得商品的id信息
        $goods = D('Goods');
        $z = $goods->setField(array('goods_id'=>$goods_id,'is_del'=>'删除'));
        //setField()内部有调用save()方法
        if($z){
            echo json_encode(array('status'=>1));//ok
        }else{
            echo json_encode(array('status'=>2));//fail
        }
    }


}