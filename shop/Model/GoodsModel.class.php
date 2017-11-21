<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.10.25
 * Time: 22:39
 * 商品goodsmodel模型
 */
namespace Model;
use Think\Model;
class GoodsModel extends Model{
    //为数据表字段添加默认值，不能为空
    //自动完成设置add_time/upd_time
    protected $_auto = array(
        array('add_time','time',1,'function'),
        array('upd_time','time',3,'function')
    );
    // 插入数据前的回调方法
    //参数：
    //$data是收集的表单信息$options是设置的各种条件
    protected function _before_insert(&$data,$options) {
        //上传图片处理：
        if($_FILES['goods_logo']['error']===0) {
            //通过Think/Upload.class.php实现附件上传  使用$up重写
            $cfg = array(
                'rootPath' => './Common/Uploads/', //保存根路径
            );
            $up = new \Think\Upload($cfg);
            $z = $up->uploadOne($_FILES['goods_logo']);
            //$z会返回成功上传附件的相关信息
            //拼装图片的路径名信息，存储到数据库里面
            $big_path_name = $up->rootPath . $z['savepath'] . $z['savename'];
            $data['goods_big_logo'] = $big_path_name;

            //根据原图($big_path_name)制作缩略图
            $im = new \Think\Image();//实例化对象
            $im->open($big_path_name);//打开原图
            $im->thumb(60,60);//制作缩略图
            //缩略图的名字：“small_原图名字”；
            $small_path_name = $up->rootPath.$z['savepath']."small_".$z['savename'];
            $im->save($small_path_name);//存储缩略图到服务器
            //保存缩略图到数据库：
            $data['goods_small_logo'] = $small_path_name;


        }


    }
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
        //收集属性并存储
        if(!empty($_POST['attr_info'])){
            //变量每个属性信息
            foreach($_POST['attr_info'] as $k=>$v){
                //$k代表attr_id
                foreach($v as $kk => $vv){
                    //$vv代表每个属性的值
                    $arr = array(
                        'goods_id' => $data['goods_id'],
                        'attr_id'  => $k,
                        'attr_value' =>$vv
                    );
                    D('GoodsAttr')->add($arr);
                }
            }
        }

        //上传相册图片判断（只要有一个相册图片上传，就要往下进行）
        $flag = false;
        foreach($_FILES['goods_pics']['error'] as $a=>$b){
            if($b === 0){
                $flag = true;
                break;
            }
        }
        if($flag ===true) {
            $cfg = array(
                'rootPath' => './Common/Pics/',//保存路径
            );
//            dump($_FILES);
            $up = new \Think\Upload($cfg);
            $z = $up->upload(array('goods_pics' => $_FILES['goods_pics']));
            //通过返回值$z可以到对于上传ok的附件信息
            //        dump($z);
            //        exit();
            //遍历$z，获得每个附件的信息，存储到数据表中goods_pics
            foreach ($z as $k => $v) {
                $pics_big_name = $up->rootPath . $v['savepath'] . $v['savename'];
                //根据大图，制作缩略图
                $im = new \Think\Image();//实例化对象
                $im->open($pics_big_name);//打开原图
                $im->thumb(60, 60);//制作缩略图
                //缩略图名字:“small_原图名字”
                $pics_small_name = $up->rootPath . $v['savepath'] . "small_" . $v['savename'];
                $im->save($pics_small_name);//存储缩略图到服务器.指的是保存缩略图到指定目录
                //根据大图，制作缩略图
                $arr = array(
                    'goods_id' => $data['goods_id'],
                    'pics_big' => $pics_big_name,
                    'pics_small' => $pics_small_name,
                );
                D('GoodsPics')->add($arr);

            }
        }
    }
    //给后台获取商品列表信息，有分页要求
    function fetchData(){
        //1获取商品总条数
        $total = $this->count();
        $per = 5;//每页5条数据
        //2实例化分页类Page对象
        $page = new \Common\Tools\Page($total,$per);
        //3获取分页信息
        $pageinfo = $this ->where(array('is_del'=>'不删除'))-> order('goods_id desc')->limit($page->offset,$per)->select();
        //4获取页码列表信息
        $pagelist = $page->fpage(array(3,4,5,6,7,8));//一定要注意传递的是数组
       // dump($pagelist);
        return array(
            'pageinfo' => $pageinfo,
            'pagelist' => $pagelist
        );
    }

    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {
        /*##############logo图片################*/
        //判断是否有上传logo图片，并做处理
        if($_FILES['goods_logo_upd']['error']===0){
            //1删除商品原先的物理图片
            $logoinfo = $this->field('goods_big_logo,goods_small_logo')->find($options['where']['goods_id']);
            if(!empty($logoinfo['goods_big_logo']) || !empty($logoinfo['goods_small_logo'])){
                unlink($logoinfo['goods_small_logo']);
                unlink($logoinfo['goods_big_logo']);
            }

            //2上传原图图片
            //通过Think/Upload.class.php实现附件上传  使用$up重写
            $cfg = array(
                'rootPath' => './Common/Uploads/', //保存根路径
            );
            $up = new \Think\Upload($cfg);
            $z = $up->uploadOne($_FILES['goods_logo_upd']);
            //$z会返回成功上传附件的相关信息
            //拼装图片的路径名信息，存储到数据库里面
            $big_path_name = $up->rootPath . $z['savepath'] . $z['savename'];
            $data['goods_big_logo'] = $big_path_name;

            //根据原图($big_path_name)制作缩略图
            $im = new \Think\Image();//实例化对象
            $im->open($big_path_name);//打开原图
            $im->thumb(60,60);//制作缩略图
            //缩略图的名字：“small_原图名字”；
            $small_path_name = $up->rootPath.$z['savepath']."small_".$z['savename'];
            $im->save($small_path_name);//存储缩略图到服务器
            //保存缩略图到数据库：
            $data['goods_small_logo'] = $small_path_name;

        }

        /*##############upd修改模块添加相册图片处理################*/
        //上传相册图片判断（只要有一个相册图片上传，就要往下进行）
        $flag = false;
        foreach($_FILES['goods_pics_upd']['error'] as $a=>$b){
            if($b === 0){
                $flag = true;
                break;
            }
        }
        if($flag ===true) {
            $cfg = array(
                'rootPath' => './Common/Pics/',//保存路径
            );
//            dump($_FILES);
            $up = new \Think\Upload($cfg);
            $z = $up->upload(array('goods_pics_upd' => $_FILES['goods_pics_upd']));
            //通过返回值$z可以到对于上传ok的附件信息
            //        dump($z);
            //        exit();
            //遍历$z，获得每个附件的信息，存储到数据表中goods_pics
            foreach ($z as $k => $v) {
                $pics_big_name = $up->rootPath . $v['savepath'] . $v['savename'];
                //根据大图，制作缩略图
                $im = new \Think\Image();//实例化对象
                $im->open($pics_big_name);//打开原图
                $im->thumb(60, 60);//制作缩略图
                //缩略图名字:“small_原图名字”
                $pics_small_name = $up->rootPath . $v['savepath'] . "small_" . $v['savename'];
                $im->save($pics_small_name);//存储缩略图到服务器.指的是保存缩略图到指定目录
                //根据大图，制作缩略图
                $arr = array(
                    //'goods_id' => $data['goods_id'],//需要从$options['where']['goods_id']取id
                    'goods_id' => $options['where']['goods_id'],
                    'pics_big' => $pics_big_name,
                    'pics_small' => $pics_small_name,
                );
                D('GoodsPics')->add($arr);

            }
        }
    }
    // 更新成功后的回调方法
    protected function _after_update($data,$options) {}

}