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

class CategoryController extends BackController{
//    列表展示
    public function showlist(){
        //获取权限列表信息
        $info = D('Category')->order('cat_path')->select();//根据cat_path排序，使得权限按照上下级关系显示

        //设置面包屑导航
        $bread = array(
            'first' => '分类管理',
            'second' => '分类列表',
            'linkTo' => array(
                '【添加分类】',U('Category/tianjia')
            ),
        );

        $this->assign('bread',$bread);

        $this->assign('info',$info);
        $this->display();
    }

    //添加分类
    function tianjia(){
        //展示、收集两个逻辑
        if(IS_POST){
            //var_dump($_POST);exit(); ok
            $cat = new \Model\CategoryModel();
            $data = $cat->create();
            //通过_after_insert()方法实现path和level两个字段的维护
            if($cat->add($data)){
                $this->success('添加分类成功',U('showlist'),2);
            }else{
                $this->error('添加分类失败',U('tianjia'),2);
            }
        }else{
            //获取可供选择的上级分类（level=0/1）
            $pinfo = D('Category')->where(array('cat_level'=>array('in','0,1')))->order('cat_path')->select();
            //SELECT * FROM `php_cat` WHERE `cat_level` IN ('0','1') ORDER BY cat_path [ RunTime:0.0010s ]
            $this->assign('pinfo',$pinfo);

            //设置面包屑导航
            $bread = array(
                'first' => '分类管理',
                'second' => '分类添加',
                'linkTo' => array(
                    '【返回】',U('Category/showlist')
                ),
            );

            $this->assign('bread',$bread);
            $this->display();
        }
    }
}