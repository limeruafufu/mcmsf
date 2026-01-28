<?php
$mod = 'admin';
$title='管理密码修改';
include('../Common/Core_brain.php');
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
                <h3 class="block-title"> 管理密码修改 </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form method="post" action="./edit_pwd.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="id"><b>管理员ID</b></label>
                                    <input type="text" class="form-control form-control-lg" value="<?=$adminData['id']?>" name="id" class="form-control text-primary font-size-sm" disabled>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="adminUser"><b>账号</b></label>
                                    <input type="text" class="form-control form-control-lg" value="<?=$adminData['adminUser']?>" name="adminUser" placeholder="请输入管理员账号" disabled>
                                    <div style="margin-top: 10px;"><b>如需修改账号请联系最高管理员</b></div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="new-password"><b>新密码</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminPwd" placeholder="请输入管理员密码(不修改请留空)" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="confirm-password"><b>管理员ＱＱ</b></label>
                                    <input type="text" class="form-control form-control-lg" name="adminQq" value="<?=$adminData['adminQq']?>" placeholder="请输入管理员ＱＱ" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" id="submit" class="btn btn-primary">
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
var vaptcha_open = 0;
$(document).ready(function(){
  if($("#vaptchaContainer").length>0) vaptcha_open=1;
  $("#submit").click(function(){
    var adminUser = $("input[name='adminUser']").val();
    var adminPwd = $("input[name='adminPwd']").val();
    var adminQq = $("input[name='adminQq']").val();
    var id = $("input[name='id']").val();
    var data = {adminUser:adminUser,adminPwd:adminPwd,adminQq:adminQq,id:id};
    var edit = $("button[type='submit']");
    if(adminUser.length < 1 || adminQq.length < 1){
        layer.alert('账号或者QQ号为空，请补充完整！',{icon:2,shade:0.8});
        return false;
    }
    if(vaptcha_open==1){
      var token = obj.getToken();
      var adddata = {token:token};
    }
    edit.attr('disabled', 'true');
    layer.msg('正在修改中，请稍后...');
    $.ajax({
      type: "POST",
      url: "ajax.php?act=admininfo",
      data: Object.assign(data, adddata),
      dataType: "json",
      success: function (data) {
        if(data.code == 1){
          edit.removeAttr('disabled');
          layer.alert(data.msg,{icon:1,shade:0.8});
          obj.reset();
        }else if(data.code == 2){
          setTimeout(function (){
              parent.location.href = './login.php'
          },1000);
          layer.alert(data.msg,{icon:1,shade:0.8});
        }else{
          edit.removeAttr('disabled');
          layer.alert(data.msg,{icon:2,shade:0.8});
          obj.reset();
        }
      },
    });
    return false;
  });
});
</script>
</body>
</html>