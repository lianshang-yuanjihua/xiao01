<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\WWW\workspace\sanqiplan\public/../application/admin\view\user\login.html";i:1539939640;s:66:"D:\WWW\workspace\sanqiplan\application\admin\view\public\base.html";i:1539936747;s:69:"D:\WWW\workspace\sanqiplan\application\admin\view\public\message.html";i:1539936966;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>源动力后台</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/workspace/sanqiplan/public/static/lib/xadmin/css/font.css">
    <link rel="stylesheet" href="/workspace/sanqiplan/public/static/lib/xadmin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/workspace/sanqiplan/public/static/lib/xadmin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/workspace/sanqiplan/public/static/lib/xadmin/js/xadmin.js"></script>
</head>
<body class="login-bg">
    <!-- 顶部开始 -->
    
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
     
    <!-- 右侧主体开始 -->
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">源动力管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form action="<?php echo url('user/doLogin'); ?>" method="post" class="layui-form" >
            <input name="nickname" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
            <?php echo token(); ?>
        </form>
    </div>
    <!-- 底部结束 -->

    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    
    <!-- 底部结束 -->
    <!-- 提示模块 -->
    <?php if(\think\Session::get('errorMsg')): ?>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
  var layer = layui.layer;
  
  layer.msg('<?php echo \think\Session::get('errorMsg'); ?>',{icon:2});
}); 
    })
	</script>
	<?php echo session('errorMsg',null); elseif(\think\Session::get('successMsg')): ?>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
  var layer = layui.layer;
  
  layer.msg('<?php echo \think\Session::get('successMsg'); ?>',{icon:1});
}); 
    })
</script>
<?php echo session('successMsg',null); endif; ?>

    <!-- 提示模块 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>