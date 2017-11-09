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
    <form action="/index.php/Back/Auth/tianjia.html" method="post" enctype="multipart/form-data">
        <table border="1" width="100%" class="table_a">
            <tr>
                <td>权限名称</td>
                <td><input type="text" name="auth_name" /></td>
            </tr>
            <tr>
                <td>权限上级</td>
                <td>
                    <select name="auth_pid">
                        <option value="0">请选择</option>
                        <?php if(is_array($pinfo)): foreach($pinfo as $key=>$v): ?><option value="<?php echo ($v["auth_id"]); ?>">
                                <!--<?php echo str_repeat('&#45;&#45;/',$v['auth_level']); echo ($v["auth_name"]); ?>-->
                                <!--上面这条写法通过tp会转成下面去执行，所以下面更快-->
                                <?php echo str_repeat('--/',$v['auth_level']); echo ($v["auth_name"]); ?>
                            </option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>             
            <tr>
                <td>控制器</td>
                <td><input type="text" name="auth_c" /></td>
            </tr>               
            <tr>
                <td>操作方法</td>
                <td><input type="text" name="auth_a" /></td>
            </tr>                    
            <tr><td colspan='100'><input type='submit' value="添加"></td></tr>
        </table>
    </form>
</div>

</body>
</html>