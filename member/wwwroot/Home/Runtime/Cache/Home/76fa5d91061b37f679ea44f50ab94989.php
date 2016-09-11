<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo (L("Login")); ?></title>
<link rel="stylesheet" href="/Public/resource/common/css/base.css" >
<link rel="stylesheet" href="/Public/resource/common/css/user.css">
<link rel="stylesheet" href="/Public/resource/common/js/validform/style.css" >
<link rel="shortcut icon" href="/Public/resource/common/images/favicon.ico" type="image/x-icon" />
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/jsbn.js"></script>
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/prng4.js"></script>
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/rng.js"></script>
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/rsa.js"></script>
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/base64.js"></script>
<script language="JavaScript" type="text/javascript" src="/Public/resource/js/md5.js"></script>
<script src="/Public/resource/common/js/jquery.js"></script>
<script language="JavaScript"> 
var public_key="<?php echo (C("public_key")); ?>";
var public_length="<?php echo (C("public_length")); ?>";
function do_encrypt() {
  var before = new Date();
  var rsa = new RSAKey();
  rsa.setPublic(public_key, public_length);
  document.getElementById("wUseID").value = rsa.encrypt(document.getElementById("regneme").value);
  document.getElementById("regneme").value ='';
  document.getElementById("wPassWord").value = hex_md5(document.getElementById("password").value);
  document.getElementById("password").value ='';
}
//-->
</script>
<style>
	#Allrong {
		margin:10px 0px 0px 100px !important;
		height:20px;
		line-height:20px;
		/*background:#ccc;*/
		display:block;
		margin-top:0 !important;
		margin-bottom:10px !important;
	}
	#Validform_msg {
		display:none !important;
	}
</style>
</head>
<body>
<!--header-->
<link rel="stylesheet" href="/Public/resource/common/css/bootstrap.min.css"><link rel="stylesheet" href="css/non-responsive.css">
<link rel="stylesheet" href="/Public/resource/common/css/non-responsive.css">
<link rel="stylesheet" href="/Public/resource/common/css/style.css">
<script src="/Public/resource/common/js/jquery.js"></script>
<nav class="navbar-fixed-top">
<nav class="top-header">
	<div class="container">
        <div class="row">
            <div class="col-xs-5  left_top" >
                <a href="http://www.loysmarthom.com/"><img src="/Public/resource/common/images/logo.png" alt=""></a>
            </div>
            <div class="col-xs-7 top-header-right">
	                  <span class="Welcome"><img src="/Public/resource/common/images/Welcome.png"></span>
					<?php if(($langue) == "cn"): if(empty($_SESSION['wUseID'])): ?><a href="http://member.loysmarthom.com/?l=zh-cn"><?php echo (L("Login")); ?></a>
			                  <span>|</span>
			                  <a href="http://member.loysmarthom.com/index.php/Login/?l=zh-cn"><?php echo (L("Register")); ?></a>
						<?php else: ?> 
							<a href="/index.php/User/" class="username"><?php echo $_SESSION['wUseID']; ?></a>
						    <a href="/index.php/User/out/" class="logout"><?php echo (L("Logout")); ?></a><?php endif; ?> 
	                  <a class="btn-sm langw" href="./?l=zh-cn">中 文</a>
	                  <a class="btn-sm" href="./?l=en-us">E N</a>
					<?php else: ?>
						 <?php if(empty($_SESSION['wUseID'])): ?><a href="http://member.loysmarthom.com/?l=en-us"><?php echo (L("Login")); ?></a>
				                  <span>|</span>
				                  <a href="http://member.loysmarthom.com/index.php/Login/?l=en-us"><?php echo (L("Register")); ?></a>
							<?php else: ?> 
								<a href="/index.php/User/" class="username"><?php echo $_SESSION['wUseID']; ?></a>
							    <a href="/index.php/User/out/" class="logout"><?php echo (L("Logout")); ?></a><?php endif; ?> 
		                  <a class="btn-sm langw" href="./?l=zh-cn">中 文</a>
		                  <a class="btn-sm" href="./?l=en-us">E N</a><?php endif; ?>
            </div>
        </div>
	</div>
</nav>

