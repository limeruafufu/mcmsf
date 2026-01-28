<?php
$mod = 'admin';
$title='管理设置';
include('../Common/Core_brain.php');
if($adminData['adminRank']== 2) {
	echo "您的账号没有权限使用此功能";
	exit;
}
include './head.php';
?>
<?php
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='add'){
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        添加管理员
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">管理员列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            添加管理员
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 添加管理员 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return addAdmin(this)" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="name"><b>名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminUser" value="" placeholder="请输入管理员登录账号">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="name"><b>密码</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminPwd" value="" placeholder="请输入管理员登录密码">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="qq"><b>QQ</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminQq" value="" placeholder="请输入管理员QQ号">
                                </div>
                                <div class="col-lg-8 col-xl-5">
                                    <div class="mb-4">
                                        <label class="form-label" for="adminRank"><b>管理员等级</b></label>
                                        <select class="form-select" name="adminRank">
                                            <option value="1">系统管理员</option>
                                            <option value="2">普通管理员</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1);return false;">
                            <i class="fa fa-arrow-right-arrow-left opacity-50 me-1"></i> <b>返回列表</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}elseif($my=='edit'){
$id=intval($_GET['id']);
if($id==1){echo "<script>layer.ready(function(){layer.msg('如果想修改该用户信息<br/>请前往修改密码页面修改', {icon: 2, time: 1500}, function(){window.location.href='javascript:history.go(-1)'});});</script>";exit();}
$row=$DB->getRow("select * from nteam_admin where id='$id' limit 1");
if(!$row){echo "<script>layer.ready(function(){layer.msg('该管理员不存在', {icon: 2, time: 1500}, function(){window.location.href='javascript:history.go(-1)'});});</script>";exit();}
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        修改管理员
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">管理员列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            修改管理员
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 修改管理员信息 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return editAdmin(this)" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="name"><b>名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminUser" value="<?php echo $row['adminUser'];?>" placeholder="请输入管理员登录账号">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="qq"><b>密码</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminPwd" value="" placeholder="请输入管理员密码(不修改请留空)">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="describe"><b>QQ</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminQq" value="<?php echo $row['adminQq'];?>" placeholder="请输入QQ号">
                                </div>
                                <div class="col-lg-8 col-xl-5">
                                    <div class="mb-4">
                                        <label class="form-label" for="adminRank"><b>管理员等级</b></label>
                                        <select class="form-select" name="adminRank">
                                            <?php if($row['adminRank'] == 1){echo '<option value="1" selected>系统管理员</option><option value="2">普通管理员</option>'; }else{ echo '<option value="1">系统管理员</option><option value="2" selected>普通管理员</option>';}?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1);return false;">
                            <i class="fa fa-arrow-right-arrow-left opacity-50 me-1"></i> <b>返回列表</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include 'foot.php'?>
<script>
	function addAdmin(obj){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});
	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=AddAdmin',
	    data : $(obj).serialize(),
	    dataType : 'json',
	    success : function(data) {
	      layer.close(ii);
	      if(data.code == 0){
	        layer.alert(data.msg, {icon: 1,closeBtn: false}, function(){window.location.reload()});
	      }else{
	        layer.alert(data.msg, {icon: 2})
	      }
	    },
	    error:function(data){
	      layer.msg('服务器错误');
	      return false;
	    }
	  });
	  return false;
	}
	function editAdmin(obj){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});

	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=EditAdmin',
	    data : $(obj).serialize(),
	    dataType : 'json',
	    success : function(data) {
	      layer.close(ii);
	      if(data.code == 0){
	        layer.alert(data.msg, {icon: 1,closeBtn: false}, function(){window.location.reload()});
	      }else{
	        layer.alert(data.msg, {icon: 2})
	      }
	    },
	    error:function(data){
	      layer.msg('服务器错误');
	      return false;
	    }
	  });
	  return false;
	}
</script>
</body>
</html>