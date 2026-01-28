<?php
include('./Common/Core_brain.php');
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover, user-scalable=no minimal-ui">
    <title><?php echo conf('Name');?> - <?php echo conf('SiteName');?></title>
    <meta name="keywords" content="<?php echo conf('Keywords');?>">
    <meta name="description" content="<?php echo conf('Descriptison');?>">
    <link rel="shortcut icon" href="../assets/media/various/favicon.png">
    <link rel="stylesheet" id="css-main" href="../assets/css/oneui.min-5.6.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9HQDQJJYW7"></script>
    <script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-9HQDQJJYW7');
    </script>
    <style>
        .h-captcha {
            margin-bottom: 1rem;
        }
        .h-captcha-container {
            min-height: 78px;
            display: flex;
            justify-content: center;
        }
        .h-captcha-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 78px;
            color: #666;
            font-size: 14px;
        }
        .h-captcha-loading svg {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<main id="main-container">
<div class="content">
<?php
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='Query')
{
?>
  <div class="row">
    <div class="col-md-12">
      <form method="POST" class="row" onsubmit="return QueryTeam()" role="form">
        <div class="block block-rounded">
          <div class="block-header block-header-default text-center">
            <h3 class="block-title"><?php echo conf('Name');?></h3>
          </div>
          <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
              <div class="col-sm-10 col-md-8">
                <div class="mb-4">
                  <label class="form-label" for="qq">QQ号</label>
                  <input type="text" class="form-control form-control-alt" id="qq" name="qq" placeholder="输入您要查询的QQ号">
                </div>
                <?php if(conf('Vaptcha_Open') == 1) {?>
                <div id="hcaptchaContainer" class="mb-4 h-captcha-container">
                    <div class="h-captcha-loading">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="60px" viewBox="0 0 24 30" style="enable-background: new 0 0 50 50; width: 14px; height: 14px; vertical-align: middle" xml:space="preserve">
                            <rect x="0" y="9.22656" width="4" height="12.5469" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                            <rect x="10" y="5.22656" width="4" height="20.5469" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                            <rect x="20" y="8.77344" width="4" height="13.4531" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                        </svg>
                        <span>人机验证加载中...</span>
                    </div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light text-center">
            <button type="submit" class="btn btn-alt-primary">
              <i class="fa fa-check opacity-50 me-1"></i> 立即查询
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php
}
elseif($my=='Join')
{
?>
  <div class="row">
    <div class="col-md-12">
      <form method="POST" class="row" onsubmit="return JoinTeam()" role="form">
        <div class="block block-rounded">
          <div class="block-header block-header-default text-center">
            <h3 class="block-title"><?php echo conf('Name');?></h3>
          </div>
          <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
              <div class="col-sm-10 col-md-8">
                <div class="mb-4">
                  <label class="form-label" for="name">成员名称</label>
                  <input type="text" class="form-control form-control-alt" name="TeamName" placeholder="输入您的名称">
                </div>
                <div class="mb-4">
                  <label class="form-label" for="qq">成员QQ</label>
                  <input type="text" class="form-control form-control-alt" name="TeamQq" placeholder="输入您的QQ号">
                </div>
                <div class="mb-4">
                  <label class="form-label" for="describe">成员简介</label>
                  <input type="text" class="form-control form-control-alt" name="TeamDescribe" placeholder="输入您的简介">
                </div>
                <?php if(conf('Vaptcha_Open') == 1) {?>
                <div id="hcaptchaContainer" class="mb-4 h-captcha-container">
                    <div class="h-captcha-loading">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="60px" viewBox="0 0 24 30" style="enable-background: new 0 0 50 50; width: 14px; height: 14px; vertical-align: middle" xml:space="preserve">
                            <rect x="0" y="9.22656" width="4" height="12.5469" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                            <rect x="10" y="5.22656" width="4" height="20.5469" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                            <rect x="20" y="8.77344" width="4" height="13.4531" fill="#CCCCCC">
                                <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                            </rect>
                        </svg>
                        <span>人机验证加载中...</span>
                    </div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light text-center">
            <button type="submit" class="btn btn-alt-primary">
              <i class="fa fa-check opacity-50 me-1"></i> 提交申请
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
  }
  ?>
</div>
</main>
<script src="../assets/admin/js/codebase.app.min-5.5.js"></script>
<script type="text/javascript" src="./assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="./assets/admin/js/main.min.js"></script>
<script src="./assets/layer/layer.js"></script>
<?php if(conf('Vaptcha_Open') == 1) {?>
<!-- hCaptcha 脚本 -->
<script src="https://js.hcaptcha.com/1/api.js?onload=hCaptchaCallback&render=explicit" async defer></script>
<script>
// hCaptcha配置
var hcaptcha_sitekey = 'a4b2011c-26fc-4b0c-867c-a1dcc5566694'; // 你的hCaptcha Site Key
var hcaptcha_widget_id = null;
var hcaptcha_loaded = false;

// hCaptcha加载回调
function hCaptchaCallback() {
    if (document.getElementById('hcaptchaContainer')) {
        try {
            // 确保jQuery已加载
            if (typeof $ === 'undefined') {
                console.error('jQuery未加载');
                return;
            }
            
            // 检查是否已经有验证组件
            var container = document.getElementById('hcaptchaContainer');
            if ($('.h-captcha', container).length === 0) {
                hcaptcha_widget_id = hcaptcha.render('hcaptchaContainer', {
                    sitekey: hcaptcha_sitekey,
                    theme: 'light',
                    size: 'normal',
                    callback: function(response) {
                        console.log('hCaptcha验证通过:', response);
                    },
                    'expired-callback': function() {
                        console.log('hCaptcha验证已过期');
                    },
                    'error-callback': function() {
                        console.log('hCaptcha验证出错');
                        // 尝试重新加载
                        resetHCaptcha();
                    }
                });
            }
            
            // 隐藏加载动画
            var loadingElement = container.querySelector('.h-captcha-loading');
            if (loadingElement) {
                loadingElement.style.display = 'none';
            }
            
            hcaptcha_loaded = true;
        } catch (error) {
            console.error('hCaptcha加载失败:', error);
            // 显示错误信息
            var container = document.getElementById('hcaptchaContainer');
            if (container) {
                container.innerHTML = '<div style="color: red; text-align: center;">人机验证加载失败，请刷新页面重试</div>';
            }
        }
    }
}

// 重置hCaptcha
function resetHCaptcha() {
    if (hcaptcha_widget_id !== null && typeof hcaptcha !== 'undefined') {
        try {
            hcaptcha.reset(hcaptcha_widget_id);
        } catch (error) {
            console.error('重置hCaptcha失败:', error);
        }
    }
}

// 检查hCaptcha是否已响应
function getHCaptchaResponse() {
    if (typeof hcaptcha === 'undefined' || !hcaptcha_loaded) {
        return null;
    }
    
    try {
        return hcaptcha.getResponse();
    } catch (error) {
        console.error('获取hCaptcha响应失败:', error);
        return null;
    }
}
</script>
<?php }?>
<script>
function QueryTeam(){
    var captcha_open = <?php echo conf('Vaptcha_Open') == 1 ? 'true' : 'false'; ?>;
    var query = $("button[type='submit']");
    var qq=$("input[name='qq']").val();
    var data = {qq:qq};
    
    if(qq==''){
        layer.msg('请输入QQ号', {icon:2, time:1500});
        return false;
    }
    
    // 验证QQ号格式
    if(!/^[1-9][0-9]{4,11}$/.test(qq)){
        layer.msg('QQ号格式不正确', {icon:2, time:1500});
        return false;
    }
    
    if(captcha_open){
        var hcaptcha_response = getHCaptchaResponse();
        if(!hcaptcha_response){
            layer.msg('请先完成人机验证！', {icon:2, time:1500});
            return false;
        }
        data.hcaptcha = hcaptcha_response;
    }
    
    query.attr('disabled', 'true').html('<i class="fa fa-spinner fa-spin me-1"></i> 查询中...');
    
    $.ajax({
        type : 'POST',
        url : 'Ajax.php?act=Query_submit',
        data: data,
        dataType : 'json',
        success : function(data) {
            if(data.code == 0){
                layer.msg(data.msg, {icon:1, time:1500});
            }else{
                layer.msg(data.msg, {icon:2, time:1500});
            }
            
            query.removeAttr('disabled').html('<i class="fa fa-check opacity-50 me-1"></i> 立即查询');
            if(captcha_open) resetHCaptcha();
        },
        error: function(xhr, status, error) {
            query.removeAttr('disabled').html('<i class="fa fa-check opacity-50 me-1"></i> 立即查询');
            layer.msg('请求失败：' + (xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : '请重试'), {icon:2, time:1500});
            if(captcha_open) resetHCaptcha();
        }
    });
    return false;
}

function JoinTeam(){
    var captcha_open = <?php echo conf('Vaptcha_Open') == 1 ? 'true' : 'false'; ?>;
    var join = $("button[type='submit']");
    var name=$("input[name='TeamName']").val();
    var qq=$("input[name='TeamQq']").val();
    var describe=$("input[name='TeamDescribe']").val();
    var data = {name:name, qq:qq, describe:describe};
    
    if(name=='' || qq=='' || describe==''){
        layer.msg('请确保每项都不为空', {icon:2, time:1500});
        return false;
    }
    
    // 验证QQ号格式
    if(!/^[1-9][0-9]{4,11}$/.test(qq)){
        layer.msg('QQ号格式不正确', {icon:2, time:1500});
        return false;
    }
    
    // 验证名称长度
    if(name.length < 2 || name.length > 20){
        layer.msg('名称长度应在2-20个字符之间', {icon:2, time:1500});
        return false;
    }
    
    // 验证简介长度
    if(describe.length < 10 || describe.length > 100){
        layer.msg('简介长度应在10-100个字符之间', {icon:2, time:1500});
        return false;
    }
    
    if(captcha_open){
        var hcaptcha_response = getHCaptchaResponse();
        if(!hcaptcha_response){
            layer.msg('请先完成人机验证！', {icon:2, time:1500});
            return false;
        }
        data.hcaptcha = hcaptcha_response;
    }
    
    join.attr('disabled', 'true').html('<i class="fa fa-spinner fa-spin me-1"></i> 提交中...');
    
    $.ajax({
        type : 'POST',
        url : 'Ajax.php?act=Join_submit',
        data: data,
        dataType : 'json',
        success : function(data) {
            if(data.code == 0){
                layer.msg(data.msg, {icon:1, time:1500}, function(){
                    window.location.reload();
                });
            }else{
                layer.msg(data.msg, {icon:2, time:1500});
                join.removeAttr('disabled').html('<i class="fa fa-check opacity-50 me-1"></i> 提交申请');
                if(captcha_open) resetHCaptcha();
            }
        },
        error: function(xhr, status, error) {
            join.removeAttr('disabled').html('<i class="fa fa-check opacity-50 me-1"></i> 提交申请');
            layer.msg('请求失败：' + (xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : '请重试'), {icon:2, time:1500});
            if(captcha_open) resetHCaptcha();
        }
    });
    return false;
}

// 页面加载完成后检查hCaptcha状态
$(document).ready(function() {
    <?php if(conf('Vaptcha_Open') == 1) { ?>
    // 如果hCaptcha库加载失败，设置超时重试
    setTimeout(function() {
        if (typeof hcaptcha === 'undefined' && document.getElementById('hcaptchaContainer')) {
            var container = document.getElementById('hcaptchaContainer');
            var loadingElement = container.querySelector('.h-captcha-loading');
            if (loadingElement) {
                loadingElement.innerHTML = '<span style="color: orange;">人机验证加载超时，请刷新页面</span>';
            }
        }
    }, 10000); // 10秒后检查
    <?php } ?>
});
</script>
</body>
</html>