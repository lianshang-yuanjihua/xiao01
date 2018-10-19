<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\WWW\workspace\sanqiplan\public/../application/index\view\user\register.html";i:1539839037;s:70:"D:\WWW\workspace\sanqiplan\application\index\view\public\userbase.html";i:1539844592;s:69:"D:\WWW\workspace\sanqiplan\application\index\view\public\message.html";i:1539845037;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>源动力</title>
	<link rel="stylesheet" href="/workspace/sanqiplan/public/static/css/register.css">
	
</head>
<body>
	<header id="header">
        <a href="javascript:history.go(-1)"  class="head_left">
        	<i class="layui-icon-left">&#xe603;</i>
        </a>
        <span>注册</span>
        <a href="javascript:void(0)" class="head_right">
        <img src="/workspace/sanqiplan/public/static/images/qita.png" alt="" srcset=""></a>
    </header>
	
<div class="container">
        <form action="<?php echo url('user/doRegister'); ?>" name="tijiao" method="post" id="by_form">
            <input type="hidden" name="pid" value="0">
            <div id="name">
                <label><img src="/workspace/sanqiplan/public/static/images/name.png" alt="" srcset=""></label>
                <input type="text" placeholder="请输入昵称" name="nickname" id="name_input">
                
            </div>
            <div id="tell">
                <label><img src="/workspace/sanqiplan/public/static/images/tell.png" alt="" srcset=""></label>
                <input type="text" placeholder="请输入手机号码" name="mobile" id="tell_input">
                
            </div>
           
            <div id="pwd">
                <label><img src="/workspace/sanqiplan/public/static/images/pwd.png" alt="" srcset=""></label>
                <input type="password" placeholder="请输入密码" name="password" id="pwd_input">
                
            </div>
            <div id="rpwd">
                <label><img src="/workspace/sanqiplan/public/static/images/pwd.png" alt="" srcset=""></label>
                <input type="password" placeholder="请确认密码" name="repassword" id="rpwd_input">
                
            </div>
            <button type="submit" class="by_submit" style="top:25rem">注册</button>
            <?php echo token(); ?>
        </form>
           
    </div>

	
	
	<script src="/workspace/sanqiplan/public/static/js/jquery-3.3.1.min.js"></script>
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