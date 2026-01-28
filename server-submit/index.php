<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>服务器收录提交 | MCMSF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/oneui.min-5.6.css">
</head>
<body>

<div id="page-container">
    <main id="main-container">
        <div class="content content-boxed">

            <h2 class="content-heading">服务器收录提交</h2>
            <p class="text-muted fs-sm">
                图片请使用 image.mcmsf.com 图床（授权码：MCMSF114）<br>
                提交后将自动发送至管理员邮箱
            </p>

            <form action="submit.php" method="post" class="block block-rounded block-bordered">
                <div class="block-content">

                    <div class="mb-4">
                        <label class="form-label">服务器名称</label>
                        <input name="server_name" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器介绍</label>
                        <textarea name="server_desc" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Bilibili 视频 BV 号</label>
                        <input name="server_bv" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器图片（image.mcmsf.com）</label>
                        <input name="img_cover" class="form-control mb-2" placeholder="封面 16:9" required>
                        <input name="img_view" class="form-control mb-2" placeholder="服务器风景" required>
                        <input name="img_play" class="form-control" placeholder="游玩截图（含MC UI）" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器标签（多选）</label>
                        <div class="row g-2">
                            <?php
                            $tags = ['生存','生电','创造','模组','小游戏','群组服','无政府'];
                            foreach ($tags as $t) {
                                echo '<div class="col-6 col-md-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="'.$t.'"> '.$t.'
                                    </label>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器版本</label>
                        <input name="server_version" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器真实 IP（可不公开）</label>
                        <input name="server_ip" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">服务器加入方式</label>
                        <textarea name="join_method" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">验证码</label>
                        <div class="d-flex align-items-center gap-3">
                            <input name="captcha" class="form-control" required style="max-width:140px;">
                            <img src="captcha.php" onclick="this.src='captcha.php?'+Math.random()" style="cursor:pointer">
                        </div>
                    </div>

                </div>

                <div class="block-content block-content-full bg-body-light text-end">
                    <button class="btn btn-primary">提交并发送</button>
                </div>
            </form>

        </div>
    </main>
</div>

</body>
</html>