<?php
$mod = 'admin';
$title='网站信息配置';
include('../Common/Core_brain.php');
if($adminData['adminRank']== 2) {
  echo "您的账号没有权限使用此功能";
  exit;
}
include './head.php';
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        <?php echo $title ?>
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">后台首页</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <?php echo $title ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 网站信息设置 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return saveSetting(this)" method="post" name="edit-form">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="Name"><b>网站名称</b></label>
                                    <input type="text" class="form-control form-control-lg" name="Name" value="<?php echo conf('Name');?>" placeholder="请输入网站名称">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="SiteName"><b>网站标题</b></label>
                                    <input type="text" class="form-control form-control-lg" name="SiteName" value="<?php echo conf('SiteName');?>" placeholder="请输入网站简称">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-4">
                                <label class="form-label" for="Url"><b>网站域名</b></label>
                                <input type="text" class="form-control form-control-lg" id="Url" name="Url" value="<?php echo conf('Url');?>" placeholder="请输入网站域名">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-mb-5">
                            <div class="mb-4">
                                <label class="form-label" for="Iindex_Image"><b>首页背景图</b></label>
                                <input type="text" class="form-control form-control-lg" id="index_image" name="index_image" value="<?php echo conf('Index_Image');?>" placeholder="请输入首页背景图Url">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label" for="Descriptison"><b>网站描述</b></label>
                                <textarea class="form-control form-control-lg" rows="4" name="Descriptison" placeholder="请输入站点描述"><?php echo conf('Descriptison');?></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="Vaptcha_Open"><b>系统人机验证开关</b></label>
                                <div class="space-x-2">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="Vaptcha_Open" value="0" <?=conf('Vaptcha_Open')==0?"checked":""?>>禁用
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="Vaptcha_Open" value="1" <?=conf('Vaptcha_Open')==1?"checked":""?>>启用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="Index_Fang"><b>防止xxs扒站JS开关</b></label>
                                <div class="space-x-2">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="index_fang" value="0" <?=conf('Index_Fang')==0?"checked":""?>>禁用
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="index_fang" value="1" <?=conf('Index_Fang')==1?"checked":""?>>启用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="Jump"><b>QQVX访问跳出提示页</b></label>
                                <div class="space-x-2">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="Jump" value="0" <?=conf('Jump')==0?"checked":""?>>禁用
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="Jump" value="1" <?=conf('Jump')==1?"checked":""?>>启用
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-4">
                                <label class="form-label" for="Keywords"><b>网站关键词</b></label>
                                <input type="text" class="form-control form-control-lg" name="Keywords" value="<?php echo conf('Keywords');?>" placeholder="请输入站点关键词">
                            </div>
                            <div class="col-mb-5">
                                <div class="mb-4">
                                    <label class="form-label" for="ICP"><b>ICP备案号</b></label>
                                    <input type="text" class="form-control form-control-lg" id="ICP" name="ICP" value="<?php echo conf('ICP');?>" placeholder="请输入ICP备案号">
                                </div>
                            </div>
                            <div class="col-mb-5">
                                <div class="mb-4">
                                    <label class="form-label" for="Vaptcha_Vid"><b>人机验证单元Vid &nbsp;&nbsp; <small>前往<a href="https://www.vaptcha.com/" target="_blank"> Vaptcha </a>免费注册开通</small></b></label>
                                    <input type="text" class="form-control form-control-lg" id="Vaptcha_Vid" name="Vaptcha_Vid" value="<?php echo conf('Vaptcha_Vid');?>" placeholder="请输入人机验证单元Vid">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'foot.php'?>
<script>
function checkURL(obj)
{
  var url = $(obj).val();

  if (url.indexOf(" ")>=0){
    url = url.replace(/ /g,"");
  }
  if (url.toLowerCase().indexOf("http://")<0 && url.toLowerCase().indexOf("https://")<0){
    url = "http://"+url;
  }
  if (url.slice(url.length-1)!="/"){
    url = url+"/";
  }
  $(obj).val(url);
}
function saveSetting(obj){
  var ii = layer.load(2, {shade:[0.1,'#fff']});
  $.ajax({
    type : 'POST',
    url : 'ajax.php?act=set',
    data : $(obj).serialize(),
    dataType : 'json',
    success : function(data) {
      layer.close(ii);
      if(data.code == 0){
        layer.alert(data.msg, {
          icon: 1,
          closeBtn: false
        }, function(){
          window.location.reload()
        });
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
function saveSettings(obj){
  var ii = layer.load(2, {shade:[0.1,'#fff']});
  $.ajax({
    type : 'POST',
    url : 'ajax.php?act=sets',
    data : $(obj).serialize(),
    dataType : 'json',
    success : function(data) {
      layer.close(ii);
      if(data.code == 0){
        layer.alert(data.msg, {
          icon: 1,
          closeBtn: false
        }, function(){
          window.location.reload()
        });
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