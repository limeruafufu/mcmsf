<?php
$mod = 'admin';
$title='项目设置';
include('../Common/Core_brain.php');
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
                        添加项目
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">项目列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            添加项目
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 添加项目 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return addProject(this)" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="title"><b>项目名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="name" value="" placeholder="请输入项目名称">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="url"><b>项目网址</b></label>
                                    <input type="text" class="form-control form-control-lg" name="url" value="" placeholder="请输入项目网址，不加http://和/">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="img"><b>项目图片</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img" value="" placeholder="请输入项目的图片Url">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="img2"><b>项目图片2</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img2" value="" placeholder="请输入项目的图片Url">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="img3"><b>项目图片3</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img3" value="" placeholder="请输入项目的图片Url">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="sketch"><b>项目简述</b></label>
                                    <input type="text" class="form-control form-control-lg" name="sketch" value="" placeholder="请输入项目的简单介绍（用于首页显示）">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="money"><b>项目售价</b></label>
                                    <input type="text" class="form-control form-control-lg" name="money" value="" placeholder="请输入项目的售价">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="version"><b>项目版本号</b></label>
                                    <input type="text" class="form-control form-control-lg" name="version" value="" placeholder="请输入项目的当前版本号">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="descriptison"><b>项目描述</b></label>
                                <textarea class="form-control" name="descriptison" rows="5" value="" placeholder="请输入项目的具体描述（用于项目页）"></textarea>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="paycontact"><b>购买联系方式</b></label>
                            <input type="text" class="form-control form-control-lg" name="paycontact" value="" placeholder="请输入购买联系方式">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="type"><b>项目类型</b></label>
                            <select class="form-select" name="type" size="1">
                                <option value="1">成员服</option>
                                <option value="0">MCJPG</option>
                                <option value="2">MSCPO</option>
                                <option value="3">其他平台</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="status"><b>显示首页</b></label>
                            <select class="form-select" name="is_show" size="1">
                                <option value="1">正常</option>
                                <option value="0">暂停</option>
                            </select>
                        </div>
                        <?php if($adminData['adminRank'] == 1) {?>
                            <div class="mb-4">
                                <label class="form-label" for="status"><b>审核状态</b></label>
                                <select class="form-select" name="Audit_status" size="1">
                                    <option value="1">通过</option>
                                    <option value="0">未通过</option>
                                </select>
                            </div>
                        <?php }?>
                        <div class="mb-4">
                            <label class="form-label" for="status"><b>项目状态</b></label>
                            <select class="form-select" name="status" size="1">
                                <option value="1">正常运营</option>
                                <option value="0">暂停运营</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                        </button>
                        <button type="submit" class="btn btn-primary" onclick="javascript:history.back(-1);return false;">
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
$row=$DB->getRow("select * from nteam_project_list where id='$id' limit 1");
if(!$row){echo "<script>layer.ready(function(){layer.msg('该项目不存在', {icon: 2, time: 1500}, function(){window.location.href='javascript:history.go(-1)'});});</script>";exit();}
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        修改项目
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">项目列表</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            修改项目
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 修改 <?php echo $row['name'];?> 项目信息 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <?php echo '<form onsubmit="return editProject(this,'.$id.')" method="POST" class="row">';?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="title"><b>项目名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="name" value="<?php echo $row['name'];?>" placeholder="请输入项目名称">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="url"><b>项目网址</b></label>
                                    <input type="text" class="form-control form-control-lg" name="url" value="<?php echo $row['url'];?>" placeholder="请输入项目网址，不加http://和/">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="img"><b>项目图片</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img" value="<?php echo $row['img'];?>" placeholder="请输入项目的图片Url">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="img2"><b>项目图片2</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img2" value="<?php echo $row['img2'];?>" placeholder="请输入项目的图片Url">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="img3"><b>项目图片3</b></label>
                                    <input type="text" class="form-control form-control-lg" name="img3" value="<?php echo $row['img3'];?>" placeholder="请输入项目的图片Url">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="sketch"><b>项目简述</b></label>
                                    <input type="text" class="form-control form-control-lg" name="sketch" value="<?php echo $row['sketch'];?>" placeholder="请输入项目的简单介绍（用于首页显示）">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="money"><b>项目售价</b></label>
                                    <input type="text" class="form-control form-control-lg" name="money" value="<?php echo $row['money'];?>" placeholder="请输入项目的售价">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="version"><b>项目版本号</b></label>
                                    <input type="text" class="form-control form-control-lg" name="version" value="<?php echo $row['version'];?>" placeholder="请输入项目的当前版本号">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="descriptison"><b>项目描述</b></label>
                                <textarea class="form-control" name="descriptison" rows="5" placeholder="请输入项目的具体描述（用于项目页）"><?php echo $row['descriptison'];?></textarea>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="paycontact"><b>购买联系方式</b></label>
                            <input type="text" class="form-control form-control-lg" name="paycontact" value="<?php echo $row['paycontact'];?>" placeholder="请输入购买联系方式">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="type"><b>项目类型</b></label>
                            <select class="form-select" name="type" size="1">
                                <?php if($row['type'] == 'web'){echo '<option value="web" selected>单页</option><option value="app">程序</option>'; }else{ echo '<option value="web">单页</option><option value="app" selected>程序</option>';}?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="status"><b>显示首页</b></label>
                            <select class="form-select" name="is_show" size="1">
                                <?php if($row['is_show'] == 1){echo '<option value="1" selected>正常</option><option value="0">暂停</option>'; }else{ echo '<option value="1">正常</option><option value="0" selected>暂停</option>';}?>
                            </select>
                        </div>
                        <?php if($adminData['adminRank'] == 1) {?>
                            <div class="mb-4">
                                <label class="form-label" for="status"><b>审核状态</b></label>
                                <select class="form-select" name="Audit_status" size="1">
                                    <?php if($row['Audit_status'] == 1){echo '<option value="1" selected>通过</option><option value="0">未通过</option>'; }else{ echo '<option value="1">通过</option><option value="0" selected>未通过</option>';}?>
                                </select>
                            </div>
                        <?php }?>
                        <div class="mb-4">
                            <label class="form-label" for="status"><b>项目状态</b></label>
                            <select class="form-select" name="status" size="1">
                                <?php if($row['status'] == 1){echo '<option value="1" selected>正常运营</option><option value="0">暂停运营</option>'; }else{ echo '<option value="1">正常运营</option><option value="0" selected>暂停运营</option>';}?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                        </button>
                        <button type="submit" class="btn btn-primary" onclick="javascript:history.back(-1);return false;">
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
	function addProject(obj){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});
	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=setProject&type=Add',
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
	function editProject(obj,id){
	  var ii = layer.load(2, {shade:[0.1,'#fff']});

	  $.ajax({
	    type : 'POST',
	    url : 'ajax.php?act=setProject&type=Edit&id='+id,
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