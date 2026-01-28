<?php
session_start();

// ===== 1. 引入配置文件 =====
// 注意路径：配置文件在 protected_config 目录中
$config_path = dirname(__FILE__) . '/protected_config/mail_config.php';

if (!file_exists($config_path)) {
    exit('系统配置错误，请联系管理员');
}

$config = require $config_path;

// ===== 2. 防频繁提交 =====
$interval = $config['security']['min_submit_interval'] ?? 30;
if (time() - ($_SESSION['last_submit'] ?? 0) < $interval) {
    exit('提交过于频繁，请稍后再试');
}
$_SESSION['last_submit'] = time();

// ===== 3. 验证码 =====
if ($config['security']['captcha_enabled'] ?? true) {
    if (strtolower($_POST['captcha'] ?? '') !== strtolower($_SESSION['captcha'] ?? '')) {
        exit('验证码错误');
    }
}

// ===== 4. 引入PHPMailer =====
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

// ===== 5. 数据过滤函数 =====
function v($k) {
    return htmlspecialchars($_POST[$k] ?? '', ENT_QUOTES);
}

$tags = isset($_POST['tags']) ? implode('、', $_POST['tags']) : '未选择';

// ===== 6. 邮件内容 =====
$body = "
【MCMSF 服务器收录申请】

服务器名称：
".v('server_name')."

服务器介绍：
".v('server_desc')."

BV 号：
".v('server_bv')."

服务器图片：
封面：".v('img_cover')."
风景：".v('img_view')."
游玩：".v('img_play')."

服务器标签：
".$tags."

服务器版本：
".v('server_version')."

服务器 IP：
".v('server_ip')."

加入方式：
".v('join_method')."

提交时间：
".date('Y-m-d H:i:s')."
";

// ===== 7. SMTP 设置（使用配置） =====
try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    
    // 使用配置文件中的值
    $mail->Host = $config['smtp']['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp']['username'];
    $mail->Password = $config['smtp']['password'];
    $mail->SMTPSecure = $config['smtp']['secure'];
    $mail->Port = $config['smtp']['port'];
    
    // 调试模式
    if ($config['smtp']['debug'] > 0) {
        $mail->SMTPDebug = $config['smtp']['debug'];
    }
    
    $mail->CharSet = 'UTF-8';
    $mail->setFrom(
        $config['email']['from_email'], 
        $config['email']['from_name']
    );
    $mail->addAddress($config['email']['to_email']);
    
    $mail->Subject = $config['email']['subject_prefix'] . '服务器收录申请 - ' . v('server_name');
    $mail->Body = $body;
    
    $mail->send();
    echo '提交成功，已发送至管理员邮箱';
    
} catch (Exception $e) {
    // 生产环境应该记录日志，而不是显示详细错误
    error_log("邮件发送失败: " . $e->getMessage());
    
    // 给用户的提示
    if ($config['smtp']['debug'] > 0) {
        echo '邮件发送失败: ' . $e->getMessage();
    } else {
        echo '提交失败，请稍后重试或联系管理员';
    }
}