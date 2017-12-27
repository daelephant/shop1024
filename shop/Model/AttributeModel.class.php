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
class AttributeModel extends Model{

    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {}
    // 更新成功后的回调方法
    protected function _after_update($data,$options) {}

    //表单自动验证(由create（）方法触发)
    protected $_validate = array(
        //类型验证
        array('type_id','0','类型必须选择',0,'notequal'),
        //验证是否不等于某个值
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        //第二个零代表存在字段就验证，1：必须验证、2值不为空时验证
    );
}