<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no"/>
<script>
var _width = parseInt(window.screen.width);
var scale = _width/640;
var ua = navigator.userAgent.toLowerCase();
var result = /android (\d+\.\d+)/.exec(ua);
if (result){
var version = parseFloat(result[1]);
if(version>2.3){
document.write('<meta name="viewport" content="width=640, minimum-scale = '+scale+', maximum-scale = '+scale+', target-densitydpi=device-dpi">');
}else{
document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
}
} else {
document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
}
</script>
<title><?php echo (L("Equipment")); ?></title>
<link rel="stylesheet" href="/Public/wap/css/css_wap2.css" >
<link rel="shortcut icon" href="/Public/resource/common/images/favicon.ico" type="image/x-icon" />
</head>
<body>
<!--header-->
<link rel="shortcut icon" href="/Public/resource/common/images/favicon.ico" type="image/x-icon" />
<!--<link rel="stylesheet" href="/Public/wap/css/bootstrap.css" >-->
<!--<link rel="stylesheet" href="/Public/wap/css/css_wap.css" >-->
<!--<script src="/Public/wap/css/js/jquery-1.7.min.js"></script>-->
<!--<div class="jumppage_bg" style="display:none;"></div>-->

<!--end header--> 
<div class="jumppage" style="display:none;">
    <div class="t_1"><?php echo (L("Box_name")); ?></div>
    <div class="tx1"></div>
    <input type="button" class="btn2" id="Jq_sure" value="<?php echo (L("Sure")); ?>">
	<input type="button" class="btn3" id="Jq_no" value="<?php echo (L("Cancel")); ?>">
</div>

<style> 
body{ <?php echo (L("font")); ?>}
</style>
<div class="jumppage_lang" style="display:none;">
    <div class="til_">Language</div>
    <div class="btn1"><a href="./?l=zh-cn" style="color:#000">Chinese</a></div>
    <div class="btn2"><a href="./?l=en-us" style="color:#000">English</a></div>
</div>
<div class="jumppage_bg" style="display:none;"></div>

<div class="topper" style="background-color:#fbfbfb">
	<div class="con">
		<!--<div class="back_btn"><a href="javascript:history.go(-1);" title="返回" style="display:inline-block; width:120px; height:57px"></a></div>-->
        <div class="logo" style="background-color:#fbfbfb">
        	<a href="<?php echo (L("langue_link")); ?>" style="display:inline-block; width:120px; height:57px"></a>
        </div>
		<div class="t_1" style="color:#3f3f3f"><?php echo (L("Center")); ?></div>
        <div style="float:left;height: 57px; line-height:57px"><a id="Jq_change_l" href="javascript:;" style="color:#000">Language</a></div>
	</div>
</div>

<!--main-->
<div class="con_index">
	<div class="mainpage">
        <div class="chengyuan_con">
        	<div class="menu">
    <div class="btn0 <?php echo ($my1); ?>"><a href="/index.php/User/"><?php echo (L("Member")); ?></a></div>
    <div class="btn0 <?php echo ($my2); ?>"><a href="/index.php/User/add/"><?php echo (L("Add_member")); ?></a></div>
    <div class="btn0 <?php echo ($my3); ?>"><a href="/index.php/Mobile/"><?php echo (L("Equipment")); ?></a></div>
    <div class="btn0 <?php echo ($my4); ?>"><a href="/index.php/Type/"><?php echo (L("Model")); ?></a></div>
    <div class="btn0 <?php echo ($my5); ?>"><a href="/index.php/Type/add/"><?php echo (L("Add_model")); ?></a></div>
    <div class="btn0 <?php echo ($my6); ?>"><a href="/index.php/Time/"><?php echo (L("Time")); ?></a></div>
    <div class="btn0 <?php echo ($my7); ?>"><a href="/index.php/Time/add/"><?php echo (L("Add_time")); ?></a></div>
    <div class="btn0 <?php echo ($my8); ?>"><a href="/index.php/User/useredit/"><?php echo (L("Information")); ?></a></div>
    <div class="btn0 <?php echo ($my9); ?>"><a href="/index.php/User/pwd/"><?php echo (L("Change_password")); ?></a></div>
	<div class="btn0 <?php echo ($my11); ?>"><a href="/index.php/Mobile/usermobile/"><?php echo (L("UserMobile")); ?></a></div>
    <div class="btn0 <?php echo ($my10); ?>"><a href="/index.php/User/out/"><?php echo (L("Exit")); ?></a></div>
</div>
            
            <div class="tb1">
            	<div class="title"><?php echo (L("Equipment")); ?></div>
                
                <div class="c1">
                	<div class="tx2_1"><?php echo (L("Equipment_position")); ?></div>
                	<div class="tx3"><?php echo (L("Operation")); ?></div>
                </div>
                
                <?php if(is_array($myMobile)): $k = 0; $__LIST__ = $myMobile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="c<?php echo ($k%2+2); ?>" id="data_<?php echo ($vo["Pid"]); ?>" dataName="<?php echo ($vo["McName"]); ?>">
                    <div class="tx4_1"><?php echo ($vo["McName"]); ?></div>
                    <div class="tx6">
                        <a class="btn1" href="/index.php/Home/Mobile/edit/id/<?php echo ($vo["Pid"]); ?>/" ><?php echo (L("Edit")); ?></a>
                        <a class="btn2" href="javascript:Jq_del('<?php echo ($vo["Pid"]); ?>',this)"><?php echo (L("Delete")); ?></a>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            
        </div>
	</div>
</div>

<!--end main--> 
<!--footer-->
<div class="footer">
    <div class="con">
        <div class="t_1" style="width:auto; font-size:17px">
            <?php echo (L("Company")); ?><br>
            <?php echo (L("Adress")); ?><br>
            <div style="pointer-events: none;"> <?php echo (L("Tell")); ?><br></div>
            <?php echo (L("Copy")); ?>
        </div>
        <!--<div class="gq">
            <a href="./?l=zh-cn"><div class="gq_img0"></div></a>
            <a href="./?l=en-us"><div class="gq_img1"></div></a>
        </div>-->
    </div>
    <!--<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>-->
	<script type="text/javascript" src="/Public/wap/js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript">
    	function submitForm(){
			$('.JQ_sub').submit();
		}
    </script>
    <script  type="text/javascript">
		$('#Jq_change_l').click(function(){
			$('.jumppage_lang, .jumppage_bg').show();
			$('.jumppage_bg').click(function(){
				$('.jumppage_lang, .jumppage_bg').hide();	
			});	
		});
</script>
</div>
<script type="text/javascript">
	//$('.Jq_sure').attr("disabled","disabled");
	function Jq_del(id){	
		var name = $('#data_'+id).attr("dataName");
		$('.jumppage > .tx1').html('<?php echo (L("Confirm_delete")); ?>  '+name);
		$('.jumppage_bg, .jumppage').show();
			$('#Jq_sure').click(function(){
				var url = "/index.php/Home/Mobile/del/id/" + id;
				//var url = "/index.php/Home/Mobile";
				window.location.href = url;
				$(this).attr("disabled","disabled");
			});	
	};

	$('#Jq_no').click(function(){
		$('.jumppage_bg, .jumppage').hide();	
	});
	
</script>
<!--end footer--> 
</body>
</html>