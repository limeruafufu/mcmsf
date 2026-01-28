<?php
$mod = 'admin';
$title='成员设置';
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
                        添加成员
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">成员列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            添加成员
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 添加成员 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return addMember(this)" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="name"><b>名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="name" value="" placeholder="请输入成员名称">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="qq"><b>QQ</b></label>
                                    <input type="text" class="form-control form-control-lg" name="qq" value="" placeholder="请输入QQ号">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="describe"><b>成员描述</b></label>
                                <textarea class="form-control" name="describe" rows="5" placeholder="请输入描述，换行用<br>"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label" for="teamimg"><b>成员背景图</b></label>
                                    <input type="text" class="form-control form-control-lg" name="teamimg" value="" placeholder="请输入成员背景图片">
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="status"><b>显示首页</b></label>
                                        <select class="form-select" name="is_show">
                                            <option value="1">正常</option>
                                            <option value="0">暂停</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="status"><b>审核状态</b></label>
                                        <select class="form-select" name="Audit_status">
                                            <option value="1">通过</option>
                                            <option value="0">未通过</option>
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
$row=$DB->getRow("select * from nteam_team_member where id='$id' limit 1");
if(!$row){echo "<script>layer.ready(function(){layer.msg('该成员不存在', {icon: 2, time: 1500}, function(){window.location.href='javascript:history.go(-1)'});});</script>";exit();}
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        修改成员
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">成员列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            修改成员
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 修改成员 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <?php echo '<form onsubmit="return editMember(this,'.$id.')" method="POST" class="row">';?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="name"><b>名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="name" value="<?php echo $row['name'];?>" placeholder="请输入成员名称">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="qq"><b>QQ</b></label>
                                    <input type="text" class="form-control form-control-lg" name="qq" value="<?php echo $row['qq'];?>" placeholder="请输入QQ号">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="describe"><b>成员描述</b></label>
                                <textarea class="form-control" name="describe" rows="5" placeholder="请输入描述，换行用<br>"><?php echo $row['describe'];?></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label" for="teamimg"><b>成员背景图</b></label>
                                    <input type="text" class="form-control form-control-lg" name="teamimg" value="<?php echo $row['teamimg'];?>" placeholder="请输入成员背景图片">
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="status"><b>显示首页</b></label>
                                        <select class="form-select" name="is_show">
                                            <?php if($row['is_show'] == 1){echo '<option value="1" selected>正常</option><option value="0">暂停</option>'; }else{ echo '<option value="1">正常</option><option value="0" selected>暂停</option>';}?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="status"><b>审核状态</b></label>
                                        <select class="form-select" name="Audit_status">
                                            <?php if($row['Audit_status'] == 1){echo '<option value="1" selected>通过</option><option value="0">未通过</option>'; }else{ echo '<option value="1">通过</option><option value="0" selected>未通过</option>';}?>
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
	function addMember(obj){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});
	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=setMember&type=Add',
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
	function editMember(obj,id){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});

	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=setMember&type=Edit&id='+id,
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