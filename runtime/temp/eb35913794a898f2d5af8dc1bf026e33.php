<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\PHP\WWW\workspace\xiao01\public/../application/index\view\index\index.html";i:1542455496;s:67:"D:\PHP\WWW\workspace\xiao01\application\index\view\public\base.html";i:1542455496;s:66:"D:\PHP\WWW\workspace\xiao01\application\index\view\public\nav.html";i:1542455496;s:70:"D:\PHP\WWW\workspace\xiao01\application\index\view\public\message.html";i:1542455496;}*/ ?>
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
		
	
	<link rel="stylesheet" type="text/css" href="/static/css/index.css">

</head> 
<body>
	<header class="mui-bar mui-bar-nav" style="background:#f5ba4c;-webkit-box-shadow: 0 1px 6px #f5ba4c;">
	<a class="mui-icon mui-action-back mui-icon-left-nav mui-pull-left" id="backleft" style="color:#fff"></a>
	<h1 class="mui-title" style="color:#fff;font-weight: bold;">
			
源动力

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
<div class="mui-content" style="padding-bottom: 0">
			<div id="slider" class="mui-slider" style="height:150px">

				<div class="mui-slider-group mui-slider-loop">
					
					<!-- 额外增加的第一个节点 -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="javascript:void(0)">
							<?php if(!empty($img['slideimg'][count($img['slideimg'])-1]->path)): ?>
							<img src="/static/upload/<?php echo $img['slideimg'][count($img['slideimg'])-1]->path; ?>" />
							<?php endif; ?>
						</a>
					</div>	
					<?php if(is_array($img['slideimg']) || $img['slideimg'] instanceof \think\Collection || $img['slideimg'] instanceof \think\Paginator): $i = 0; $__LIST__ = $img['slideimg'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$src): $mod = ($i % 2 );++$i;?>
					<!-- 第<?php echo $i; ?>张 -->
					<div class="mui-slider-item">
						<a href="javascript:void(0)">
							<img src="/static/upload/<?php echo $src['path']; ?>">
						</a>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; if(is_array($img['slideimg']) || $img['slideimg'] instanceof \think\Collection || $img['slideimg'] instanceof \think\Paginator): $i = 0; $__LIST__ = $img['slideimg'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$src): $mod = ($i % 2 );++$i;if($i == 1): ?>
					<!-- 额外增加的最后一个节点 -->
					<div class="mui-slider-item mui-slider-item-duplicate">
						<a href="javascript:void(0)">
							<img src="/static/upload/<?php echo $src['path']; ?>">
						</a>
					</div>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="mui-slider-indicator">
					<?php if(is_array($img['slideimg']) || $img['slideimg'] instanceof \think\Collection || $img['slideimg'] instanceof \think\Paginator): $j = 0; $__LIST__ = $img['slideimg'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($j % 2 );++$j;?>
					<div class="mui-indicator <?php echo $j==1?'mui-active':''; ?>"></div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="mui-card by-card" style="box-shadow: none;">
				<div class=" mui-card-media" style="height:65vw;">
					<?php if(!empty($img['cartimg'][0])): ?>
					<img src="/static/upload/<?php echo $img['cartimg'][0]->path; ?>" style="height: 100%">
					<?php endif; ?>
				</div>
				<div class="mui-card-content">
					<div class="mui-card-content-inner" style="padding:0 5px;">
						<p><h3  style="text-align: center;"><?php echo $product['title']; ?></h3></p>
						<p style="color: #9b9b9b;padding:0 10px;">详情：/ <?php echo $_SERVER['SERVER_NAME']?> /<?php echo mb_substr($product['content'],0,42); ?> ...</p>
					</div>
				</div>
				<div class="mui-card-footer">
					<span style="color:#727272;font-weight: bold;">零售价：<text style="color:red"><?php echo $product['price']; ?>  元 / 盒</text></span>
					<a class="mui-card-link" href="<?php echo url('product/detail',['id'=>$product['id']]); ?>"><span style="width:160px;font-weight:bold;height:40px;line-height:40px;border-radius: 15px;background-color:#f5ba4c;color:#fff;text-align: center;font-size: 16px;">点击了解详情</span></a>
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