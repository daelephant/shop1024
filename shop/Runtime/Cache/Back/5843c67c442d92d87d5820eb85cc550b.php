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

    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
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

    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Plugin/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>js/uploadPreview.js"></script>

<script type="text/javascript">
    //加载事件里面定义click事件，点击标签实现切换对应内容的jquery实现逻辑。
    $(function(){
        $('#tabbar-div span').click(function(){
            $('#tabbar-div span').attr('class','tab-back');//全部标签变暗
            $(this).attr('class','tab-front');//当前被点击标签  高亮
            $('.table_a').hide();//全部table变暗隐藏
            var idflag = $(this).attr('id');//当前被点击标签对应的table高亮
            $('#'+idflag+"-tb").show();
        });
    });
</script>
<style type="text/css">
    #tabbar-div {
        background: none repeat scroll 0 0 #80BDCB;
        height: 27px;
        padding-left: 10px;
        padding-top: 1px;
    }
    #tabbar-div p {
        margin: 2px 0 0;
    }
    .tab-front {
        background: none repeat scroll 0 0 #BBDDE5;
        border-right: 2px solid #278296;
        cursor: pointer;
        font-weight: bold;
        line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
    .tab-back {
        border-right: 1px solid #FFFFFF;
        color: #FFFFFF;
        cursor: pointer;
        line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
    .tab-hover {
        background: none repeat scroll 0 0 #94C9D3;
        border-right: 1px solid #FFFFFF;
        color: #FFFFFF;
        cursor: pointer;
        line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
</style>
<div id="tabbar-div">
    <p>
        <span id="general-tab" class="tab-front">通用信息</span>
        <span id="detail-tab" class="tab-back">详细描述</span>
        <span id="mix-tab" class="tab-back">其他信息</span>
        <span id="properties-tab" class="tab-back">商品属性</span>
        <span id="gallery-tab" class="tab-back">商品相册</span>
        <span id="linkgoods-tab" class="tab-back">关联商品</span>
        <span id="groupgoods-tab" class="tab-back">配件</span>
        <span id="article-tab" class="tab-back">关联文章</span>
    </p>
</div>
<div style="font-size: 13px;margin: 10px 5px">
    <form action="/index.php/Back/Goods/upd/goods_id/15" method="post" enctype="multipart/form-data">
        <input type="hidden" name="goods_id" value="<?php echo ($info["goods_id"]); ?>"/>
        <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name" value="<?php echo ($info["goods_name"]); ?>" /></td>
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price" value="<?php echo ($info["goods_price"]); ?>" /></td>
            </tr>

            <tr>
                <td>商品logo图片</td>
                <td><input type="file" name="goods_logo_upd" id="goods_logo" />
                    <div id="goods_logo_dv"><img src="" alt="" id="goods_logo_im" width="160" height="160"/></div>
                    <?php if(!empty($info["goods_big_logo"])): ?><img src='<?php echo (C("SITE_URL")); echo ($info["goods_big_logo"]); ?>' width='200' height='200' alt=''/>
                        <span>如果选择上传新的logo图片，则会自动覆盖旧图片</span><?php endif; ?>
                </td>

            </tr>
        </table>
        <script type="text/javascript">
            $(function(){
                new uploadPreview({UpBtn:"goods_logo",DivShow:"goods_logo_dv",ImgShow:"goods_logo_im"});
            });
        </script>
        <table style="display: none;" border="1" width="100%" class="table_a" id="detail-tab-tb" >

            <tr>
                <td>商品详细描述</td>
                <td>
                    <textarea style="width: 730px;height: 320px;" name="goods_introduce" id="goods_introduce"><?php echo ($info["goods_introduce"]); ?></textarea>
                </td>
            </tr>
            <script type="text/javascript">
                var ue =UE.getEditor('goods_introduce');
            </script>
        </table>
        <table style="display: none;" border="1" width="100%" class="table_a" id="mix-tab-tb" >
            <tr>
                <td>商品重量</td>
                <td><input type="text" name="goods_weight" /></td>
            </tr>
        </table>
        <table style="display: none;" border="1" width="100%" class="table_a" id="properties-tab-tb" >
            <tr>
                <td>商品相关属性</td>
                <td></td>
            </tr>
        </table>
        <script type="text/javascript">
            var p_num = 1;//相册计数器

            //增加相册项目
            function add_item(){
                var s ="<tr><td><span style='cursor: pointer;' onclick='$(this).parent().parent().remove()'>[-]</span>商品相册</td><td><input type='file' name='goods_pics_upd[]' id='goods_pics_"+p_num+"' /><div id='goods_pics_dv_"+p_num+"'><img src='' alt='' width='160' height='160' id='goods_pics_im_"+p_num+"' /></div></td></tr>";
                $('#gallery-tab-tb').append(s);
                //设置立即显示上传好的图片效果
                new uploadPreview({UpBtn:"goods_pics_"+p_num,DivShow:"goods_pics_dv_"+p_num,ImgShow:"goods_pics_im_"+p_num});
                p_num++;//每增加一个相册，计数器的值都要累加

            }

        </script>
        <table style="display: none;" border="1" width="100%" class="table_a" id="gallery-tab-tb" >
            <?php if(!empty($picsinfo)): ?><style type='text/css'>li{float:left;}li{list-style:none;}</style>

                <script type="text/javascript">
                    function del_pics(pics_id){
                        //通过ajax进行下一步操作，触发服务器端unlink删除物理图片
                        $.ajax({
                            url:"<?php echo U('delPics');?>",
                            data:{"pics_id":pics_id},//向Url传递数据按照对象方式传递
                            //dataType:,//返回数据格式默认字符串
                            //type:,请求格式默认get
                            //请求成功后的回调函数
                            success:function(msg){
                                //alert(msg);
                                //删除页面上相关的相册节点
                                $('#pics_'+pics_id).remove();
                            }
                        });
                    }
                </script>
                <tr>
                    <td colspan="100">
                        <ul>
                            <?php if(is_array($picsinfo)): foreach($picsinfo as $key=>$v): ?><li id="pics_<?php echo ($v["id"]); ?>">
                                    <img src="<?php echo (C("SITE_URL")); echo ($v["pics_big"]); ?>" alt="" height="100" width="100"/>
                                    <span style='cursor:pointer;' onclick='if(confirm("确定删除么？")){del_pics(<?php echo ($v["id"]); ?>)}'>[-]</span>
                                </li><?php endforeach; endif; ?>
                        </ul>
                    </td>
                </tr><?php endif; ?>
            <tr>
                <td><span style='cursor: pointer;' onclick="add_item()">[+]</span>商品相册</td>
                <td><input id="goods_prics_0" type="file" name="goods_pics_upd[]" />
                    <div id="goods_prics_dv_0"><img src="" alt="" width="160" height="160" id="goods_prics_im_0"/></div>
                </td>
            </tr>

        </table>
        <script type="text/javascript">
            $(function(){
                new uploadPreview({UpBtn:"goods_prics_0",DivShow:"goods_prics_dv_0",ImgShow:"goods_prics_im_0"});
            });
        </script>
        <table  width="100%">
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="修改">
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>