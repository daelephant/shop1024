<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;
class IndexController extends HomeController {
    public function index(){
        /*使用memcached缓存数据*/
            //给推荐商品设置一个key
        S(array('type'=>'memcache','host'=>'localhost','port'=>11211));
        $tuijian_key = md5("qiang_rec_hot_new");
        $info = S($tuijian_key);
        //var_dump($info);没有数据注意查看本机的memcached的服务详情，是否开启，端口号是否匹配
        if(empty($info)){
            echo "此时走数据库";
            /*获取推荐商品信息*/
            $goods = D('Goods');
            $cdt['is_del'] = "不删除";
            $cdt['is_sale'] = "上架";
            //1、抢购的
            $cdt_q = $cdt;
            $cdt_q['is_qiang'] = "抢";
            $info_qiang = $goods->where($cdt_q)->order('goods_id desc')->limit(5)->select();
            //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_qiang` = '抢' ORDER BY goods_id desc LIMIT 5

            //获得抢购的商品id信息
            /*        $q = "";
            foreach($info_qiang as $k=>$v){
                $q .= $v['goods_id'].",";
            }
            $q = rtrim($q,',');*/
            $ids_q = arrayToString($info_qiang,'goods_id');
            //dump($ids);
            //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_qiang` = '抢' ORDER BY goods_id desc LIMIT 5
            //2、热销的  查询not in $q即可
            $cdt_h = $cdt;
            $cdt_h['is_hot'] = "热销";
            $cdt_h['goods_id'] = array('not in',$ids_q);//排除抢购的，剩下的是热销的
            $info_hot = $goods -> where($cdt_h)->order('goods_id desc')->limit(5)->select();
            $ids_h = arrayToString($info_hot,'goods_id');
            //dump($info_hot);exit;
            //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_hot` = '热销' AND `goods_id` NOT IN ('18','17','16','15','14') ORDER BY goods_id desc LIMIT 5
            //3、推荐的
            $cdt_c = $cdt;
            $cdt_c['is_rec'] = '推荐';
            //排除抢购的、热销的，剩下的是推荐的
            $cdt_c['goods_id'] = array('not in',$ids_q.",".$ids_h);
            $info_rec = $goods->where($cdt_c)->order('goods_id desc')->limit(5)->select();
            $ids_c = arrayToString($info_rec,'goods_id');
            //dump($ids_c);
            //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_rec` = '推荐' AND `goods_id` NOT IN ('18','17','16','15','14','13','11','8','7') ORDER BY goods_id desc LIMIT 5

            //4、新品
            $cdt_n = $cdt;
            $cdt_n['is_new'] = '新品';
            //排除抢购的、热销的、推荐的，剩下的是新的
            $cdt_n['goods_id'] = array('not in',$ids_q.",".$ids_h.','.$ids_c);
            $info_new = $goods->where($cdt_n)->order('goods_id desc')->limit(5)->select();
            $ids_n = arrayToString($info_new,'goods_id');
            //dump($ids_n);
            //SELECT * FROM `php_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_new` = '新品' AND `goods_id` NOT IN ('18','17','16','15','14','13','11','8','7','6') ORDER BY goods_id desc LIMIT 5


            //为memcache准备数据，把查询好的数据放到memecache中
            //$info = array();
            $info['qiang'] = $info_qiang;
            $info['hot'] = $info_hot;
            $info['rec'] = $info_rec;
            $info['new'] = $info_new;
            S($tuijian_key,$info);

        }
        //分配到模板
        $this->assign('info_qiang',$info['qiang']);
        $this->assign('info_hot',$info['hot']);
        $this->assign('info_rec',$info['rec']);
        $this->assign('info_new',$info['new']);

        //        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//
//        /*获取分类信息  给模板显示*/
//        $category = D('Category');
//        //根据等级  分别获取
//        $cat_infoA = $category->where(array('cat_level'=>0))->select();
//        $cat_infoB = $category->where(array('cat_level'=>1))->select();
//        $cat_infoC = $category->where(array('cat_level'=>2))->select();
//        $this->assign('cat_infoA',$cat_infoA);
//        $this->assign('cat_infoB',$cat_infoB);
//        $this->assign('cat_infoC',$cat_infoC);
//        dump($cat_infoB);exit;
        /*获取分类信息  给模板显示*///使用公共引入HomeController

        $this->display();
    }
}