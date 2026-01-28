<?php
$mod = 'admin';
$title='拓展设置';
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
                <h3 class="block-title"> 拓展设置 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form onsubmit="return saveSettings(this)" method="post" name="edit-form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="Statistics_Id"><b>51.LA网站统计ID &nbsp; <small><a href="//51.la/" target="_blank">前往51.LA获取</a></small></b></label>
                                    <input type="text" class="form-control form-control-lg" name="Statistics_Id" value="<?php echo conf_index('Statistics_Id');?>" placeholder="请输入网站统计ID">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="Statistics_Dm"><b>51.LA网站统计数据挂件地址 &nbsp; <small><a href="//51.la/" target="_blank">前往51.LA获取</a></small></b></label>
                                    <input type="text" class="form-control form-control-lg" name="Statistics_Dm" value="<?php echo conf_index('Statistics_Dm');?>" placeholder="只需填写script中的src地址即可">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="Index_Music"><b>明月浩空音乐播放器ID &nbsp; <small><a href="https://myhkw.cn/" target="_blank">前往获取</a></small></b></label>
                                    <input type="text" class="form-control form-control-lg" name="Index_Music" value="<?php echo conf_index('Index_Music');?>" placeholder="请输入播放器代码">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="Index_Tc"><b>首页自定义弹窗内容</b></label>
                                    <input type="text" class="form-control form-control-lg" name="Index_Tc" value="<?php echo conf_index('Index_Tc');?>" placeholder="请输入自定义弹窗内容">
                                </div>
                            </div>
                            <div class="col-md-15">
                                <div class="mb-4 text-center">
                                    <label class="form-label" for="Notice"><b>站点公告</b></label>
                                    <textarea class="form-control form-control-lg" rows="4" name="Notice" placeholder="请输入站点后台公告(换行代码<br>)"><?php echo conf_index('Notice');?></textarea>
                                </div>
                                </dvi>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check opacity-50 me-1"></i> <b>保存设置</b>
                                </button>
                            </div>
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