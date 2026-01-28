<?php
// 设置允许跨域和 iframe 嵌入的头部
header("Content-Security-Policy: frame-ancestors 'self' *");
header('X-Frame-Options: ALLOWALL'); // 或者 ALLOW-FROM *

// AI助手后端逻辑
include("./Common/Core_brain.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');
    
    $userMsg = trim(htmlspecialchars($_POST['message']));
    
    if (empty($userMsg)) {
        echo json_encode(['reply' => '请输入您的问题']);
        exit;
    }
    
    // 关键词匹配 - 智能回复
    $lowerMsg = mb_strtolower($userMsg, 'UTF-8');
    
    // 服务器推荐相关
    if (strpos($lowerMsg, '推荐') !== false || strpos($lowerMsg, '服务器') !== false || strpos($lowerMsg, '服') !== false) {
        $type = '';
        if (strpos($lowerMsg, '生存') !== false) $type = '生存';
        elseif (strpos($lowerMsg, '创造') !== false) $type = '创造';
        elseif (strpos($lowerMsg, '模组') !== false) $type = '模组';
        elseif (strpos($lowerMsg, '小游戏') !== false) $type = '小游戏';
        
        $sql = "SELECT * FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1";
        if (!empty($type)) {
            $sql .= " AND money LIKE '%$type%'";
        }
        $sql .= " ORDER BY RAND() LIMIT 3";
        
        $projects = $DB->query($sql);
        $reply = "【浆果服 AI 助手】";
        if (!empty($type)) {
            $reply .= "为您推荐几个优质的{$type}服务器：\n\n";
        } else {
            $reply .= "为您推荐几个优质服务器：\n\n";
        }
        
        $count = 0;
        while($project = $projects->fetch() && $count < 3) {
            $count++;
            $reply .= "{$count}. {$project['name']} - {$project['sketch']}\n";
            $reply .= "   版本：{$project['version']} | 类型：{$project['money']}\n";
            $reply .= "   详情：<a href='works.php?id={$project['id']}' target='_blank'>查看详情</a>\n\n";
        }
        
        if ($count == 0) {
            $reply = "【浆果服 AI 助手】抱歉，暂时没有找到符合条件的服务器。您可以尝试搜索其他类型的服务器！";
        }
    }
    // 帮助相关
    elseif (strpos($lowerMsg, '帮助') !== false || strpos($lowerMsg, '怎么') !== false || strpos($lowerMsg, '如何') !== false) {
        $reply = "【浆果服 AI 助手】我来帮您！\n\n";
        $reply .= "📚 常见问题：\n";
        $reply .= "1. 如何申请服务器？\n";
        $reply .= "   → 点击首页的 申请加入 按钮，填写相关信息即可。\n\n";
        $reply .= "2. 如何查询团队成员？\n";
        $reply .= "   → 点击首页的 成员查询 功能，输入QQ号即可查询。\n\n";
        $reply .= "3. 如何联系管理员？\n";
        $reply .= "   → 可以通过留言功能或查看联系方式联系我们。\n\n";
        $reply .= "需要更多帮助？您可以访问帮助文档或直接联系管理员！";
    }
    // 问候语
    elseif (strpos($lowerMsg, '你好') !== false || strpos($lowerMsg, 'hello') !== false || strpos($lowerMsg, 'hi') !== false) {
        $reply = "【浆果服 AI 助手】你好！我是MCMSF平台的AI助手。\n\n";
        $reply .= "我可以帮您：\n";
        $reply .= "✨ 推荐合适的MC服务器\n";
        $reply .= "📖 解答平台使用问题\n";
        $reply .= "💡 提供相关帮助信息\n\n";
        $reply .= "有什么可以帮您的吗？";
    }
    // 版本相关
    elseif (strpos($lowerMsg, '版本') !== false || strpos($lowerMsg, '1.') !== false) {
        $reply = "【浆果服 AI 助手】我们平台支持多个Minecraft版本！\n\n";
        $versions = $DB->query("SELECT DISTINCT version FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1 AND version != '' ORDER BY version DESC LIMIT 10");
        $reply .= "热门版本包括：\n";
        $vCount = 0;
        while($v = $versions->fetch() && $vCount < 10) {
            $vCount++;
            $reply .= "• {$v['version']}\n";
        }
        $reply .= "\n您可以在首页筛选器中按版本查找服务器！";
    }
    // 默认回复 - 智能推荐
    else {
        // 尝试从数据库中查找相关信息
        $sql = "SELECT * FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1 AND (name LIKE ? OR sketch LIKE ? OR money LIKE ?) ORDER BY RAND() LIMIT 1";
        $keyword = "%$userMsg%";
        $project = $DB->getRow($sql, [$keyword, $keyword, $keyword]);
        
        if ($project) {
            $reply = "【浆果服 AI 助手】根据您的问题，我找到了相关信息：\n\n";
            $reply .= "🎮 {$project['name']}\n";
            $reply .= "📝 {$project['sketch']}\n";
            $reply .= "🏷️ 类型：{$project['money']} | 版本：{$project['version']}\n\n";
            $reply .= "想了解更多？<a href='works.php?id={$project['id']}' target='_blank'>查看详情</a>";
        } else {
            $reply = "【浆果服 AI 助手】感谢您的提问！\n\n";
            $reply .= "我可以帮您：\n";
            $reply .= "🔍 推荐合适的MC服务器（如：推荐生存服）\n";
            $reply .= "❓ 解答平台相关问题（如：如何申请服务器）\n";
            $reply .= "📚 提供使用帮助（如：版本支持）\n\n";
            $reply .= "请告诉我您需要什么帮助？";
        }
    }
    
    // 记录对话日志
    $ip = \lib\Gets::ip();
    $DB->query("INSERT INTO `nteam_ai_log` (`message`, `reply`, `ip`, `intime`) VALUES ('" . addslashes($userMsg) . "', '" . addslashes($reply) . "', '$ip', NOW())");
    
    echo json_encode(['reply' => $reply]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MCMSF AI 助手 - 浆果服</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --oneui-bg: #f4f4f4;
            --oneui-card: #ffffff;
            --oneui-primary: #007aff;
            --oneui-text: #000000;
            --oneui-gray: #8e8e93;
            --radius: 28px;
        }

        body {
            background-color: var(--oneui-bg);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-height: 100dvh;
            color: var(--oneui-text);
            overflow-x: hidden;
        }

        .header {
            padding: 60px 24px 20px;
            background: var(--oneui-bg);
        }
        .header h1 {
            font-size: 34px;
            font-weight: 600;
            margin: 0;
        }
        .header p {
            color: var(--oneui-gray);
            margin: 5px 0 0;
        }

        #chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .bubble {
            max-width: 80%;
            padding: 14px 18px;
            font-size: 16px;
            line-height: 1.5;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .ai-bubble {
            align-self: flex-start;
            background: var(--oneui-card);
            color: var(--oneui-text);
            border-radius: 4px var(--radius) var(--radius) var(--radius);
        }

        .user-bubble {
            align-self: flex-end;
            background: var(--oneui-primary);
            color: white;
            border-radius: var(--radius) var(--radius) 4px var(--radius);
        }

        .input-area {
            background: var(--oneui-card);
            padding: 15px 20px 30px;
            border-radius: var(--radius) var(--radius) 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        }

        input[type="text"] {
            flex: 1;
            background: #f0f0f0;
            border: none;
            padding: 14px 20px;
            border-radius: 24px;
            outline: none;
            font-size: 16px;
        }

        button {
            background: var(--oneui-primary);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>浆果 AI</h1>
        <p>MCMSF 浆果服专属助手</p>
    </div>

    <div id="chat-container">
        <div class="bubble ai-bubble">你好！我是浆果服小助手，有什么可以帮你的吗？</div>
    </div>

    <form class="input-area" id="chat-form">
        <input type="text" id="user-input" placeholder="输入消息..." autocomplete="off">
        <button type="submit">↑</button>
    </form>

    <script>
        const form = document.getElementById('chat-form');
        const container = document.getElementById('chat-container');
        const input = document.getElementById('user-input');

        form.onsubmit = async (e) => {
            e.preventDefault();
            const msg = input.value.trim();
            if (!msg) return;

            // 添加用户气泡
            appendBubble(msg, 'user');
            input.value = '';

            try {
                // 发送请求到 PHP 后端
                const formData = new FormData();
                formData.append('message', msg);

                const response = await fetch('', {
                    method: 'POST',
                    body: formData,
                    mode: 'same-origin' // 同源请求
                });
                
                if (!response.ok) {
                    throw new Error('网络请求失败');
                }
                
                const data = await response.json();
                // 添加 AI 气泡 - 支持HTML格式
                appendBubble(data.reply, 'ai', true);
            } catch (error) {
                console.error('请求失败:', error);
                appendBubble('抱歉，连接服务器时出现问题。请稍后重试。', 'ai');
            }
        };

        function appendBubble(text, type, isHTML = false) {
            const div = document.createElement('div');
            div.className = `bubble ${type}-bubble`;
            if (isHTML) {
                // 将换行符转换为<br>，并支持链接
                const formattedText = text
                    .replace(/\n/g, '<br>')
                    .replace(/<a href=['"]([^'"]+)['"] target=['"]([^'"]+)['"]>([^<]+)<\/a>/g, '<a href="$1" target="$2" style="color: inherit; text-decoration: underline;">$3</a>');
                div.innerHTML = formattedText;
            } else {
                div.textContent = text;
            }
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        }

        // 自动聚焦输入框
        input.focus();
    </script>
</body>
</html>