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
        .VAPTCHA-init-main {
            display: table;
            width: 100%;
            height: 100%;
            background-color: #eeeeee;
        }

        .VAPTCHA-init-loading {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .VAPTCHA-init-loading>a {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: none;
        }

        .VAPTCHA-init-loading .VAPTCHA-text {
            font-family: sans-serif;
            font-size: 12px;
            color: #cccccc;
            vertical-align: middle;
        }
    </style>
</head>
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
                <div id="vaptchaContainer" class="mb-4">
                    <div class="VAPTCHA-init-main">
                        <div class="VAPTCHA-init-loading">
                            <a href="javascript:void(0)">
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
                            </a>
                            <span class="VAPTCHA-text">人机验证启动中...</span>
                        </div>
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
                <div id="vaptchaContainer" class="mb-4">
                    <div class="VAPTCHA-init-main">
                        <div class="VAPTCHA-init-loading">
                            <a href="javascript:void(0)">
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
                            </a>
                            <span class="VAPTCHA-text">人机验证启动中...</span>
                        </div>
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
<script src='https://v-cn.vaptcha.com/v3.js'></script>
<script>
var obj;
vaptcha({
  vid: '<?php echo conf('Vaptcha_Vid')?>', 
  type: 'click', 
  scene: 0, 
  container: '#vaptchaContainer', 
  offline_server: '#', 
  lang: 'zh-CN',
  https: true,
  color: '#5c8af7'
}).then(function (vaptchaObj) {
  obj = vaptchaObj;
  vaptchaObj.render();
  vaptchaObj.listen('close', function () {
  })
})
</script>
<?php }?>
<script>
var vaptcha_open = 0;
	function QueryTeam(){
  		if($("#vaptchaContainer").length>0) vaptcha_open=1;
	    var query = $("button[type='submit']");
	  	var qq=$("input[name='qq']").val();
    	var data = {qq:qq};
		if(qq==''){layer.msg('请确保每项都不为空', {icon:2, time:1500});return false;}
	  	if(vaptcha_open==1){
		   	var token = obj.getToken();
		    if(token == ""){
		      	layer.msg('请先完成人机验证！'); return false;
		    }
		    var adddata = {token:token};
	  	}
	    query.attr('disabled', 'true');
        layer.msg('正在查询中，请稍后...');
		$.ajax({
			type : 'POST',
			url : 'Ajax.php?act=Query_submit',
            data: Object.assign(data, adddata),
			dataType : 'json',
			success : function(data) {
			  	if(data.code == 0){
		        	query.removeAttr('disabled');
			    	layer.msg(data.msg, {icon:1, time:1500});
                	obj.reset();
			  	}else{
		        	query.removeAttr('disabled');
			    	layer.msg(data.msg, {icon:2, time:1500});
			    	obj.reset();
			  	}
			},
		});
    	return false;
	}
	function JoinTeam(){
  		if($("#vaptchaContainer").length>0) vaptcha_open=1;
	    var join = $("button[type='submit']");
	  	var name=$("input[name='TeamName']").val();
	  	var qq=$("input[name='TeamQq']").val();
	  	var describe=$("input[name='TeamDescribe']").val();
    	var data = {name:name,qq:qq,describe:describe};
		if(name=='' || qq=='' || describe==''){ layer.msg('请确保每项都不为空', {icon:2, time:1500});}
	  	if(vaptcha_open==1){
		   	var token = obj.getToken();
		    if(token == ""){
		      	layer.msg('请先完成人机验证！'); return false;
		    }
		    var adddata = {token:token};
	  	}
	    join.attr('disabled', 'true');
        layer.msg('正在提交中，请稍后...');
		$.ajax({
			type : 'POST',
			url : 'Ajax.php?act=Join_submit',
            data: {name:name,qq:qq,describe:describe,token:token},
			dataType : 'json',
			success : function(data) {
			  if(data.code == 0){
			    layer.msg(data.msg, {icon:1, time:1500}, function(){window.location.reload()});
			  }else{
			    layer.msg(data.msg, {icon:2, time:1500});
		        join.removeAttr('disabled');
                obj.reset();
			  }
			},
		});
	return false;
}
</script>
</body>
</html>