<nav class="top-header-tow">
    <div class="container" style="clear:both;">
        <div class="row" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
            <div class="col-xs-12"  style="padding:0;">
			<?php if(($langue) == "cn"): ?><ul>
                    <li class="dropdown">
                       <a href="http://www.loysmarthom.com/?l=zh-cn" class="main-a active">
                       	<div class="main-cn"><?php echo (L("Home")); ?></div><div class="main-en">Home</div>
					   </a>
                    </li>
                    <li class="dropdown">
                        <a href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=24" class="main-a ">
                        	<div class="main-cn"><?php echo (L("Solution")); ?></div><div class="main-en">Solution</div>
						</a>
                    </li>
                    <li class="dropdown">
                        <a href="http://www.loysmarthom.com/index.php?c=channel&a=type&tid=33" class="main-a">
                        	<div class="main-cn"><?php echo (L("Products")); ?></div><div class="main-en">Products</div>
						</a>
                    </li>
                    <li class="dropdown">
                        <a href="http://www.loysmarthom.com/index.php?c=product&a=type&tid=25" class="main-a">
                        	<div class="main-cn"><?php echo (L("Download")); ?></div><div class="main-en">Download</div>
					    </a>
                    </li>
                    <li class="dropdown">
                        <a href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=26" class="main-a">
                        	<div class="main-cn"><?php echo (L("Join_Us")); ?></div><div class="main-en">Join Us</div>
						</a>                        
                    </li>
                    <li class="dropdown">
                       <a href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=27" class="main-a">
                       	<div class="main-cn"><?php echo (L("About_Us")); ?></div><div class="main-en">Contact Us</div>
						</a>
                    </li>
                </ul>
			<?php else: ?>
			      <ul>
                    <li class="dropdown">
                       <a href="http://eng.loysmarthom.com/?l=en-us" class="main-a active"><?php echo (L("Home")); ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=24" class="main-a "><?php echo (L("Solution")); ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="http://eng.loysmarthom.com/index.php?c=channel&a=type&tid=33" class="main-a"><?php echo (L("Products")); ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="http://eng.loysmarthom.com/index.php?c=product&a=type&tid=25" class="main-a"><?php echo (L("Download")); ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=26" class="main-a"><?php echo (L("Join_Us")); ?></a>                        
                    </li>
                    <li class="dropdown">
                       <a href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=27" class="main-a"><?php echo (L("About_Us")); ?></a>
                    </li>
                </ul><?php endif; ?>
            </div>
        </div>
    </div>
</nav>
</nav>
<div class="jumppage_bg" style="display:none;"></div>


<!--end header--> 
<!--main-->
<div class="user_wrap">
  <div class="user_con">
    <h1><?php echo (L("LOGIN")); ?></h1>
    <div class="user_box clearfix">
      <div class="user_box_l log_box_l fl">
        <form method="post" action="/index.php/Login/logincheck/" class="loginform">
          <div class="m_form_row">
            <label class="m_label"><?php echo (L("Username")); ?>：</label>
            <input type="text"  id="regneme" name="regneme" class="m_input" sucmsg="<?php echo (L("Crepass")); ?>" authsuc=""  autherr="" datatype="*3-16" errormsg="<?php echo (L("Cuser_l_e")); ?>" nullmsg="<?php echo (L("Cuser_l_n")); ?>">
          </div>
          <div class="m_form_row ">
            <label class="m_label"><?php echo (L("Password")); ?>：</label>
            <input type="password" id="password" name="password"  class="m_input" datatype="*6-16" sucmsg="<?php echo (L("Crepass")); ?>" nullmsg="<?php echo (L("Cpass_l_n")); ?>" errormsg="<?php echo (L("Cpass_l_e")); ?>" >
		  </div>
		  <span id ="Allrong"class="Validform_checktip  Validform_wrong"></span>

		 
          <div class="u_btn_row">
		  <input type="hidden" name="wUseID" id="wUseID">
		  <input type="hidden" name="wPassWord" id="wPassWord">
          <input type="submit" id="u_btn_blue" class="m_btn_blue_l" value="<?php echo (L("Login")); ?>">
            &nbsp; <a href="/index.php/Lostpassword/" style ="margin-top: -20px;"><?php echo (L("FORGOTPASS")); ?></a>
            <p class="valid_tip"></p>
          </div>
        </form>
      </div>
      <div class="user_box_r log_box_r fr"><i class="sep_and"></i>
        <p class="user_box_r_title"><?php echo (L("Notacount")); ?>?</p>
        <p><a href="/index.php/Login/" ><?php echo (L("RegNow")); ?>?</a></p>
      </div>
    </div>
  </div>
