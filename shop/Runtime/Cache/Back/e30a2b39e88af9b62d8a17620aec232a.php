<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Back/Public/css/mine.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"> </script>
        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
        <script type="text/javascript" charset="utf-8" src="/Plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript">
            UEDITOR_CONFIG.toolbars =[['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable' ,'|']];
        </script>
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Back/Goods/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" /></td>
                </tr>
                <!--<tr>-->
                    <!--<td>商品分类</td>-->
                    <!--<td>-->
                        <!--<select name="goods_category_id">-->
                            <!--<option value="0">请选择</option>-->
                            <!--{foreach from=$s_category_info key=_k item=_v}-->
                            <!--<option value="<?php echo ($_v["category_id"]); ?>"><?php echo ($_v["category_name"]); ?></option>-->
                            <!--{/foreach}-->
                        <!--</select>-->
                    <!--</td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td>商品品牌</td>-->
                    <!--<td>-->
                        <!--<select name="goods_brand_id">-->
                            <!--<option value="0">请选择</option>-->
                            <!--{foreach from=$s_brand_info key=_k item=_v}-->
                            <!--<option value="<?php echo ($_v["brand_id"]); ?>"><?php echo ($_v["brand_name"]); ?></option>-->
                            <!--{/foreach}-->
                        <!--</select>-->
                    <!--</td>-->
                <!--</tr>-->
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" /></td>
                </tr>
                <tr>
                    <td>商品重量</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>
                <!--<tr>-->
                    <!--<td>商品图片</td>-->
                    <!--<td><input type="file" name="goods_image" /></td>-->
                <!--</tr>-->
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea style="width: 730px;height: 420px;" name="goods_introduce" id="goods_introduce"></textarea>
                    </td>
                </tr>
                <script type="text/javascript">
                    var ue =UE.getEditor('goods_introduce');
                </script>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>