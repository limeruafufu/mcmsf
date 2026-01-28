<?php
include("./Common/Core_brain.php");
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;

// hCaptcha验证函数
function verify_hcaptcha($response) {
    if (empty($response)) {
        return false;
    }
    
    $secret_key = 'ES_e8d2..'; // 这里应该是你的hCaptcha secret key，注意保密
    
    $verify_url = 'https://hcaptcha.com/siteverify';
    $post_data = [
        'secret' => $secret_key,
        'response' => $response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verify_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $verify_result = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);
    
    if (!$verify_result) {
        // 记录错误但不暴露给用户
        error_log("hCaptcha验证失败: " . $curl_error);
        return false;
    }
    
    $result_data = json_decode($verify_result, true);
    return ($result_data && isset($result_data['success']) && $result_data['success'] === true);
}

switch ($act) {
    case 'contact':
        $name = daddslashes(htmlspecialchars(strip_tags(trim($_POST['name']))));
        $email = daddslashes(htmlspecialchars(strip_tags(trim($_POST['email']))));
        $subject = daddslashes(htmlspecialchars(strip_tags(trim($_POST['subject']))));
        $message = daddslashes(htmlspecialchars(strip_tags(trim($_POST['message']))));
        if ($name == null || $email == null || $subject == null || $message == null) {
            exit('{"code":-1,"msg":"请确保每项都不为空"}');
        }
        if (conf('Mail_Name') == '' || conf('Mail_Pwd') == '') {
            exit('{"code":-1,"msg":"请先配置邮箱信息"}');
        }
        $admins = $DB->query("SELECT * FROM nteam_admin WHERE id=1");
        while ($admin = $admins->fetch()) {
            $email = $admin['adminQq'] . '@qq.com';
        }
        $sub = '网页收到新留言啦~~';
        $msg = "姓名：" . $name . "
                邮件：" . $email . "
                主题：" . $subject . "
                内容：" . $message;
        $result = send_mail($email, $sub, $msg);
        if ($result === true) {
            if ($DB->exec("INSERT INTO `nteam_leave_messages` (`name`,`email`,`subject`,`message`,`intime`) values ('" . $name . "','" . $email . "','" . $subject . "','" . $message . "','" . $date . "')")) {
                echo 'OK';
            };
        } else {
            file_put_contents('mail.log', $result);
            exit('{"code":-1,"msg":"留言发送失败"}');
        }
        break;

    case 'subscribe':
        @header('Content-Type: application/json; charset=UTF-8');
        $email = daddslashes(htmlspecialchars(strip_tags(trim($_POST['email']))));
        $hcaptcha_response = isset($_POST['hcaptcha']) ? $_POST['hcaptcha'] : '';
        
        if ($email == '') {
            exit('{"code":-1,"msg":"请确保每项都不为空"}');
        }
        
        // hCaptcha验证
        if (!verify_hcaptcha($hcaptcha_response)) {
            exit('{"code":-1,"msg":"请先完成人机验证"}');
        }
        
        if (conf('Mail_Name') == '' || conf('Mail_Pwd') == '') {
            exit('{"code":-1,"msg":"请先配置邮箱信息"}');
        }
        $admins = $DB->query("SELECT * FROM nteam_admin WHERE id=1");
        while ($admin = $admins->fetch()) {
            $email = $admin['adminQq'] . '@qq.com';
        }
        $sub = '官网有需要订阅的小伙伴哦~~';
        $msg = "邮箱：" . $email;
        $result = send_mail($email, $sub, $msg);
        if ($result === true) {
            $email = $_POST['email'];
            $sub = '成功订阅~~';
            $msg = '感谢订阅' . conf('Name') . '新闻！';
            $result = send_mail($email, $sub, $msg);
            if ($result === true) {
                exit('{"code":1,"msg":"订阅成功！"}');
            } else {
                exit('{"code":-1,"msg":"订阅失败！"}');
            }
        }
        break;

    case 'Query_submit':
        @header('Content-Type: application/json; charset=UTF-8');
        $qq = isset($_POST['qq']) ? $_POST['qq'] : '';
        $hcaptcha_response = isset($_POST['hcaptcha']) ? $_POST['hcaptcha'] : '';
        
        if ($qq == '') {
            exit('{"code":-1,"msg":"请确保每项都不为空"}');
        }
        
        // hCaptcha验证
        if (!verify_hcaptcha($hcaptcha_response)) {
            exit('{"code":-1,"msg":"请先完成人机验证"}');
        }
        
        $rows = $DB->getRow("SELECT * FROM nteam_team_member WHERE qq = '$qq' limit 1");
        if (!$rows) {
            exit('{"code":-1,"msg":"非本团队成员！"}');
        } else {
            exit('{"code":0,"msg":"该QQ是我们团队的成员！"}');
        }
        break;

    case 'Join_submit':
        @header('Content-Type: application/json; charset=UTF-8');
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $qq = isset($_POST['qq']) ? $_POST['qq'] : '';
        $describe = isset($_POST['describe']) ? $_POST['describe'] : '';
        $hcaptcha_response = isset($_POST['hcaptcha']) ? $_POST['hcaptcha'] : '';
        
        if (isset($_SESSION['Join_submit']) && $_SESSION['Join_submit'] > time() - 300) {
            exit('{"code":-1,"msg":"请勿频繁申请"}');
        }
        
        if ($name == '' || $qq == '' || $describe == '') {
            exit('{"code":-1,"msg":"请确保每项都不为空"}');
        }
        
        // hCaptcha验证
        if (!verify_hcaptcha($hcaptcha_response)) {
            exit('{"code":-1,"msg":"请先完成人机验证"}');
        }
        
        if (conf('Mail_Name') == '' || conf('Mail_Pwd') == '') {
            exit('{"code":-1,"msg":"当前未配置邮箱信息，无法发送邮件！"}');
        }
        
        $sds = $DB->exec("INSERT INTO `nteam_team_member` (`name`, `qq`, `describe`, `is_show`, `Audit_status`, `intime`) VALUES ('{$name}', '{$qq}', '{$describe}', 0, 0, NOW())");
        $id = $DB->lastInsertId();
        
        if (!$sds) {
            exit('{"code":-1,"msg":"申请提交失败！"}');
        } else {
            $admins = $DB->query("SELECT * FROM nteam_admin WHERE id=1");
            while ($admin = $admins->fetch()) {
                $email = $admin['adminQq'] . '@qq.com';
            }
            $sub = '有小伙伴想加入我们哦！';
            $msg = "赶紧前往后台查看吧！！！";
            $result = send_mail($email, $sub, $msg);
            if ($result === true) {
                $_SESSION['Join_submit'] = time();
                exit('{"code":0,"msg":"申请提交成功！"}');
            } else {
                exit('{"code":-1,"msg":"申请提交失败！"}');
            }
        }
        break;

    // ========== 新增：搜索项目接口 ==========
    case 'search_projects':
        @header('Content-Type: application/json; charset=UTF-8');
        
        // 获取筛选参数
        $kw = isset($_GET['kw']) ? daddslashes($_GET['kw']) : '';
        $type = isset($_GET['type']) ? daddslashes($_GET['type']) : '';
        $version = isset($_GET['version']) ? daddslashes($_GET['version']) : '';
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;
        
        // 构建查询条件
        $where_conditions = ['status=1', 'is_show=1', 'Audit_status=1'];
        $params = [];
        
        // 关键词筛选
        if (!empty($kw)) {
            $where_conditions[] = "(name LIKE ? OR money LIKE ? OR version LIKE ?)";
            $params[] = "%{$kw}%";
            $params[] = "%{$kw}%";
            $params[] = "%{$kw}%";
        }
        
        // 类型筛选（匹配 money 字段）
        if (!empty($type)) {
            $where_conditions[] = "money LIKE ?";
            $params[] = "%{$type}%";
        }
        
        // 版本筛选
        if (!empty($version)) {
            $where_conditions[] = "version LIKE ?";
            $params[] = "%{$version}%";
        }
        
        // 拼接 SQL
        $where_sql = implode(' AND ', $where_conditions);
        $offset = ($page - 1) * $limit;
        
        // 获取总记录数
        $count_sql = "SELECT COUNT(*) as total FROM nteam_project_list WHERE {$where_sql}";
        if (method_exists($DB, 'prepare')) {
            $stmt = $DB->prepare($count_sql);
            $stmt->execute($params);
            $total_result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $total_result = $DB->query($count_sql, $params)->fetch(PDO::FETCH_ASSOC);
        }
        $total = $total_result['total'];
        
        // 获取项目数据
        $data_sql = "SELECT * FROM nteam_project_list WHERE {$where_sql} ORDER BY id DESC LIMIT {$offset}, {$limit}";
        
        try {
            if (method_exists($DB, 'prepare')) {
                $stmt = $DB->prepare($data_sql);
                $stmt->execute($params);
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $projects = $DB->query($data_sql, $params)->fetchAll(PDO::FETCH_ASSOC);
            }
            
            // 为每个项目获取在线人数和状态
            foreach ($projects as &$project) {
                $server_addr = isset($project['paycontact']) ? trim($project['paycontact']) : '';
                $online_count = 0;
                $server_status = '离线';
                
                if (!empty($server_addr)) {
                    $api_url = 'https://uapis.cn/api/v1/game/minecraft/serverstatus?server=' . urlencode($server_addr);
                    $ch = curl_init();
                    curl_setopt_array($ch, [
                        CURLOPT_URL => $api_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_TIMEOUT => 5,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_FOLLOWLOCATION => true
                    ]);
                    $response = curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    
                    if ($response && $http_code == 200) {
                        $data = json_decode($response, true);
                        if (isset($data['online']) && $data['online'] === true) {
                            $online_count = intval($data['players']);
                            $server_status = '运行中';
                        }
                    }
                }
                
                $project['online_count'] = $online_count;
                $project['server_status'] = $server_status;
                
                // 计算热度
                $high_threshold = 100;
                $medium_threshold = 20;
                if ($server_status === '运行中') {
                    if ($online_count >= $high_threshold) {
                        $hotness = '高热';
                        $hotness_class = 'high';
                    } elseif ($online_count >= $medium_threshold) {
                        $hotness = '中热';
                        $hotness_class = 'medium';
                    } else {
                        $hotness = '低热';
                        $hotness_class = 'low';
                    }
                } else {
                    $hotness = '低热';
                    $hotness_class = 'low';
                }
                
                $project['hotness'] = $hotness;
                $project['hotness_class'] = $hotness_class;
            }
            
            // 返回 JSON
            echo json_encode([
                'code' => 1,
                'msg' => '成功',
                'data' => [
                    'projects' => $projects,
                    'total' => $total,
                    'page' => $page,
                    'pages' => ceil($total / $limit),
                    'limit' => $limit
                ]
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'code' => -1,
                'msg' => '查询失败: ' . $e->getMessage()
            ]);
        }
        break;

    default:
        exit('{"code":-4,"msg":"No Act"}');
        break;
}