</div>
<div class="clear-none"></div>
<script src="/Public/resource/common/js/Validform.js"></script>
<script type="text/javascript">
$(function(){
var demo=$(".loginform").Validform({
		tiptype:3,
		label:".m_label",
		showAllError:false,
		datatype:{
			"zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
		},
		beforeSubmit:do_encrypt,
		ajaxPost:false,
		/*beforeCheck:function(curform){
			$(".Validform_right").text("");
			$("#Allrong").text('');
		},
		callback:function (data){
			var Rongmsg = "<?php echo (L("S_user_pw_n")); ?>";
			if (data.status == "y"){
				$("#Allrong").text('');
				//window.location = "/index.php/User";
				window.location =data.url;
			}else if(data.status == "n") {
				$(".Validform_right").text("");
				$("#Allrong").text(data.info);
			}
		},*/
	});
})
</script>
<!--end main--> 
<!--footer-->
<div style="clear:both"></div>
<div class="footer-top">
	<div class="container">
        <div class="col-xs-8" style="text-align:center !important;">
        	<?php if(($langue) == "cn"): ?><ul>
                <li><a class="main-a" href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=24"><?php echo (L("Solution")); ?></a>
                    <ul class="child-ul">
                        <li><a href="#"><?php echo (L("Smart_Home")); ?></a></li>
                        <li><a href="#"><?php echo (L("Smart_Hotel")); ?></a></li>
                        <li><a href="#"><?php echo (L("Smart_Office")); ?></a></li>
                        <li><a href="#"><?php echo (L("Smart_Community")); ?></a></li>
                    </ul>
                </li>
                <li><a class="main-a" href="http://www.loysmarthom.com/index.php?c=product&a=type&tid=25"><?php echo (L("Download")); ?></a>
                    <ul class="child-ul">
                        <li><a href="#">IOS</a></li>
                        <li><a href="#"><?php echo (L("ANDROID")); ?></a></li>
                    </ul>
                </li>
                <li><a class="main-a" href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=26"><?php echo (L("Join_Us")); ?></a>
                    <ul class="child-ul">
                        <li><a href="#"><?php echo (L("Requirements")); ?></a></li>
                        <li><a href="#"><?php echo (L("Message")); ?></a></li>
                    </ul>
                </li>
                <li><a class="main-a" href="http://www.loysmarthom.com/index.php?c=article&a=type&tid=27"><?php echo (L("About_Us")); ?></a>
                    <ul class="child-ul">
                        <li><a href="javascript:void(0);"><?php echo (L("Company_Profile")); ?></a></li>
                        <li class="top" style="display:block;"><a href="javascript:void(0)" ><?php echo (L("SERVICE")); ?></a></li>
                    </ul>
                </li>
            </ul>
			<?php else: ?>
				  <ul>
	                <li><a class="main-a" href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=24"><?php echo (L("Solution")); ?></a>
	                    <ul class="child-ul">
	                        <li><a href="#"><?php echo (L("Smart_Home")); ?></a></li>
	                        <li><a href="#"><?php echo (L("Smart_Hotel")); ?></a></li>
	                        <li><a href="#"><?php echo (L("Smart_Office")); ?></a></li>
	                        <li><a href="#"><?php echo (L("Smart_Community")); ?></a></li>
	                    </ul>
	                </li>
	                <li><a class="main-a" href="http://eng.loysmarthom.com/index.php?c=product&a=type&tid=25"><?php echo (L("Download")); ?></a>
	                    <ul class="child-ul">
	                        <li><a href="#">IOS</a></li>
	                        <li><a href="#"><?php echo (L("ANDROID")); ?></a></li>
	                    </ul>
	                </li>
	                <li><a class="main-a" href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=26"><?php echo (L("Join_Us")); ?></a>
	                    <ul class="child-ul">
	                        <li><a href="#"><?php echo (L("Requirements")); ?></a></li>
	                        <li><a href="#"><?php echo (L("Message")); ?></a></li>
	                    </ul>
	                </li>
	                <li><a class="main-a" href="http://eng.loysmarthom.com/index.php?c=article&a=type&tid=27"><?php echo (L("About_Us")); ?></a>
	                    <ul class="child-ul">
	                        <li><a href="javascript:void(0);"><?php echo (L("Company_Profile")); ?></a></li>
	                        <li class="top" style="display:block;"><a href="javascript:void(0)" ><?php echo (L("SERVICE")); ?></a></li>
	                    </ul>
	                </li>
	            </ul><?php endif; ?>
        </div>
		<div class="col-xs-4 tonline">
        	<div class="footer-btn">
	            <button type="button" class="btn btn-danger">
	                	<?php echo (L("service_hotline")); ?>
	            </button>
			</div>
            <h1 style="color:#060001;">0755-23016026</h1>
            <p><?php echo (L("WORK_TIME")); ?></p>
        </div>
    </div>
</div>
<footer id="footer">
	<div class="container">
		<p style="color:#343434;"><?php echo (L("Company")); ?></p>
		<p style="color:#a4a5a6 !important;"><?php echo (L("Company_S")); ?> © <?php echo (L("All_Reserved")); ?> <?php echo (L("Copy")); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo (L("Adress")); ?></p>
	</div>
</footer>



<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	// //设置垂直居中
	// $('.carousel-control').css('line-height', $('.carousel-inner img').height() + 'px');
	// $(window).resize(function () {
	// 	var $height = $('.carousel-inner img').eq(0).height() || 
	// 				  $('.carousel-inner img').eq(1).height() || 
	// 				  $('.carousel-inner img').eq(2).height();
	// 	$('.carousel-control').css('line-height', $height + 'px');
	// });

	//设置文字垂直居中，谷歌浏览器加载图片的顺序问题，导致高度无法获取
	$(window).load(function () {
		$('.text').eq(0).css('margin-top', ($('.auto').eq(0).height() - $('.text').eq(0).height()) / 2 + 'px');
	});
	

	$(window).resize(function () {
		$('.text').eq(0).css('margin-top', ($('.auto').eq(0).height() - $('.text').eq(0).height()) / 2 + 'px');
	});

	$(window).load(function () {
		$('.text').eq(1).css('margin-top', ($('.auto').eq(1).height() - $('.text').eq(1).height()) / 2 + 'px');
	});

	$(window).resize(function () {
		$('.text').eq(1).css('margin-top', ($('.auto').eq(1).height() - $('.text').eq(1).height()) / 2 + 'px');
	});

</script>
<!--end footer--> 
</body>
</html>