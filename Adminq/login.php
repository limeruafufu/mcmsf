<?php
//php防注入和XSS攻击通用过滤.
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);

function SafeFilter (&$arr)
{
    $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
    if (is_array($arr))
    {
        foreach ($arr as $key => $value)
        {
            if (!is_array($value))
            {
                if (!get_magic_quotes_gpc())             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
                {
                    $value  = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                }
                $value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
                $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
            }
            else
            {
                SafeFilter($arr[$key]);
            }
        }
    }
}
?>

<?php
//查询禁止IP
$ip =$_SERVER['REMOTE_ADDR'];
$fileht=".htaccess2";
if(!file_exists($fileht))file_put_contents($fileht,"");
$filehtarr=@file($fileht);
if(in_array($ip."\r\n",$filehtarr))die("警告:"."<br>"."您的IP地址被某些原因禁止，如果您有任何问题请联系QQ2322796106！");

//加入禁止IP
$time=time();
$fileforbid="log/forbidchk.dat";
if(file_exists($fileforbid))
{ if($time-filemtime($fileforbid)>60)unlink($fileforbid);
else{
    $fileforbidarr=@file($fileforbid);
    if($ip==substr($fileforbidarr[0],0,strlen($ip)))
    {
        if($time-substr($fileforbidarr[1],0,strlen($time))>600)unlink($fileforbid);
        elseif($fileforbidarr[2]>600){file_put_contents($fileht,$ip."\r\n",FILE_APPEND);unlink($fileforbid);}
        else{$fileforbidarr[2]++;file_put_contents($fileforbid,$fileforbidarr);}
    }
}
}
//防刷新
$str="";
$file="log/ipdate.dat";
if(!file_exists("log")&&!is_dir("log"))mkdir("log",0777);
if(!file_exists($file))file_put_contents($file,"");
$allowTime = 30;//防刷新时间
$allowNum=10;//防刷新次数
$uri=$_SERVER['REQUEST_URI'];
$checkip=md5($ip);
$checkuri=md5($uri);
$yesno=true;
$ipdate=@file($file);
foreach($ipdate as $k=>$v)
{ $iptem=substr($v,0,32);
    $uritem=substr($v,32,32);
    $timetem=substr($v,64,10);
    $numtem=substr($v,74);
    if($time-$timetem<$allowTime){
        if($iptem!=$checkip)$str.=$v;
        else{
            $yesno=false;
            if($uritem!=$checkuri)$str.=$iptem.$checkuri.$time."1\r\n";
            elseif($numtem<$allowNum)$str.=$iptem.$uritem.$timetem.($numtem+1)."\r\n";
            else
            {
                if(!file_exists($fileforbid)){$addforbidarr=array($ip."\r\n",time()."\r\n",1);file_put_contents($fileforbid,$addforbidarr);}
                file_put_contents("log/forbided_ip.log",$ip."--".date("Y-m-d H:i:s",time())."--".$uri."\r\n",FILE_APPEND);
                $timepass=$timetem+$allowTime-$time;
                die("提示:"."<br>"."您的刷新频率过快，请等待 ".$timepass." 秒后继续使用!");
            }
        }
    }
}
if($yesno) $str.=$checkip.$checkuri.$time."1\r\n";
file_put_contents($file,$str);
?>
<?php
$mod = 'admin';
$notLogin = true;
include('../Common/Core_brain.php');

if(isset($_GET['logout'])){
    unset($_SESSION['adminUser']);
    header('Location:./login.php');
}

if($isLogin)header('Location:./');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>后台登录 - <?php echo conf('Name');?></title>
    <link rel="shortcut icon" href="../assets/media/favicon.png" type="image/x-icon">
    <link rel="stylesheet" id="css-main" href="./assets/css/oneui.min-5.6.css">
</head>

<body>
    <div id="page-container">
        <main id="main-container">
            <div class="hero-static d-flex align-items-center">
                <div class="content">
                    <div class="row justify-content-center push">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <div class="block block-rounded mb-0">
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                        <h1 class="h2 mb-1"><?php echo conf('Name');?></h1>
                                        <p class="fw-medium text-muted">欢迎登录，今天是个不错的日子</p>
                                        <form class="px-4" action="login.php" method="post">
                                            <div class="py-3">
                                                <div class="mb-4">
                                                    <input type="text" name="adminUser" class="form-control form-control-alt form-control-lg"  placeholder="管理员账号">
                                                </div>
                                                <div class="mb-4">
                                                    <input type="password" name="adminPwd" class="form-control form-control-alt form-control-lg" placeholder="管理员密码" autocomplete>
                                                </div>
                                                <?php if(conf('Vaptcha_Open') == 1) {?>
                                                    <div id="vaptchaContainer" class="form-group">
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
                                                                <span class="vaptcha-text">人机验证启动中...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6 col-xl-5">
                                                    <button type="submit" id="submit" class="btn w-100 btn-alt-primary">
                                                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> 登录
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fs-sm text-muted text-center">
                        <strong><?php echo conf('Name');?></strong> © <span data-toggle="year-copy" class="js-year-copy-enabled">2023</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- jquery -->
    <script src="./assets/js/lib/jquery.min.js"></script>
    <!-- jquery pjax-->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <!--nprogress-->
    <script src="https://lf9-cdn-tos.bytecdntp.com/cdn/expire-0-M/nprogress/0.2.0/nprogress.min.js"></script>
    <!-- layer -->
    <script src="./assets/js/lib/layer.min.js"></script>
    <!-- 框架核心js -->
    <script src="./assets/js/oneui.app.min-5.6.js"></script>
    <!-- 图表库 -->
    <script src="./assets/js/plugins/chart.js/chart.min.js"></script>
    <!-- 通知库 -->
    <script src="./assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- App核心文件 -->
    <script src="./assets/js/app.js"></script>
    <script src="../Mym/Assets/Js/jquery.min.js"></script>
    <?php if(conf('Vaptcha_Open') == 1) {?>
        <script src='https://v.vaptcha.com/v3.js'></script>
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
        $(document).ready(function(){
            if($("#vaptchaContainer").length>0) vaptcha_open=1;
            $("#submit").click(function(){
                var adminUser = $("input[name='adminUser']").val();
                var adminPwd = $("input[name='adminPwd']").val();
                var data = {adminUser:adminUser,adminPwd:adminPwd};
                var login = $("button[type='submit']");
                if(adminUser.length < 1 || adminPwd.length < 1){
                    layer.alert('请确保每项项都不为空！', {icon: 2});
                    return false;
                }
                if(vaptcha_open==1){
                    var token = obj.getToken();
                    if(token == ""){
                        layer.msg('请先完成人机验证！'); return false;
                    }
                    var adddata = {token:token};
                }
                login.attr('disabled', 'true');
                layer.msg('正在登录中，请稍后...');
                $.ajax({
                    type:'POST',
                    url:'ajax.php?act=login',
                    data: Object.assign(data, adddata),
                    dataType:'json',
                    success:function (data){
                        if(data.code == 1){
                            setTimeout(function (){
                                location.href = './'
                            },1000);
                            layer.alert(data.msg, {icon: 1});
                        }else{
                            login.removeAttr('disabled');
                            layer.alert(data.msg, {icon: 2});
                            obj.reset();
                        }
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>
