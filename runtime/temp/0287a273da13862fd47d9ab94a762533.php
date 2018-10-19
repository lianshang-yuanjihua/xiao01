<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\WWW\workspace\sanqiplan\public/../application/index\view\user\login.html";i:1539852185;s:66:"D:\WWW\workspace\sanqiplan\application\index\view\public\base.html";i:1539859368;s:69:"D:\WWW\workspace\sanqiplan\application\index\view\public\message.html";i:1539845037;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>源动力</title>
		<script src="/workspace/sanqiplan/public/static/js/jquery-3.3.1.min.js"></script>
		<script src="/workspace/sanqiplan/public/static/lib/mui/js/mui.min.js"></script>
		<script src="/workspace/sanqiplan/public/static/lib/mui/js/util.js"></script>
		<link rel="stylesheet" href="/workspace/sanqiplan/public/static/lib/mui/css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="/workspace/sanqiplan/public/static/lib/mui/css/icons-extra.css" />
		
	
</head>
<body>
<header class="mui-bar mui-bar-nav" style="background:#f5ba4c">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			登录
	</h1>
	<a class=" mui-icon mui-icon-more mui-pull-right" style="color:#fff"></a>
</header>
	
    <div class="container">
        <form action="<?php echo url('user/doLogin'); ?>" name="tijiao" method="post" id="by_form">
           
            <div id="tell">
                <label><img src="/workspace/sanqiplan/public/static/images/tell.png" alt="" srcset=""></label>
                <input type="text" name="mobile" placeholder="请输入手机号码"  >
            </div>
           
            <div id="pwd">
                <label><img src="/workspace/sanqiplan/public/static/images/pwd.png" alt="" srcset=""></label>
                <input type="password" name="password"  placeholder="请输入密码">
            </div>
            
            
                <button type="submit" class="by_submit ">登录</button>
                <button type="submit" class="by_submit " id="zmm" stype="">注册</button>
        </form>
    </div>

	
	
		<script type="text/javascript">

			(function() {
				mui.init({
					swipeBack: true //启用右滑关闭功能
				});
				var slider = mui("#slider");
				slider.slider({
					interval: 2000
				});
				
			})();

		</script>
    <script src="/workspace/sanqiplan/public/static/js/rem.js"></script>
	<?php if(\think\Session::get('errorMsg')): ?>

<script type="text/javascript">
	console.log('<?php echo \think\Session::get('errorMsg'); ?>');
	</script>
	<?php echo session('errorMsg',null); elseif(\think\Session::get('successMsg')): ?>
<script type="text/javascript">
	console.log('<?php echo \think\Session::get('successMsg'); ?>');
</script>
<?php echo session('successMsg',null); endif; ?>
	
	
</body>
</html>