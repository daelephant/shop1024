<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>会员列表</title>

    <link href="/Back/Public/css/mine.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>js/jquery-1.11.3.min.js"></script>

    <!--引入时间显示插件-->
    <link href="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/datepicker-zh_cn.js"></script>
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
    <script type="text/javascript" src="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
    <script type="text/javascript" src="<?php echo (C("PLUGIN_URL")); ?>datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
    <!--引入时间显示插件-->
</head>
<body>
<style>
    .tr_color{background-color: #9F88FF}
</style>
<div class="div_head">
            <span>
                <span style="float: left;">当前位置是：<?php echo ($bread["first"]); ?>-》<?php echo ($bread["second"]); ?></span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo ($bread["linkTo"]["1"]); ?>"><?php echo ($bread["linkTo"]["0"]); ?></a>
                </span>
            </span>
</div>
<div></div>


        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>名称</td>
                        <td>权限ids</td>
                        <td colspan="3" align="center">操作</td>
                       </tr>

                <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product_<?php echo ($v["goods_id"]); ?>"><!--给每个商品都设置唯一标识，以方便获得、删除-->
                        <td><?php echo ($v["role_id"]); ?></td>
                        <td><a href="/index.php/Back/Role/upd/goods_id/<?php echo ($v['goods_id']); ?>"><?php echo ($v["role_name"]); ?></a></td>
                        <td><?php echo ($v["role_auth_ids"]); ?></td>

                        <td><a href="<?php echo U('distribute',array('role_id'=>$v['role_id']));?>" >分配权限</a></td>

                        <td><a href="/index.php/Back/Role/upd/goods_id/<?php echo ($v['goods_id']); ?>" >修改</a></td>
                        <script type="text/javascript">
                            function del_goods(goods_id){
                                //利用ajax去服务器删除数据库记录信息
                                $.ajax({
                                    url:"<?php echo U('delGoods');?>",
                                    data:{'goods_id':goods_id},
                                    dataType:'json',
                                    type:'get',
                                    success:function(msg){
                                        if(msg.status==1){
                                            $('#product_'+goods_id).remove();

                                        }
                                    }
                                });
                            }
                        </script>
                        <td><a href="javascript:;" onclick="if(confirm('确定要删除id='+<?php echo ($v["goods_id"]); ?>+'的商品信息么？')){del_goods(<?php echo ($v["goods_id"]); ?>)}" >删除</a></td>
                    </tr><?php endforeach; endif; ?>

                     <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($pagelist); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</body>
</html>