<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\WWW\workspace\sanqiplan\public/../application/index\view\index\index.html";i:1539918903;s:66:"D:\WWW\workspace\sanqiplan\application\index\view\public\base.html";i:1539859368;s:65:"D:\WWW\workspace\sanqiplan\application\index\view\public\nav.html";i:1539858316;s:69:"D:\WWW\workspace\sanqiplan\application\index\view\public\message.html";i:1539845037;}*/ ?>
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
		
	
	<link rel="stylesheet" type="text/css" href="/workspace/sanqiplan/public/static/css/index.css">

</head>
<body>
<header class="mui-bar mui-bar-nav" style="background:#f5ba4c">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			
<div class="mui-input-row "  style="width:60vw;height:35px;margin:0 auto" >
			<input type="search" class="mui-input-clear"placeholder="">
		</div>

	</h1>
	<a class=" mui-icon mui-icon-more mui-pull-right" style="color:#fff"></a>
</header>
	
<nav class="mui-bar mui-bar-tab">
	<a class="mui-tab-item<?php echo \think\Request::instance()->action()=='index'?' mui-active':''; ?>" onclick="location.href='<?php echo url('index/index'); ?>'">
		<span class="mui-icon mui-icon-home"></span>
		<span class="mui-tab-label">首页</span>
	</a>
	<a class="mui-tab-item<?php echo \think\Request::instance()->action()=='help'?' mui-active':''; ?>" onclick="location.href='<?php echo url('index/help'); ?>'">
		<span class="mui-icon mui-icon-extra mui-icon-extra-dictionary"></span>
		<span class="mui-tab-label">帮助</span>
	</a>
	<a class="mui-tab-item<?php echo \think\Request::instance()->action()=='cart'?' mui-active':''; ?>" onclick="location.href='<?php echo url('user/cart'); ?>'">
		<span class="mui-icon mui-icon-extra mui-icon-extra-cart"></span>
		<span class="mui-tab-label">购物车</span>
	</a>
	<a class="mui-tab-item<?php echo \think\Request::instance()->action()=='usercenter'?' mui-active':''; ?>" onclick="location.href='<?php echo url('user/usercenter'); ?>'">
		<span class="mui-icon mui-icon-person"></span>
		<span class="mui-tab-label">个人中心</span>
	</a>
</nav>
<div class="mui-content">
			<div id="slider" class="mui-slider" style="height:150px">
				<div class="mui-slider-group mui-slider-loop">
					<!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png"/>
					</div>
					<!-- 第一张 -->
					<div class="mui-slider-item">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png" >
						</a>
					</div>
					<!-- 第二张 -->
					<div class="mui-slider-item">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png" >
						</a>
					</div>
					<!-- 第三张 -->
					<div class="mui-slider-item">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png" >
						</a>
					</div>
					<!-- 第四张 -->
					<div class="mui-slider-item">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png" >
						</a>
					</div>
					<!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="#">
							<img src="/workspace/sanqiplan/public/static/images/1.png" >
						</a>
					</div>
				</div>
				<div class="mui-slider-indicator">
					<div class="mui-indicator mui-active"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
				</div>
			</div>
			<div class="mui-card by-card" style="box-shadow: none;">
				<div class=" mui-card-media" style="height:65vw;background-image:url(/workspace/sanqiplan/public/static/images/yp.png)"></div>
				<div class="mui-card-content">
					<div class="mui-card-content-inner" style="padding:0 5px;">
						<p><h3  style="text-align: center;">人参萃取精华丸</h3></p>
						<p style="color: #9b9b9b;padding:0 10px;">详情：人参萃取精华丸，中成药名，药食同源，连续服用，本品3个月，活化肾脏.精满.气足.神旺...</p>
					</div>
				</div>
				<div class="mui-card-footer">
					<a class="mui-card-link"><span style="color:#727272">零售价：<text style="color:red">650  元 / 盒</text></span></a>
					<a class="mui-card-link"><span style="width:160px;height:40px;line-height:40px;border-radius: 15px;background-color:#f5ba4c;color:#fff;text-align: center;font-size: 16px;">点击了解详情</span></a>
				</div>
			</div>
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