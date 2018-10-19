<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\WWW\workspace\sanqiplan\public/../application/admin\view\user\userlist.html";i:1539949131;s:66:"D:\WWW\workspace\sanqiplan\application\admin\view\public\base.html";i:1539945392;s:69:"D:\WWW\workspace\sanqiplan\application\admin\view\public\message.html";i:1539936966;}*/ ?>
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
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body >
    <!-- 顶部开始 -->
    
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
     
    <!-- 右侧主体开始 -->
    
<!-- 右侧主体开始 -->
    <div class="x-nav">
      <!-- <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span> -->
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          <input class="layui-input" disabled placeholder="开始日" name="start" id="start">
          <input class="layui-input" disabled placeholder="截止日" name="end" id="end">
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','./member-add.html',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo $userlist['userCount']; ?> 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>昵称</th>
            <th>性别</th>
            <th>手机</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
          <?php if(is_array($userlist['userlist']) || $userlist['userlist'] instanceof \think\Collection || $userlist['userlist'] instanceof \think\Paginator): $i = 0; $__LIST__ = $userlist['userlist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $user["id"]; ?>'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['nickname']; ?></td>
            <td><?php echo !empty($user['sex'])?'男':'女'; ?></td>
            <td><?php echo $user['mobile']; ?></td>
            <td><?php echo $user['createtime']; ?></td>
            <td class="td-status">
              <span class="layui-btn layui-btn-normal layui-btn-mini">正常</span>
            </td>
            <td class="td-manage">
              <a title="查看"  onclick="x_admin_show('查看','order-view.html')" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
              <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="page">
        <?php echo $userlist['userlist']->render(); ?>
      </div>
    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });



      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
    <!-- 右侧主体结束 -->

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