<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"D:\WWW\workspace\sanqiplan\public/../application/index\view\user\usercenter.html";i:1539921890;s:66:"D:\WWW\workspace\sanqiplan\application\index\view\public\base.html";i:1539859368;s:65:"D:\WWW\workspace\sanqiplan\application\index\view\public\nav.html";i:1539858316;s:69:"D:\WWW\workspace\sanqiplan\application\index\view\public\message.html";i:1539845037;}*/ ?>
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
		
	
    <link rel="stylesheet" type="text/css" href="/workspace/sanqiplan/public/static/css/usercenter.css">

</head>
<body>
<header class="mui-bar mui-bar-nav" style="background:#f5ba4c">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			个人中心
	</h1>
	<a class=" mui-icon mui-icon-more mui-pull-right" style="color:#fff"></a>
</header>
	
    <div class="mui-content" >
            <div class="by-grezy-head">
                <h4>总收入<h4>
                <h2 style="margin:15px;"><?php echo \think\Session::get('userInfo')['total_income']; ?>.00</h2>
                <div class="by-grzx-ye">
                    <span class="">余额 <strong><?php echo \think\Session::get('userInfo')['balance']; ?>.00</strong></span>
                    <span>云仓 <strong><?php echo \think\Session::get('userInfo')['cloudwh']; ?>.00</strong></span>
            </div>
        </div>
        <div class="mui-content" style="background-color:#fafafa">
            
            
            <div class="mui-card">
                <div class="mui-card-header">我的订单</div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <nav class="mui-bar-tab by-car-tab">
                            <a class="mui-tab-item">
                                
                                <span class="mui-icon mui-icon-extra mui-icon-extra-dictionary "></span>
                                <span class="mui-tab-label">待付款</span>
                            </a>
                            <a class="mui-tab-item">
                                <span class="mui-icon  mui-icon-extra mui-icon-extra-outline"></span>
                                <span class="mui-tab-label">待收货</span>
                            </a>
                            <a class="mui-tab-item">
                                <span class="mui-icon mui-icon-extra mui-icon-extra-card"></span>
                                <span class="mui-tab-label">待发货</span>
                            </a>
                            <a class="mui-tab-item">
                                <span class="mui-icon mui-icon-extra mui-icon-extra-express"></span>
                                <span class="mui-tab-label">已发货</span>
                            </a>
                            <a class="mui-tab-item">
                                <span class="mui-icon mui-icon-checkmarkempty"></span>
                                <span class="mui-tab-label">已完成</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="mui-card">
                <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right">
                        
                        <div class="mui-media-body">
                            我的粉丝 <span style="float:right"><?php echo $clientNum; ?></span>
                        </div>
                    </a>
                </li>
                <!-- <li class="mui-table-view-cell mui-media">
                    <a class='mui-navigate-right' href="javascript:;">
                        
                        <div class="mui-media-body">
                            我的库存
                            
                        </div>
                    </a>
                </li> -->
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right">
                        
                        <div class="mui-media-body">
                            售后
                            
                        </div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media">
                    <a class='mui-navigate-right' href="javascript:;">
                        
                        <div class="mui-media-body">
                            关于
                            
                        </div>
                    </a>
                </li>
                <!-- <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right">
                        
                        <div class="mui-media-body">
                            设置
                            
                        </div>
                    </a>
                </li> -->
            </ul>
            </div>
        </div>
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