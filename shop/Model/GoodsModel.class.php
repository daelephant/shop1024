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
    //添加时调用create方法允许接受的字段
    //protected $insertFields = 'goods_name,goods_price,is_on_sale';
    //修改时调用create方法允许接受的字段
    //protected $updateFields = 'id,goods_name,goods_price,is_on_sale';

    //为数据表字段添加默认值，不能为空
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空！',1),
        array('goods_price','currency','商品价格必须是货币类型！',1)
    );

    //自动完成设置add_time/upd_time
    /*
     * TP自动完成
     * array(     array(完成字段1,完成规则,[完成条件,附加规则]),     array(完成字段2,完成规则,[完成条件,附加规则]),     ......);
     * self::MODEL_INSERT或者1 新增数据的时候处理（默认）
     * self::MODEL_UPDATE或者2 更新数据的时候处理
     * self::MODEL_BOTH或者3 所有情况都进行处理
     * function 使用函数，表示填充的内容是一个函数名
     * */
    protected $_auto = array(
        array('add_time','time',1,'function'),//// 对update_time字段在更新的时候写入当前时间戳
        /// array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('upd_time','time',3,'function')
    );

    //添加时调用create方法允许接受的字段,可以防止用户模拟表单添加大值的id导致无法再插入新id
    //protected $insertFields = '';
    // 插入数据前的回调方法
    //参数：
    //$data是收集的表单信息$options是设置的各种条件
    protected function _before_insert(&$data,$options) {
        //上传图片处理：判断有没有选择图片
        if($_FILES['goods_logo']['error']===0) {
            //通过Think/Upload.class.php实现附件上传  使用$up重写
            $cfg = array(
                'rootPath' => './Common/Uploads/', //保存根路径
            );
            $up = new \Think\Upload($cfg);//实例化上传类
            $up->maxSize = 1024 * 1024;//1M
            $up->exts = array('jpg','gif','png','jpeg');//设置文件上传类型
            //$up -> savePath = 'Goods/';//设置附件上传(子)目录
            $z = $up->uploadOne($_FILES['goods_logo']);
            if (!$z){
                //获取失败原因把错误信息保存到 模型 的error属性中，然后控制器调用$model->getError()获取错误信息并由控制器打印
                $this->error = $up->getError();
                return FALSE;
            }else{

                //$z会返回成功上传附件的相关信息
                //拼装图片的路径名信息，存储到数据库里面
                $big_path_name = $up->rootPath . $z['savepath'] . $z['savename'];
                $data['goods_big_logo'] = $big_path_name;

                //缩略图的名字：“small_原图名字”；
                $small_path_name = $up->rootPath.$z['savepath']."small_".$z['savename'];
                $msmall_path_name = $up->rootPath.$z['savepath']."msmall_".$z['savename'];
                //根据原图($big_path_name)制作缩略图
                $im = new \Think\Image();//实例化对象
                $im->open($big_path_name);//打开原图
                $im->thumb(60,60)->save($small_path_name);//制作缩略图
                $im->thumb(30,30)->save($msmall_path_name);//制作缩略图
                //$im->save($small_path_name);//存储缩略图到服务器
                //保存缩略图到数据库：
                $data['goods_small_logo'] = $small_path_name;
                $data['goods_msmall_logo'] = $msmall_path_name;
            }

            //// 获取当前时间并添加到表单中这样就会插入到数据库中
            //$data['addtime'] = date('Y-m-d H:i:s', time());
            //// 我们自己来过滤这个字段
            //$data['goods_desc'] = removeXSS($_POST['goods_desc']);
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

        //收集扩展分类信息并存储
        if(!empty($_POST['cat_ext_info'])){
            foreach($_POST['cat_ext_info'] as $k=>$v){
                $arr=array(
                    'goods_id'=>$data['goods_id'],
                    'cat_id' =>$v
                );
                D('GoodsCat')->add($arr);
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
        /*******每次添加都去清除memcache数据****/
        S(array('type'=>'memcache','host'=>'localhost','port'=>11211));
        $tuijian_key = md5("qiang_rec_hot_new");
        S($tuijian_key,null);
        /*******每次添加都去清除memcache数据****/
    }
    //给后台获取商品列表信息，有分页要求
    function fetchData(){
        /******************搜索*************/
        $where = array(); //空的where条件
        $where['is_del'] = array('eq','不删除');//WHERE is_del = '不删除'
        //商品名称
        $goods_name = I('get.goods_name');
        if($goods_name)
            $where['goods_name'] = array('like',"%$goods_name%");//WHERE goods_name like '%$goods_name%'
        //价格
        $fgoods_price = I('get.fgoods_price');
        $tgoods_price = I('get.tgoods_price');
        if($fgoods_price && $tgoods_price)
            $where['goods_price'] = array('between',array($fgoods_price,$tgoods_price));
            //WHERE goods_price BETWEEN $fgoods_price AND $tgoods_price
        elseif ($fgoods_price)
            $where['goods_price'] = array('egt',$fgoods_price);//WHERE goods_price >= $fgoods_price
        elseif ($tgoods_price)
            $where['goods_price'] = array('elt',$tgoods_price);//WHERE goods_price <= $tgoods_price
        //是否上架
        $ios = I('get.ios');
        if($ios)
            $where['is_sale'] = array('eq',$ios);//WHERE is_sale = $ios
        //添加时间
        $fadd_time = I('get.fadd_time');
        $tadd_time = I('get.tadd_time');
        if($fadd_time && $tadd_time) {
            $fadd_time = strtotime($fadd_time);
            $tadd_time = strtotime($tadd_time);
            $where['add_time'] = array('between', array($fadd_time, $tadd_time));//WHERE add_time between $fadd_time AND $tadd_time
        }
        elseif ($fadd_time) {
            $fadd_time = strtotime($fadd_time);
            $where['add_time'] = array('egt', $fadd_time);//WHERE add_time >= $fadd_time
        }
        elseif ($tadd_time) {
            $tadd_time = strtotime($tadd_time);
            $where['add_time'] = array('elt', $tadd_time);//WHERE add_time <= $tadd_time
        }
        /******************搜索*************/
        /**********************排序*************************/
        $orderby = 'goods_id';//默认的排序字段
        $orderway = 'desc';//默认的排序方式
        $odby = I('get.odby');//默认的排序字段
        if ($odby){
            if ($odby == 'id_asc')
                $orderway = 'asc';
            elseif ($odby == 'price_desc')
                $orderby = 'goods_price';
            elseif ($odby =='price_asc')
            {
                $orderby = 'goods_price';
                $orderway = 'asc';
            }
        }
        /**********************排序*************************/
        /*********************翻页**************/
        //1获取商品总条数
        $total = $this->where($where)->count();
        $per = 10;//每页5条数据
        //2实例化分页类Page对象
        $page = new \Common\Tools\Page($total,$per);
        //3获取分页信息
        $pageinfo = $this ->where($where)-> order("$orderby $orderway")->limit($page->offset,$per)->select();
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
    protected function _after_update($data,$options) {
        //商品【类型】、属性的更新和操作
        //战略:delete删除旧的全部属性，insert写入新的属性
        //1、删除旧的属性
        D('GoodsAttr')->where(array('goods_id'=>$data['goods_id']))->delete();
        //2、写入新的属性
        //收集属性并存储同after_insert
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
        /***********以上的是属性处理*/

        /*******扩展分类处理****/
        //删除旧的分类、添加新的分类
        //1、删除旧的分类
        D('GoodsCat')->where(array('goods_id'=>$data['goods_id']))->delete();
        //2、写入新的属性
        //收集扩展分类信息并存储
        if(!empty($_POST['cat_ext_info'])){
            foreach($_POST['cat_ext_info'] as $k=>$v){
                $arr=array(
                    'goods_id'=>$data['goods_id'],
                    'cat_id' =>$v
                );
                D('GoodsCat')->add($arr);
            }
        }

        /*******扩展分类处理****/
        /*******每次更新都去清除memcache数据****/
        S(array('type'=>'memcache','host'=>'localhost','port'=>11211));
        $tuijian_key = md5("qiang_rec_hot_new");
        S($tuijian_key,null);
        /*******每次更新都去清除memcache数据****/
    }

}