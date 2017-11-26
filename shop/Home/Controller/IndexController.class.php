<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');

        /*获取分类信息  给模板显示*/
        $category = D('Category');
        //根据等级  分别获取
        $cat_infoA = $category->where(array('cat_level'=>0))->select();
        $cat_infoB = $category->where(array('cat_level'=>1))->select();
        $cat_infoC = $category->where(array('cat_level'=>2))->select();
        $this->assign('cat_infoA',$cat_infoA);
        $this->assign('cat_infoB',$cat_infoB);
        $this->assign('cat_infoC',$cat_infoC);
//        dump($cat_infoB);exit;
        /*获取分类信息  给模板显示*/

        $this->display();
    }
}