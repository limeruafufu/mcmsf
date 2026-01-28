<?php
// protected_config/mail_config.php
// 邮件服务器配置 - 请勿将此文件放在Web可访问目录

return [
    'smtp' => [
        'host'      => 'smtp.qq.com',
        'username'  => '',  // 发信邮箱
        'password'  => '',        // ⚠️ 这里填写新的授权码
        'secure'    => 'ssl',                // tls 或 ssl
        'port'      => 465,
        'debug'     => 0,                    // 0=关闭, 1=客户端消息, 2=客户端和服务器消息
    ],
    'email' => [
        'from_email' => '',  // 发件人邮箱
        'from_name'  => 'MCMSF 提交系统',     // 发件人名称
        'to_email'   => '',  // 接收邮箱
        'subject_prefix' => '【MCMSF】',      // 邮件主题前缀
    ],
    'security' => [
        'min_submit_interval' => 30,          // 最小提交间隔（秒）
        'captcha_enabled'     => true,        // 是否启用验证码
    ]
];