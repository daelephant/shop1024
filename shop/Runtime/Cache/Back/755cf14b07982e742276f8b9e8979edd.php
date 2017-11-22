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
<div style="font-size: 13px;margin: 10px 5px">
    <form action="/index.php/Back/Attribute/tianjia.html" method="post" enctype="multipart/form-data">
        <table border="1" width="100%" class="table_a">
            <tr>
                <td>属性名称</td>
                <td><input type="text" name="attr_name" /></td>
            </tr>
            <tr>
                <td>所属类型</td>
                <td>
                    <select name="type_id">
                        <option value="0">-请选择-</option>
                        <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v['type_id']); ?>"><?php echo ($v['type_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>是否可选</td>
                <td><input type="radio" name="attr_is_sel" value="0" />单选
                <input type="radio" name="attr_is_sel" value="1" />多选</td>
            </tr>
            <tr>
                <td>录入方式</td>
                <td><input type="radio" name="attr_write_mod" value="0" />手工
                <input type="radio" name="attr_write_mod" value="1" />以下信息选取</td>
            </tr>
            <tr>
                <td>可选信息值</td>
                <td><textarea name="attr_sel_opt"></textarea>多个值属性使用,来分隔</td>
            </tr>

            <tr><td colspan='100'><input type='submit' value="添加"></td></tr>
        </table>
    </form>
</div>

</body>
</html>