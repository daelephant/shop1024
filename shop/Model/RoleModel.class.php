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
class RoleModel extends Model{

    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {
        //dump($data);
        //dump($options);


        if($_POST['now_act'] == '分配权限'){
            //维护两个数据role_auth_ids  role_auth_ac
            //dump($options);ok
            //1、制作role_auth_ids
            $data['role_auth_ids'] = implode(',',$data['role_auth_ids']);

            //2、制作role_auth_ac
            $authinfo = D('Auth')->where("auth_id in ({$data['role_auth_ids']})")->select();
            //从authinfo中获得auth_c和auth_a并拼装
            //dump($authinfo);exit();
            $s = "";
            foreach($authinfo as $k => $v){
                //顶级权限为空，制作role_auth_ac需要去掉
                if(!empty($v['auth_c']) && !empty($v['auth_a'])){
                    $s .= $v['auth_c']."-".$v['auth_a'].',';
                }
            }
            //dump($s);exit();//string(44) "Goods-showlist,Goods-tianjia,Goods-category,"
            $s = rtrim($s,',');
            $data['role_auth_ac'] = $s;

        }


    }
    // 更新成功后的回调方法
    protected function _after_update($data,$options) {}
}