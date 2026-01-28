<?php
$mod = 'admin';
$title='后台管理';
include('../Common/Core_brain.php');
include './head.php';
$admin_nums=$DB->getColumn("SELECT count(*) from nteam_admin WHERE 1");
$member_nums=$DB->getColumn("SELECT count(*) from nteam_team_member WHERE 1");
$project_nums=$DB->getColumn("SELECT count(*) from nteam_project_list WHERE 1");
$mysqlversion=$DB->query("select VERSION()")->fetch();
$admin=$DB->query("SELECT * FROM nteam_admin WHERE 1");
while($admin = $admin->fetch()){
?>
<div id="pjax-container">
    <div class="content animated fadeIn">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    <?php echo conf('Name');?>-后台管理中心
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome <a class="fw-semibold" href="javascript:void(0)"><?=$_SESSION['adminUser']?></a>, everything looks great.
                </h2>
            </div>
            <?php if($adminData['adminRank']==1){ ?>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <a class="btn btn-sm btn-alt-secondary space-x-1" data-pjax href="set.php">
                    <i class="fa fa-cog opacity-50"></i>
                    <span>网站配置</span>
                </a>
                <a class="btn btn-sm btn-alt-secondary space-x-1" data-pjax href="module.php">
                    <i class="fa fa-box opacity-50"></i>
                    <span>模块配置</span>
                </a>
            </div>
            <?php } if($adminData['adminRank']==2){ ?>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <a class="btn btn-sm btn-alt-secondary space-x-1" data-pjax href="plist.php">
                    <i class="fa fa-layer-group opacity-50"></i>
                    <span>项目管理</span>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="row items-push">
            <div class="col-sm-12 col-xxl-12">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold" id="clock"></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">实时时间</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-clock fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" data-pjax href="https://www.baidu.com/s?ie=utf-8&f=3&rsv_bp=1&rsv_idx=1&tn=baidu&wd=%E5%8C%97%E4%BA%AC%E6%97%B6%E9%97%B4&fenlei=256&rsv_pq=0xe6c613fc0012848f&rsv_t=47732m6160ybVthifYOHqzCkYzBMMNSOZygvkXLL39dqfxZa6LJD9uHd%2BBVr&rqlang=en&rsv_enter=1&rsv_dl=ts_0&rsv_sug3=16&rsv_sug1=14&rsv_sug7=100&rsv_sug2=1&rsv_btype=i&prefixsug=beijingshijian&rsp=0&inputT=7004&rsv_sug4=8902">
                            <span>北京时间</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo $admin_nums;?> 位</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">管理总数</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-user fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" data-pjax href="alist.php">
                            <span>管理列表</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo $member_nums;?> 位</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">成员总数</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-users fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" data-pjax href="tlist.php">
                            <span>成员列表</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo $project_nums; ?> 个</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">项目总数</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-project-diagram fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" data-pjax href="plist.php">
                            <span>项目列表</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><b>站点公告</b></h3>
                    </div>
                    <div class="block-content">
                        <div class="js-slider slick-nav-black slick-nav-hover" data-dots="true" data-autoplay="true" data-arrows="true">
                            <div class="col-12">
                                <div class="block block-rounded">
                                    <div class="block-content text-center">
                                        <i class="si si-disc fa-2x"></i>
                                        <p class="text-muted fs-sm">
                                            <b><?php echo conf_index('Notice');?></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><b>服务器信息</b></h3>
                    </div>
                    <div class="block-content block-content-full" data-toggle="slimscroll" data-height="259px">
                        <div class="fw-medium fs-sm">
                            <div class="border-start border-4 rounded-2 border-primary mb-2">
                                <div class="rounded p-2 text-pulse-light" id="notice">
                                    <p class="m-1 text-center">PHP 版本：<?php echo phpversion() ?> <?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?></p>
                                    <p class="m-1 text-center">MySQL 版本：<?php echo $mysqlversion[0] ?></p>
                                    <p class="m-1 text-center">服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE'] ?></p>
                                    <p class="m-1 text-center">程序最大运行时间：<?php echo ini_get('max_execution_time') ?>s</p>
                                    <p class="m-1 text-center">POST许可：<?php echo ini_get('post_max_size'); ?></p>
                                    <p class="m-1 text-center">文件上传许可：<?php echo ini_get('upload_max_filesize'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><b>快捷按键</b></h3>
                    </div>
                    <div class="block-content">
                        <div class="block-content block-content-full">
                            <div class="py-3 text-center">
                                <div class="mb-3">
                                    <i class="fa fa-cog fa-4x text-primary"></i>
                                </div>
                                <div class="fs-4 fw-semibold">现在去设置网站</div>
                                <div class="pt-3">
                                    <a class="btn btn-alt-primary" href="set.php">
                                        <i class="fa fa-cog opacity-50 me-1"></i> <b>系统设置</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><b>快捷按键</b></h3>
                    </div>
                    <div class="block-content">
                        <div class="block-content block-content-full">
                            <div class="py-3 text-center">
                                <div class="mb-3">
                                    <i class="fa fa-project-diagram fa-4x text-primary"></i>
                                </div>
                                <div class="fs-4 fw-semibold">现在去管理项目</div>
                                <div class="pt-3">
                                    <a class="btn btn-alt-primary" href="plist.php">
                                        <i class="fa fa-project-diagram opacity-50 me-1"></i> <b>项目管理</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><b>快捷按键</b></h3>
                    </div>
                    <div class="block-content">
                        <div class="block-content block-content-full">
                            <div class="py-3 text-center">
                                <div class="mb-3">
                                    <i class="fa fa-users fa-4x text-primary"></i>
                                </div>
                                <div class="fs-4 fw-semibold">现在去管理成员</div>
                                <div class="pt-3">
                                    <a class="btn btn-alt-primary" href="tlist.php">
                                        <i class="fa fa-users opacity-50 me-1"></i> <b>成员管理</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include 'foot.php'?>
<?php } ?>
