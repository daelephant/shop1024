<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/Back/Public/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="/index.php/Back/Goods/tianjia">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>商品名称</td>
                        <td>价格</td>
                        <td>重量</td>
                        <td>图片</td>
                        <td>缩略图</td>
                        <td>描述</td>
                        <td>创建时间</td>
                        <td align="center" colspan="2">操作</td>
                    </tr>

                <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product4">
                        <td><?php echo ($v["goods_id"]); ?></td>
                        <td><a href="#"><?php echo ($v["goods_name"]); ?></a></td>
                        <td><?php echo ($v["goods_price"]); ?></td>
                        <td><?php echo ($v["goods_weight"]); ?></td>
                        <td><img src="<?php echo (C("SITE_URL")); echo (substr($v["goods_big_logo"],2)); ?>" alt="暂无图片" width="100" height="100"  ></td>
                        <td><img src="<?php echo (C("SITE_URL")); echo (substr($v["goods_small_logo"],2)); ?>" alt="暂无图片" width="60" height="60"  ></td>
                        <td><?php echo (htmlspecialchars_decode($v["goods_introduce"])); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$v["add_time"])); ?></td>
                        <td><a href="#" >修改</a></td>
                        <td><a href="#" >删除</a></td>
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