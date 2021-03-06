<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 15:17
 */
namespace Back\Controller;
use Common\Tools\BackController;
use Think\Model;

class GoodsController extends BackController{
    //    列表展示
    public function showlist(){
        $goods = new \Model\GoodsModel();
        $nowinfo = $goods->fetchData();
        //var_dump($nowinfo);exit();
        $info = $nowinfo['pageinfo'];//当前页数据信息
        $pagelist = $nowinfo['pagelist'];//页码列表信息



        //设置面包屑导航
        $bread = array(
            'first' => '商品管理',
            'second' => '商品列表',
            'linkTo' => array(
              '【添加商品】',U('Goods/tianjia')
            ),
        );

        $this->assign('bread',$bread);

        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }
    //    添加商品,显示和处理表单
    public function tianjia(){
        //$goods = D('Goods');//实例化父类Model对象
        //弄不清楚就打印出来，看看是谁的对象dump($goods);
        $goods = new \Model\GoodsModel();//实例化GoodsModel对象
        //两个逻辑：展示，收集、判断用户是否提交了表单
        if(IS_POST){//收集表单
            //var_dump($_FILES['goods_logo']['error']);exit;
           //dump($_POST);exit;
            /**  CREATE放法：a：接受数据并保存到模型中 b、根据模型定义的规则验证表单
             *第一个参数：要接收的数据默认是$_POST
             * 第二个参数是：表单的类型、当前是添加还是修改的表单。1：添加，2：修改
             * $_POST:表单中原始的数据，I（'POST.'）
             */
            if($data = $goods->create(I('post.'),1)){

                //htmlpurifier过滤
                //$data['goods_introduce'] = \fanXSS($_POST['goods_introduce']);
                //插入到数据库中
                if($goods->add($data)){//在add()里面先调用了_before_insert方法
                    $this->success('添加商品成功',U('showlist'),1);//页面跳转
                }else{
                    $error = $goods->getError();
                    $this->error($error.'添加商品失败',U('tianjia'),2);//页面跳转
                }
            }
            //
            $error = $goods->getError();
            $this->error($error);
        }else{//展示表单
            /********获得商品展示信息*/
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);
            /********获得商品展示信息*/

            /********获得分类并传递显示*/
            $catinfo = D('Category')->order('cat_path')->select();
            $this->assign('catinfo',$catinfo);
            /********获得分类并传递显示*/

            /********取出品牌************/
            //取出所有品牌
            //方法一
            //$brandModel1 = D('Brand'); TP自带D方法
            //方法二  原生写php代码 相对路径
            $brandModel = new \Back\Model\BrandModel();
            $brandData = $brandModel->select();
            $this->assign('brandData',$brandData);
            /********取出品牌************/

            //设置面包屑导航
            $bread = array(
                'first' => '商品管理',
                'second' => '商品添加',
                'linkTo' => array(
                    '【返回】',U('Goods/showlist')
                ),
            );

            $this->assign('bread',$bread);
            $this->display();
        }

    }
    //    修改商品
    public function upd(){
        //两个逻辑：展示，收集
        $goods = new \Model\GoodsModel();//使用new的好处：本身自己定义的方法可以调用，父类的好的方法也可以调用，D（） M（）只能调用父类方法
        if($_POST){
            if($goods->create(I('post.'),2)){
                if(FALSE !== $goods->save()){
                //    save()的返回值是，如果失败返回false，如果成功返回受影响的条数，【如果修改后和修改前相同返回0】
                    $this->success('修改成功',U('showlist'));
                    exit;
                }
            }
            $error = $goods->getError();
            $this->error($error);
            /*
            $data = $goods->create();//收集数据
            if($goods->save($data)){
                $this->success('修改成功',U('showlist'),2);
            }else{
                $this->error('修改失败',U('upd',array('goods_id'=>$data['goods_id'])),2);
            }*/

        }else {
            $goods_id = I('get.goods_id');// 相当于 $_GET['goods_id']
            $info = $goods->find($goods_id);//查询被修改的商品信息

            /*获取相册信息，在另外一张表里*/
            $picsinfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();
            if(!empty($picsinfo)){
                $this->assign('picsinfo',$picsinfo);
            }
            /********获得商品展示信息*/
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);
            /********获得商品展示信息*/
            /********获得商品的品牌信息*/
            $brandModel = new \Back\Model\BrandModel();
            $brandData = $brandModel->select();
            $this->assign('brandData',$brandData);
            /********获得商品展示信息*/


            /********获得主分类并传递显示*/
            $catinfo = D('Category')->order('cat_path')->select();
            $this->assign('catinfo',$catinfo);
            /********获得主分类并传递显示*/

            /********获得商品的扩展分类并传递显示php_goods_cat*/
            $catextinfo = D('GoodsCat')->where(array('goods_id'=>$goods_id))->select();
            $this->assign('catextinfo',$catextinfo);
            /********获得商品的扩展分类信息(php41_goods_cat)********/
            //设置面包屑导航
            $bread = array(
                'first' => '商品管理',
                'second' => '商品修改',
                'linkTo' => array(
                    '【返回】',U('Goods/showlist')
                ),
            );

            $this->assign('bread',$bread);
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
        $goods = D('Goods');//调用的是父类，不会找到子类的瞻前顾后方法。不用考虑瞻前顾后，若new \Model\GoodsModel()就要涉及瞻前顾后
        $z = $goods->setField(array('goods_id'=>$goods_id,'is_del'=>'删除'));
        //setField()内部有调用save()方法
        if($z){
            echo json_encode(array('status'=>1));//ok
        }else{
            echo json_encode(array('status'=>2));//fail
        }
    }

    //根据type_id获得对应的属性信息
    function getAttributeByType(){
        $type_id = I('get.type_id');
        $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
        echo json_encode($attrinfo);
    }

    //修改商品，根据“type_id/goods_id”获得类型对应的属性信息
    function getAttributeByTypeUpd(){
        $type_id = I('get.type_id');
        $goods_id = I('get.goods_id');
        //判断当前选取的type_id和本身商品的是否一致
        $goodsinfo = D('Goods')->find($goods_id);
        if ($type_id !== $goodsinfo['type_id']){
            $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
            $info['mark'] = 1;//做一个标记，代表其他类型对应的属性信息
            $info[1] = $attrinfo;
            //$info被变成三维数组
            echo json_encode($info);//其他属性选取
        }else {
            //数据表：goods_attr attribute  ,商品本身拥有的属性获取
            $attrinfo = D('GoodsAttr')
                ->alias('g')
                ->join('__ATTRIBUTE__ a on g.attr_id=a.attr_id')
                ->where(array('goods_id' => $goods_id))
                ->field('g.attr_id,g.attr_value,a.attr_name,a.attr_is_sel,a.attr_sel_opt')
                ->select();
            //SELECT g.attr_id,g.attr_value,a.attr_name,a.attr_is_sel,a.attr_sel_opt FROM php_goods_attr g INNER JOIN php_attribute a on g.attr_id=a.attr_id  WHERE `goods_id` = '17'
            //$sql = D('GoodsAttr')->getLastSql();
            //file_put_contents('./log.php',$sql);
            //var_dump($sql);
            //var_dump($attrinfo);//普通的二维数组信息

            $tmp = array();
            foreach ($attrinfo as $k => $v) {
                if (!empty($tmp[$v['attr_id']]) || $v['attr_is_sel'] == 1) {
                    //多选属性整合
                    $tmp[$v['attr_id']]['attr_id'] = $v['attr_id'];
                    $tmp[$v['attr_id']]['attr_name'] = $v['attr_name'];
                    $tmp[$v['attr_id']]['attr_is_sel'] = $v['attr_is_sel'];
                    $tmp[$v['attr_id']]['attr_sel_opt'] = $v['attr_sel_opt'];
                    $tmp[$v['attr_id']]['attr_value'][] = $v['attr_value'];
                } else {
                    //单选属性整合
                    $tmp[$v['attr_id']] = $v;
                }
            }
            //var_dump($tmp);//整合后的三维数组信息
            $info['mark'] = 2;//定义mark = 2代表商品本身拥有的属性信息
            $info[1] = $tmp;
            //$info变为一个四维数组
            echo json_encode($info);
        }

    }
    //修改商品，根据"type_id/goods_id"获得类型对应的属性信息
    //function getAttributeByTypeUpd(){
    //    $type_id = I('get.type_id');
    //    $goods_id = I('get.goods_id');
    //    //判断当前选取的type_id和本身商品的是否一致
    //    $goodsinfo = D('Goods')->find($goods_id);
    //    if($type_id!== $goodsinfo['type_id']){
    //
    //        $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
    //        $info['mark'] = 1; ////其他类型对应的属性信息
    //        $info[1] = $attrinfo;
    //        //$info是三维数组
    //        echo json_encode($info);
    //    }else{
    //        //数据表：goods_attr  attribute
    //        $attrinfo = D('GoodsAttr')
    //            ->alias('g')
    //            ->join('__ATTRIBUTE__ a on g.attr_id=a.attr_id')
    //            ->where(array('goods_id'=>$goods_id))
    //            ->field('g.attr_id,g.attr_value,a.attr_name,a.attr_is_sel,a.attr_sel_opt')
    //            ->select();
    //        //dump($attrinfo);//普通的二维数组信息
    //
    //        $tmp = array();
    //        foreach($attrinfo as $k => $v){
    //            if(!empty($tmp[$v['attr_id']]) || $v['attr_is_sel']==1){
    //                //多选属性整合
    //                $tmp[$v['attr_id']]['attr_id'] = $v['attr_id'];
    //                $tmp[$v['attr_id']]['attr_name'] = $v['attr_name'];
    //                $tmp[$v['attr_id']]['attr_is_sel'] = $v['attr_is_sel'];
    //                $tmp[$v['attr_id']]['attr_sel_opt'] = $v['attr_sel_opt'];
    //                $tmp[$v['attr_id']]['attr_value'][] = $v['attr_value'];
    //            }else{
    //                //单选属性整合
    //                $tmp[$v['attr_id']] = $v;
    //            }
    //        }
    //        //dump($tmp);//整合后的三维数组信息
    //        $info['mark'] = 2; //商品本身拥有的的属性信息
    //        $info[1] = $tmp;
    //        //$info变为一个四维数组
    //        echo json_encode($info);
    //    }
    //}
}