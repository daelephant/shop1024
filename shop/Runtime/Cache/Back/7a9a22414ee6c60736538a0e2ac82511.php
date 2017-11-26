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
    <form action="/index.php/Back/Goods/upd/goods_id/17" method="post" enctype="multipart/form-data">
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
                <td>商品分类</td>
                <td>
                    <select name="cat_id" id="cat_id_0">
                        <option value="0">-请选择-</option>
                        <?php if(is_array($catinfo)): foreach($catinfo as $key=>$v): if(($info['cat_id']) == $v['cat_id']): ?><option value="<?php echo ($v["cat_id"]); ?>" selected="selected"><?php echo str_repeat('***/',$v['cat_level']); echo ($v["cat_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($v["cat_id"]); ?>"><?php echo str_repeat('***/',$v['cat_level']); echo ($v["cat_name"]); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>扩展分类</td>
                <td>
                    <input type="button" value="添加" onclick="add_sel(this)"/>
                   <?php if(is_array($catextinfo)): foreach($catextinfo as $k=>$v): ?><select name="cat_ext_info[]" id="cat_id_<?php echo ($k+1); ?>">
                           <option value="0">-请选择-</option>
                           <?php if(is_array($catinfo)): foreach($catinfo as $key=>$vv): if(($v['cat_id']) == $vv['cat_id']): ?><option value="<?php echo ($vv["cat_id"]); ?>" selected="selected"><?php echo str_repeat('***/',$vv['cat_level']); echo ($vv["cat_name"]); ?></option>
                                   <?php else: ?>
                                   <option value="<?php echo ($vv["cat_id"]); ?>"><?php echo str_repeat('***/',$vv['cat_level']); echo ($vv["cat_name"]); ?></option><?php endif; endforeach; endif; ?>
                       </select><?php endforeach; endif; ?>
                </td>
            </tr>
            <script type="text/javascript">
                var select_num = 1;//计数器，给创建出来的多个下拉列表进行id计数
                function add_sel(obj){
                    var fu_sel = $('#cat_id_0').clone();//克隆下拉列表
                    fu_sel.attr('id','cat_id_'+select_num);//设置其cat_id值，区别不同的id属性值
                    fu_sel.attr('name','cat_ext_info[]');//修改name属性值
                    $(obj).after(fu_sel);//追加
                    select_num++;//计数器累加

                }
            </script>

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
            <tr style="background-color: lightgreen;">
                <td style="text-align: right" width="25%">商品类型:</td>
                <td>
                    <select name="type_id" onchange="show_attribute_upd()">
                        <option value="0">-请选择-</option>
                        <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): if(($info['type_id']) == $v['type_id']): ?><option value="<?php echo ($v["type_id"]); ?>" selected="selected"><?php echo ($v["type_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
        /*修改商品，根据当前选中的类型，获得该商品对应的全部属性并显示 */   
        function show_attribute_upd() {
            var type_id = $('select[name=type_id] option:selected').val();//获得被选中的类型id
            var goods_id = $('[name=goods_id]').val();
            //通过ajax去获取信息
            $.ajax({
                url:"<?php echo U('Goods/getAttributeByTypeUpd');?>",//请求哪个地址
                data:{'type_id':type_id,'goods_id':goods_id},//条件值
                dataType:'json',//服务器返回类型
                type:'get',//以什么方式过去的
                success:function(msg){
                    //遍历msg，获得其中的数据，再和tr/td等标签组合显示到页面上
                    var s = "";
                    if(msg.mark==2){
                        //1) 显示本身拥有的类型对应的属性信息
                        $.each(msg[1],function(k,v){
                            //1、显示本身拥有的类型和属性

                            if(v.attr_is_sel == 0){
                                //单选
                                s += "<tr><td style='text-align:right'>"+v.attr_name+"：</td>";
                                s += "<td><input type='text' name='attr_info["+v.attr_id+"][]' value='"+v.attr_value+"'></td>";
                                s += "</tr>";
                            }else{
                                //多选
                                //多选的值的个数一共有多少，根据值的个数显示对应的tr个数
                                // alert("进入");
                                var value_num = v.attr_value.length;
                                for(var w=0;w<value_num;w++){
                                    s+="<tr><td style='text-align: right'>";
                                    if (w==0){
                                        s += "<em><span onclick='add_item_tr_upd($(this).parent().parent().parent())'>&nbsp; [+]</span></em>";
                                    }else {
                                        s+= "<em><span onclick='$(this).parent().parent().parent().remove()'>&nbsp; [-]</span></em>";
                                    }
                                    s+=v.attr_name+":</td>";
                                    s+="<td><select name='attr_info["+v.attr_id+"][]'>";
                                    s+="<option value='0'>-请选择-</option>";
                                    var opt = v.attr_sel_opt.split(',');//把多选项目变为数组
                                    $.each(opt,function (kk,vv) {
                                        if(v.attr_value[w] == vv){
                                            s+="<option value='"+vv+"' selected='selected'>"+vv+"</option>";
                                        }else {
                                            s+="<option value='"+vv+"'>"+vv+"</option>";
                                        }
                                    });
                                    s+="</select></td>"
                                    s+= "</tr>";
                                }
                            }
                        });
                    }else {
                        //2) 显示选取的其他的类型的属性信息
                        $.each(msg[1],function(k,v){
                            //输入框/下拉列表
                            if(v.attr_is_sel==1){
                                s += "<tr>";
                                s += "<td style='text-align:right;'><em><span onclick='add_item_tr_upd($(this).parent().parent().parent())'>[+]</span></em>"+v.attr_name+"：</td>";
                                s += "<td>";
                                //下拉列表
                                var opt_val = v.attr_sel_opt.split(','); //字符串变为数组
                                s += "<select name='attr_info["+v.attr_id+"][]'>";
                                s += "<option value='0'>-请选择-</option>";
                                $.each(opt_val,function(kk,vv){
                                    s += "<option value='"+vv+"'>"+vv+"</option>";
                                });
                                s += "</select>";
                                s += "</td>";
                                s += "</tr>";
                            }else{
                                s += "<tr>";
                                s += "<td style='text-align:right;'>"+v.attr_name+"：</td>";
                                s += "<td>";
                                //输入框
                                s += "<input text='text' name='attr_info["+v.attr_id+"][]' />";
                                s += "</td>";
                                s += "</tr>";
                            }
                        });
                    }
                    $('#properties-tab-tb tr:not(:first)').remove();//删除旧的tr信息
                    $('#properties-tab-tb tr:first').after(s);
                }
            });
        }
        show_attribute_upd();
        function add_item_tr_upd(obj) {
            var fu_obj = obj.clone();//复制tr
            fu_obj.find('span').remove();//删除复制品tr内部的“span”
            fu_obj.find('em').append("<span onclick='$(this).parent().parent().parent().remove()'>[-]&nbsp;</span>");
            //上一行给复制品tr内部的em增加一个<span>[-]</span>
            obj.after(fu_obj);//把复制品tr追加到页面
        }
        /*修改商品，根据当前选中的类型，获得该商品对应的全部属性并显示 */



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