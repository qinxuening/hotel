<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo (L("Find_pw")); ?></title>
<link rel="stylesheet" href="/Public/resource/common/css/base.css" >
<link rel="stylesheet" href="/Public/resource/common/css/user.css">
<link rel="stylesheet" href="/Public/resource/common/js/validform/style.css" >
<link rel="shortcut icon" href="/Public/resource/common/images/favicon.ico" type="image/x-icon" />
<script src="/Public/resource/common/js/jquery.js"></script>
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
    <div class="user_box clearfix" id="pw_wrap">
      <div class="pw_pathway"><a href="/index.php/Lostpassword/" ><?php echo (L("Find_pw")); ?></a> > <?php echo (L("Ename")); ?> </div>
      <ul class="pw_nav">
        <li class="pw_nav_1_a"><?php echo (L("Ename")); ?></li>
        <li class="pw_nav_2"><?php echo (L("Identity")); ?></li>
        <li class="pw_nav_3"><?php echo (L("Re_pw")); ?></li>
        <li class="pw_nav_4"><?php echo (L("Complete")); ?></li>
      </ul>
      <!--第1步-->
      <div class="pw_step1">
        <form class="pw_form" action="/index.php/Lostpassword/mobile/" method="post">
          <div class="pw_form_row">
            <label class="pw_label"><?php echo (L("Username")); ?>：</label>
            <input type="text" class="pw_text"  id="wUseID" name="wUseID" ajaxurl="/index.php/Home/Lostpassword/CheckMobile/" datatype="s3-16" maxlength="16" sucmsg="<?php echo (L("Crepass")); ?>"  errormsg="<?php echo (L("Y_user_e")); ?>" nullmsg="<?php echo (L("Y_user_n")); ?>" >
          </div>
          <div>
            <input type="submit" value="<?php echo (L("Next")); ?>"   class="m_btn_blue_s">
            <span class="valid_tip"></span> </div>
        </form>
        <p class="pw_tips"> <?php echo (L("Warmt")); ?>：<br>
          <?php echo (L("NSensitive")); ?><br><br>
          </p>
      </div>
      
    </div>
  </div>
</div>
<div class="clear-none"></div>
<script src="/Public/resource/common/js/Validform.js"></script>
<script type="text/javascript">
$(function(){
var demo=$(".pw_form").Validform({
		tiptype:3,
		label:".label",
		showAllError:false,
		datatype:{
			"zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
		},
		//beforeSubmit:do_encrypt,
		ajaxPost:false
	});
	demo.tipmsg.c = "<?php echo (L("Cmobile_check")); ?>";
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