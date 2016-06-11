<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <style type="text/css">
        <!--
        body {
            margin-left: 3px;
            margin-top: 0px;
            margin-right: 3px;
            margin-bottom: 0px;
        }
        .STYLE1 {
            color: #e1e2e3;
            font-size: 12px;
        }
        .STYLE6 {color: #000000; font-size: 12; }
        .STYLE10 {color: #000000; font-size: 12px; }
        .STYLE19 {
            color: #344b50;
            font-size: 12px;
        }
        .STYLE21 {
            font-size: 12px;
            color: #3b6375;
        }
        .STYLE22 {
            font-size: 12px;
            color: #295568;
        }
        a:link{
            color:#e1e2e3; text-decoration:none;
        }
        a:visited{
            color:#e1e2e3; text-decoration:none;
        }
        -->
    </style>

    <script type="text/javascript" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> <?php echo ($daohang["title1"]); ?> -> <?php echo ($daohang["title2"]); ?></span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo ($daohang["act_link"]); ?>"><img src="<?php echo C('AD_IMG_URL');?>add.gif" width="10" height="10" /> <?php echo ($daohang["act"]); ?></a>   &nbsp;
              </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <!--代表，分表代表 不不同页面的主体部分-->
    

<!--为使用富文本编辑器，引入3个js文件-->
<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>ueditor/lang/zh-cn/zh-cn.js"></script>


<style type="text/css">
    #tabbar-div {
        background: none repeat scroll 0 0 #80BDCB;
        height: 22px;
        padding-left: 10px;
        padding-top: 1px;
        font-size:12px;
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
</style>

<tr>
    <td colspan='100'>
        <script type="text/javascript">
            //"页面加载"完毕就给span标签设置点击高亮显示的onclick事件
            $(function(){
                $('#tabbar-div span').click(function(){
                    //对应标签高亮显示
                    $('#tabbar-div span').attr('class','tab-back');//全部span标签变暗
                    $(this).attr('class','tab-front');//当前点击的标签"高亮""

                    //标签切换对应内容显示
                    $('table[id$=cont]').hide();//全部的table区域隐藏
                    //当前点中标签对应的table区域显示
                    var idflag = $(this).attr('id');
                    $('#'+idflag+'-cont').show();
                });
            });
        </script>

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
    </td>
</tr>
<tr>
    <td>
        <form action="/index.php/Admin/Goods/update/goods_id/73.html" method="post" enctype="multipart/form-data">
            <!--__ SELF __代表:/index.php/Admin/Goods/upd/goods_id/25.html-->
            <input type="hidden" name='goods_id' value='<?php echo ($info["goods_id"]); ?>' />
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="general-tab-cont">
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品名称：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <input type="text" name="goods_name" value="<?php echo ($info["goods_name"]); ?>" />
                    </div></td>
                </tr>


                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                        <script type="text/javascript">
                            //页面加载完毕就调用show_cat，以便可以根据当前分类获得次级分类信息
                            $(function(){
                                show_cat(1); //第1级别分类 获得请求 第2级分类信息
                                show_cat(2); //第2级别分类 获得请求 第3级分类信息
                            });

                            //根据flag标识分类 获得 次级别分类信息
                            function show_cat(flag){
                                var cat_id = $('#cat_id_'+flag).val();//获得当前选中的主分类信息
                                var extcatinfo = ','+$('#extcatinfo').val()+','; //获得商品拥有的扩展分类信息
                                //拼装好的扩展分类信息(左右有逗号)：,19,20,

                                if(cat_id==0 && flag==1){
                                    //① 没有选取分类，展示 空壳 分类表单域
                                    $('#cat_id_2').html("<option value='0'>-请选择-</option>");
                                    $('#cat_id_3').html("<option value='0'>-请选择-</option>");
                                }else if(cat_id==0 && flag==2){
                                    //② 没有选取第2级分类，第3级别分类为 空壳
                                    $('#cat_id_3').html("<option value='0'>-请选择-</option>");
                                }else{
                                    //ajax带着cat_id去服务器端获得第2级别分类信息
                                    $.ajax({
                                        url:"/index.php/Admin/Category/getCatByPid",
                                        data:{'cat_id':cat_id},
                                        dataType:'json',
                                        type:'get',
                                        async:false,
                                        success:function(msg){
                                            //遍历msg，与html标签结合，最后追加给页面
                                            var s = "<option value='0'>-请选择-</option>";
                                            $.each(msg,function(n,v){
                                                s += '<option value="'+v.cat_id+'"';
                                                //判断扩展分类与商品有联系，并选中设置
                                                //s2.indexOf(s1)  判断s2大串左边第一次出现s1子串的下标信息(0/1/2/3..)
                                                //如果s2中没有出现s2则返回-1
                                                if(extcatinfo.indexOf(','+v.cat_id+',')>=0){
                                                    s += 'selected="selected"';
                                                }
                                                s += '>'+v.cat_name+'</option>';
                                            });
                                            //第2/3级别分类归位
                                            if(flag==1){
                                                $('#cat_id_2').html("<option value='0'>-请选择-</option>");
                                                $('#cat_id_3').html("<option value='0'>-请选择-</option>");
                                            }
                                            //把s追加给页面
                                            nextflag = flag+1;

                                            $('#cat_id_'+nextflag).html(s);//有覆盖旧信息效果
                                        }
                                    });
                                }

                            }
                        </script>
                        <input type="hidden" id='extcatinfo' value='<?php echo ($extcatinfo); ?>' />
                        <div align="right"><span class="STYLE19">商品分类(主)：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <select id="cat_id_1" name='cat_id' onchange="show_cat(1)">
                            <option value='0'>-请选择-</option>
                            <?php if(is_array($catinfoA)): foreach($catinfoA as $key=>$v): ?><option value='<?php echo ($v["cat_id"]); ?>'
                                <?php if(($v["cat_id"]) == $info["cat_id"]): ?>selected="selected"<?php endif; ?>
                                ><?php echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
                        </select>

                    </div></td>
                </tr>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品分类(扩展)：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <select name='ext_cat[]' id="cat_id_2" onchange="show_cat(2)">
                            <option value='0'>-请选择-</option>
                        </select>
                        <select name='ext_cat[]' id="cat_id_3">
                            <option value='0'>-请选择-</option>
                        </select>
                    </div></td>
                </tr>






                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">价格：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_price" value="<?php echo ($info["goods_price"]); ?>" /></div></td>
                </tr>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">数量：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_number" value="<?php echo ($info["goods_number"]); ?>" /></div></td>
                </tr>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">重量：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_weight" value="<?php echo ($info["goods_weight"]); ?>" /></div></td>
                </tr>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">logo图片：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <input type="file" name="goods_logo" />

                        <?php if(!empty($info["goods_small_logo"])): ?><img src="<?php echo C('SITE_URL'); echo (substr($info["goods_small_logo"],2)); ?>" alt="" width='100'/><?php endif; ?>

                    </div></td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="detail-tab-cont" style='display:none;'>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">详情描述：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">

        <textarea id="goods_introduce" name="goods_introduce"
                  style="width:520px; height:210px;"
        > <?php echo ($info["goods_introduce"]); ?></textarea>

                    </div></td>
                </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="mix-tab-cont" style='display:none;'>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">其他信息</td>
                </tr>
            </table>
            <script type="text/javascript">
                //页面加载完毕就调用show_goods_attr3一次，以便显示当前商品类型对应的属性
                $(function(){
                    show_goods_attr3();
                });

                //添加商品时，根据"类型"显示对应"属性"的表单域项目
                function show_goods_attr3(){
                    var type_id = $('#type_id').val(); //当前选中的类型id

                    //ajax帮组获得类型对应的“属性信息”
                    //① 获得“空壳”属性信息
                    //② 获得“实体”属性信息(获得的属性 与 当前商品拥有的属性一致)
                    //因此，ajax需要给服务器传递两个信息：type_id和goods_id
                    //goods_id可以帮助获得“实体”属性信息
                    var goods_id = $('[name=goods_id]').val();
                    $.ajax({
                        url:"/index.php/Admin/Attribute/getAttrByType3",
                        data:{'type_id':type_id,'goods_id':goods_id},
                        dataType:'json',
                        //type:,
                        success:function(msg){
                            if(msg.flag==2){
                                //1) 展示“空壳”属性信息
                                //遍历msg的同时与html结合，并把生成的信息追加给页面
                                var s = "";
                                $.each(msg.data,function(n,v){

                                    if(v.attr_sel=='0'){
                                        //1)唯一属性表单域
                                        s += '<tr><td class="STYLE6" bgcolor="#FFFFFF"><div align="right"><span class="STYLE19">'+v.attr_name+'：</span></div></td><td bgcolor="#FFFFFF"  class="STYLE6"><div align="left">';
                                        s += '<input type="text" size="40" value="" name="attrids['+v.attr_id+'][]">';
                                        s += '</div></td></tr>';
                                    }else{
                                        //2)多选属性表单域
                                        s += '<tr><td class="STYLE6" bgcolor="#FFFFFF"><div align="right"><span class="STYLE19"><span onclick="add_attr_item(this)">[+]</span><e>'+v.attr_name+'：</e></span></div></td><td bgcolor="#FFFFFF"  class="STYLE6"><div align="left">';
                                        //设置下拉列表的显示内容
                                        var attr_vals_arr = v.attr_vals.split(',');//String--->Array
                                        s += '<select name="attrids['+v.attr_id+'][]"><option value="0">-请选择-</option>';
                                        $.each(attr_vals_arr,function(nn,vv){
                                            s += '<option value="'+vv+'">'+vv+'</option>';
                                        });
                                        s += '</select>';
                                        s += '</div></td></tr>';
                                    }
                                });
                            }else{
                                //1) 展示“实体”属性信息
                                //遍历msg的同时与html结合，并把生成的信息追加给页面
                                var s = "";
                                $.each(msg.data,function(n,v){
                                    if(v.attr_sel=='0'){
                                        //1)唯一属性表单域
                                        s += '<tr><td class="STYLE6" bgcolor="#FFFFFF"><div align="right"><span class="STYLE19">'+v.attr_name+'：</span></div></td><td bgcolor="#FFFFFF"  class="STYLE6"><div align="left">';
                                        s += '<input type="text" size="40" value="'+v.attrvalues+'" name="attrids['+v.attr_id+'][]">';
                                        s += '</div></td></tr>';
                                    }else{
                                        //2)多选属性表单域
                                        //多选属性根据“值”的个数有可能是多个tr
                                        //多选属性值由String--》Array
                                        var attr_values = v.attrvalues.split(',');  //[折叠,滑盖]
                                        //可供选取的全部的多选属性值String->Array
                                        var attr_val_all = v.attr_vals.split(',');  //[滑盖，翻盖，折叠，直板]
                                        $.each(attr_values,function(nn,vv){

                                            s += '<tr><td class="STYLE6" bgcolor="#FFFFFF"><div align="right"><span class="STYLE19">';
                                            if(nn==0){
                                                s += '<span onclick="add_attr_item(this)">[+]</span>';
                                            }else{
                                                s += '<span onclick="$(this).parent().parent().parent().parent().remove()">[-]</span>';
                                            }

                                            s += '<e>'+v.attr_name+'：</e></span></div></td><td bgcolor="#FFFFFF"  class="STYLE6"><div align="left">';
                                            //设置下拉列表的显示内容
                                            s += '<select name="attrids['+v.attr_id+'][]"><option value="0">-请选择-</option>';
                                            $.each(attr_val_all,function(nnn,vvv){
                                                s += '<option value="'+vvv+'"';
                                                s += vvv==vv?'selected="selected"':'';
                                                s += '>'+vvv+'</option>';
                                            });
                                            s += '</select>';
                                            s += '</div></td></tr>';

                                        });
                                    }
                                });
                            }
                            //页面属性表单域 需要清除旧的，追加新的
                            $('#properties-tab-cont tr:gt(0)').remove();
                            $('#properties-tab-cont').append(s);
                        }
                    });
                }

                //点击[+]号复制表单域(多选属性表单域情形)
                function add_attr_item(obj){
                    var dst_tr = $(obj).parent().parent().parent().parent();//目标tr
                    var fu_tr = dst_tr.clone();//复制项目

                    //把fu_tr内部的[+]号变为[-]号
                    fu_tr.find('span.STYLE19 span').remove();//找到并删除内部的[+]号span
                    fu_tr.find('span.STYLE19 e').before('<span onclick="$(this).parent().parent().parent().parent().remove()">[-]</span>');//再追加一个[-]号的span

                    //把复制好的tr进行追加
                    dst_tr.after(fu_tr);  //兄弟关系追加
                }
            </script>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="properties-tab-cont" style='display:none;'>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6" width="40%"><div align="right"><span class="STYLE19">商品类型：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19" width="*"><div align="left">

                        <select name="type_id" id="type_id" onchange="show_goods_attr3()">
                            <option value='0'>-请选择-</option>
                            <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value='<?php echo ($v["type_id"]); ?>'
                                <?php if(($v["type_id"]) == $info["type_id"]): ?>selected="selected"<?php endif; ?>
                                ><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                        </select>

                    </div></td>
                </tr>
            </table>

            <style type="text/css">
                #gallery-tab-cont li{list-style: none;float:left;}
            </style>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="gallery-tab-cont" style='display:none;'>

                <tr><td colspan='100'>
                    <ul>
                        <?php if(is_array($picsinfo)): foreach($picsinfo as $key=>$v): ?><li id='pics_li_<?php echo ($v["id"]); ?>'><img src="<?php echo C('SITE_URL'); echo (substr($v["goods_pics_m"],2)); ?>" alt="" width='150'/><span style='color:red;' onclick='if(confirm("确认要删除该相册图片么？")){remove_pics(<?php echo ($v["id"]); ?>)}'>[-]</span></li><?php endforeach; endif; ?>
                    </ul>
                </td>
                </tr>

                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19" onclick="add_pics()" style='cursor:pointer;'>[+]商品相册：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                        <input type="file" name="goods_pics[]" />
                    </td>
                </tr>

            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
                   id="linkgoods-tab-cont" style='display:none;'>
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">关联商品</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6" colspan='100'>
                        <div align="center"><input type="submit" value='修改商品' /></div>
                    </td>
                </tr>
            </table>

        </form>
    </td>
</tr>
</table>

<script type="text/javascript">
    //对已经存在的相册图片进行删除操作
    //①物理图片删除  ② 清除对应数据表的记录信息
    //操作服务器端
    function remove_pics(pics_id){
        $.ajax({
            url:"<?php echo U('removePics');?>",
            data:{'pics_id':pics_id},
            //dataType:text,
            //type:get,
            success:function(msg){
                //清除页面对应的pics图片
                $('#pics_li_'+pics_id).remove();
            }
        });
    }

    //增加相册
    function add_pics(){
        //本质：给table追加tr元素而已
        $('#gallery-tab-cont').append('<tr><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19" onclick="$(this).parent().parent().parent().remove()">[-]商品相册：</span></div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE6"> <input type="file" name="goods_pics[]" /></td></tr>');
    }

    var ue = UE.getEditor('goods_introduce',{toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|','simpleupload', 'insertimage','rowspacingtop'
    ]]});
</script>

</body>
</html>