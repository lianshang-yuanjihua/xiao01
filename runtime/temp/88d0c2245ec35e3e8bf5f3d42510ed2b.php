<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"D:\PHP\WWW\workspace\xiao01\public/../application/index\view\user\login.html";i:1542455496;s:67:"D:\PHP\WWW\workspace\xiao01\application\index\view\public\base.html";i:1542455496;s:70:"D:\PHP\WWW\workspace\xiao01\application\index\view\public\message.html";i:1542455496;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>源动力</title>
		<script src="/static/js/jquery-3.3.1.min.js"></script>
		<script src="/static/lib/mui/js/mui.min.js"></script>
		<script src="/static/lib/mui/js/util.js"></script>
		<link rel="stylesheet" href="/static/lib/mui/css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="/static/lib/mui/css/icons-extra.css" />
		
	
<link rel="stylesheet" type="text/css" href="/static/css/login.css">

</head> 
<body>
	<header class="mui-bar mui-bar-nav" style="background:#f5ba4c;-webkit-box-shadow: 0 1px 6px #f5ba4c;">
	<a class="mui-icon mui-action-back mui-icon-left-nav mui-pull-left" id="backleft" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			登录
	</h1>
	<a class=" mui-icon mui-icon-more mui-pull-right" style="color:#fff"></a>
</header>
	
	
    <div class="mui-content" style="background-color:#fafafa">
        <form action="<?php echo url('user/doLogin'); ?>" method="post">
            <div class="">
            <div id="input_example" class="mui-input-group" style="margin-top: 30px;">
                <div class="mui-input-row">
                    <label><span class="mui-icon mui-icon-phone"></span></label>
                    <input id="username" type="text" name="mobile" class="mui-input-clear" placeholder="请输入用户名" id="username">
                </div>
                <div class="mui-input-row">
                    <label><span class="mui-icon mui-icon-locked"></span></label>
                    <input id="password" type="password" name="password" class="mui-input-clear mui-input-password" placeholder="请输入密码" id="password">
                </div> 
             </div>
        </div>
            <div class="mui-content-padded">
                <button id='login' class="mui-btn mui-btn-block " style="background-color:#f5ba4c ;border:none;color:#fff;border-radius: 25px;">登录</button>
                <div class="link-area"><a id='reg' href="<?php echo url('user/register'); ?>">注册账号</a> <span class="spliter" style="color:#f5ba4c">|</span> <a id='forgetPassword' href="#">忘记密码</a>
                </div>
            </div>
            <?php echo token(); ?>
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
    <script src="/static/js/rem.js"></script>
	<?php if(\think\Session::get('errorMsg')): ?>

<script type="text/javascript">
	mui.toast('<?php echo \think\Session::get('errorMsg'); ?>');
	</script>
	<?php echo session('errorMsg',null); elseif(\think\Session::get('successMsg')): ?>
<script type="text/javascript">
	mui.toast('<?php echo \think\Session::get('successMsg'); ?>');
</script>
<?php echo session('successMsg',null); endif; ?>
	
	
</body>
</html>