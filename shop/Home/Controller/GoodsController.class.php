<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;
class GoodsController extends HomeController {
    //商品列表信息
    function showlist(){
        $cat_id = I('get.cat_id');
        $goods = new \Model\GoodsModel();
        $cdt['is_del'] = '不删除';
        $cdt['is_sale'] = '上架';

        /*关联分类条件*/
            // ① 主分类等于  当前选取的、全部子级分类的 商品当前选取的是“外国手机”
            // ② 扩展分类等于  当前选取的分类  的商品
            // ③ 扩展分类等于  当前选取【分类的子级分类】 的商品
        /*以上三点总结：*/
        //获取当前选取的分类 和 其内部全部子级分类，并合并为一个集合
        //商品的主分类、扩展分类必须在此集合中。


        //$cdt['cat_id'] = $cat_id;
        //获取全部子集分类
        //全路径以当前选取分类的全路径为开始内容的分类信息
        $cat = D('Category');
        $now_cat = $cat->find($cat_id);//当前选取的分类信息
        $now_path = $now_cat['cat_path'];

        $ext_cat = D('Category')->field('cat_id')->where("cat_path like '$now_path%'")->select();
        //dump($ext_cat);//选取的、子集的都存在

        $s="";
        foreach($ext_cat as $k=>$v){
            $s .= $v['cat_id'].",";
        }
        $s = rtrim($s,',');
        //dump($s);//string(16) "3,21,22,23,24,25"

        //获得商品列表，条件是：主分类或扩展分类都在$s里面
        $sql = "select goods_id from __GOODS__ WHERE cat_id in ($s) UNION SELECT goods_id FROM __GOODS_CAT__ WHERE cat_id IN ($s)";
        $ids = D()->query($sql);
        //dump($ids);//二维数组信息，符合要求的商品id

        $w = "";
        foreach($ids as $kk=>$vv){
            $w .= $vv['goods_id'].",";
        }
        $w = rtrim($w,',');
        //dump($w);


        //从$w的条件里面边，获得需要的商品列表信息
        $cdt['goods_id'] = array('in',$w);
        /*关联分类条件***********************************************************************************************************************/

        $info = $goods->where($cdt)->order('goods_id desc')->select();
        //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `goods_id` IN ('8','17','7','4','16') ORDER BY goods_id desc
        $this->assign('info',$info);

        $this->display();
    }
}