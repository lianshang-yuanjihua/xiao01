<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\WWW\workspace\sanqiplan\public/../application/index\view\user\cart.html";i:1539918925;s:66:"D:\WWW\workspace\sanqiplan\application\index\view\public\base.html";i:1539859368;s:65:"D:\WWW\workspace\sanqiplan\application\index\view\public\nav.html";i:1539858316;s:69:"D:\WWW\workspace\sanqiplan\application\index\view\public\message.html";i:1539845037;}*/ ?>
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
		
	
<link rel="stylesheet" type="text/css" href="/workspace/sanqiplan/public/static/css/cart.css">

</head>
<body>
<header class="mui-bar mui-bar-nav" style="background:#f5ba4c">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			购物车
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
<div class="mui-content" style="background-color:#fafafa">
			<div class="mui-card">
				<div class="by-gwc-fl" style="height:100px ;margin-top:14vw;margin-left:-10px">
					<div class="mui-input-row mui-checkbox mui-left">
						<label>&nbsp;</label>
						<input name="checkbox" value="Item 1" type="checkbox">
					</div>
				</div>
				<div class="by-gwc-fl" style="margin-top:8vw">
					<img src="/workspace/sanqiplan/public/static/images/09.png" style="width: 50px;height:80px;" />
				</div>
				<div class="by-gwc-fl" style="width:65%;float:right">
					<div class="mui-card by-card" style="box-shadow: none;">

						<div class="mui-card-content">
							<div class="mui-card-content-inner" style="padding:0 5px;">
								<p>
									<h4 style="text-align: center;">人参萃取精华丸</h4>
								</p>
								<p style="color: #9b9b9b;padding:0 10px; font-size: 12px;">详情：人参萃取精华丸，中成药名，药食同源，连续服用...</p>
							</div>
						</div>
						<div class="mui-card-footer">
							<a class="mui-card-link"><span style="color:#727272"><text style="color:#ff0303">650元 /盒</text></span></a>

							<div class="mui-numbox" style="width:110px;height:25px">
								<button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
								<input class="mui-input-numbox" type="number" />
								<button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="by-jz">
				<div style="width: 40%;float:left">
					<div class="mui-input-row mui-checkbox mui-left">
						<label>全选</label>
						<input name="checkbox" value="Item 2" type="checkbox" checked style="top:9px;">
					</div>
				</div>
				<div class="by=jz-rt" style="width: 60%;float:left;color:#a7a7a7">
					合计：<text style="color:#ff0303">44655</text>
					<a href="javascript:void(0)" class="by-jz-btn">结算</a>
				</div>
			</div>
		</div>
		<div class="mui-content mui-text-center mui-hidden" style="height:100%">
			<div class="by-gwc-ktxt">
				<h4 style="color:#929292">购物车快饿扁了T.T</h4>
				<h5 style="color:#aeaeae">快给我挑点东西吧</h5>
				<a href="javascript:void(0)">去逛逛</a>
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