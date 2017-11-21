<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>会员列表</title>

    <link href="/Back/Public/css/mine.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>js/jquery-1.11.3.min.js"></script>
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
     按商品类型进行显示属性:

     <select id="type_id" onchange="show_attr()">
         <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): if(($_GET['type_id']) == $v['type_id']): ?><option value="<?php echo ($v["type_id"]); ?>" selected="selected">
              <?php else: ?>
                 <option value="<?php echo ($v["type_id"]); ?>"><?php endif; ?>
             <?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
     </select>
     <script type="text/javascript">
         function show_attr() {
             var type_id = $('#type_id option:selected').val();//获得被选中的value值
             // console.log(type_id);//ok
             //利用ajax去服务器端获取“选中类型”对应的属性信息
             $.ajax({
                 url:"<?php echo U('Attribute/getInfoByType');?>",
                 data:{'type_id':type_id},
                 dataType:'json',
                 type:'get',
                 success:function (msg) {
                     //遍历msg中的每个属性信息并显示
                     var s = "";
                     $.each(msg,function (k,v) {
                         s+="<tr>";
                         s+="<td>"+v.attr_id+"</td>";
                         s+="<td>"+v.attr_name+"</td>";
                         s+="<td>"+v.type_id+"</td>";
                         s+="<td>"+v.attr_is_sel+"</td>";
                         s+="<td>"+v.attr_write_mod+"</td>";
                         s+="<td>"+v.attr_sel_opt+"</td>";
                         //<td><a href="/index.php/Back/Attribute/upd/auth_id/<?php echo ($v['type_id']); ?>" >修改</a></td
                         s+='<td><a href="/index.php/Back/Attribute/upd/auth_id/'+v.type_id+'" >修改</a></td>';
                         s+="</tr>";
                     });


                     $('.table_a tr:not(:first)').remove();
                     $('.table_a').append(s);
                 }
         });
         }
     </script>
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>名称</td>
                        <td>类型</td>
                        <td>选取方式</td>
                        <td>录入方式</td>
                        <td>供选取的值</td>
                        <td colspan="3" align="center">操作</td>
                       </tr>

                <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product_<?php echo ($v["goods_id"]); ?>"><!--给每个商品都设置唯一标识，以方便获得、删除-->
                        <td><?php echo ($v["attr_id"]); ?></td>
                        <td><?php echo ($v["attr_name"]); ?></td>
                        <td><?php echo ($v["type_id"]); ?></td>
                        <td><?php echo ($v["attr_is_sel"]); ?></td>
                        <td><?php echo ($v["attr_write_mod"]); ?></td>
                        <td><?php echo ($v["attr_sel_opt"]); ?></td>
                        <!--在权限名称的前面设置 缩进符号 使得信息可读性好 -->
                        <td><a href="/index.php/Back/Attribute/upd/auth_id/<?php echo ($v['type_id']); ?>" >修改</a></td>
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