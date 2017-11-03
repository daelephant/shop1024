<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 15:17
 */
namespace Back\Controller;
use Think\Controller;
class GoodsController extends Controller{
//    列表展示
    public function showlist(){
        $goods = new \Model\GoodsModel();
        //$info = $goods->select();
        $nowinfo = $goods -> fetchData();

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
        $this->display();
    }

}