<?php
$mod = 'admin';
include('../Common/Core_brain.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="author" content="一个失踪的Ma.">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php echo $title?> | <?php echo conf('Name');?></title>
    <meta name="keywords" content="<?php echo $conf['Keywords']?>">
    <meta name="description" content="<?php echo $conf['Description']?>">
    <link rel="shortcut icon" href="/assets/media/favicon.png" type="image/x-icon">
    <!-- 框架核心样式 -->
    <link rel="stylesheet" id="css-main" href="./assets/css/oneui.min-5.6.css">
    <!-- 图片预览 -->
    <link rel="stylesheet" href="./assets/js/plugins/magnific-popup/magnific-popup.css">
    <!-- nprogress -->
    <link href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-0-M/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
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
    <!-- 图片预览 -->
    <script src="./assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- 日期选择 -->
    <script src="./assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap-table-->
    <script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.18.3/bootstrap-table.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.15.4/locale/bootstrap-table-zh-CN.min.js"></script>
    <!-- 引入 filter-control 插件所需的 CSS 和 JS 文件 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/filter-control/bootstrap-table-filter-control.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <!-- App核心文件 -->
    <script src="./assets/js/app.js"></script>

    <style>
        .btn-xs {
            --bs-btn-padding-y: 0.125rem;
            --bs-btn-padding-x: 0.25rem;
            --bs-btn-font-size: 0.75rem;
            /*--bs-btn-border-radius: 0.125rem;*/
        }
        .table thead th {
            text-transform: none;
        }
        tbody, td, tfoot, th, thead, tr {
            border-color: inherit;
            border-style: none;
            border-width: 0;
        }
    </style>
</head>

<body>
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow side-trans-enabled">
    <nav id="sidebar" aria-label="Main Navigation">
        <div class="content-header">
            <a class="fw-semibold text-dual" data-pjax href="index.php">
                <span class="smini-visible">
                    <i class="fa fa-circle-notch text-primary"></i>
                </span>
                <span class="smini-hide fs-5 tracking-wider"><?php echo conf('Name');?></span>
            </a>
            <div>
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                    <i class="far fa-moon"></i>
                </button>
                <div class="dropdown d-inline-block ms-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-paint-brush"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                         aria-labelledby="sidebar-themes-dropdown">
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium active"
                           data-toggle="theme" data-theme="default" href="#">
                            <span>Default</span>
                            <i class="fa fa-circle text-default"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                           data-toggle="theme" data-theme="./assets/css/themes/amethyst.min-5.5.css" href="#">
                            <span>Amethyst</span>
                            <i class="fa fa-circle text-amethyst"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                           data-toggle="theme" data-theme="./assets/css/themes/city.min-5.5.css" href="#">
                            <span>City</span>
                            <i class="fa fa-circle text-city"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                           data-toggle="theme" data-theme="./assets/css/themes/flat.min-5.5.css" href="#">
                            <span>Flat</span>
                            <i class="fa fa-circle text-flat"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                           data-toggle="theme" data-theme="./assets/css/themes/modern.min-5.5.css" href="#">
                            <span>Modern</span>
                            <i class="fa fa-circle text-modern"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                           data-toggle="theme" data-theme="./assets/css/themes/smooth.min-5.5.css" href="#">
                            <span>Smooth</span>
                            <i class="fa fa-circle text-smooth"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light"
                           href="javascript:void(0)">
                            <span>Sidebar Light</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark"
                           href="javascript:void(0)">
                            <span>Sidebar Dark</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light"
                           href="javascript:void(0)">
                            <span>Header Light</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark"
                           href="javascript:void(0)">
                            <span>Header Dark</span>
                        </a>
                    </div>
                </div>
                <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout"
                   data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-fw fa-times"></i>
                </a>
            </div>
        </div>
        <div class="js-sidebar-scroll" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                             aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="content-side" id="nav-main">
                                    <ul class="nav-main">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" href="index.php">
                                                <i class="nav-main-link-icon fa fa-house-user"></i>
                                                <span class="nav-main-link-name"><b>后台首页</b></span>
                                            </a>
                                        </li>
                                        <?php if($adminData['adminRank']==1){?>
                                            <li class="nav-main-heading">Function</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="alist.php">
                                                    <i class="nav-main-link-icon fa fa-align-left"></i>
                                                    <span class="nav-main-link-name"><b>管理员管理</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="tlist.php">
                                                    <i class="nav-main-link-icon fa fa-pencil-ruler"></i>
                                                    <span class="nav-main-link-name"><b>成员管理</b></span>
                                                </a>
                                            </li>
                                        <?php } if($adminData['adminRank']==1 || $adminData['adminRank']==2 ){ ?>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="plist.php">
                                                    <i class="nav-main-link-icon fa fa-layer-group"></i>
                                                    <span class="nav-main-link-name"><b>项目管理</b></span>
                                                </a>
                                            </li>
                                        <?php } if($adminData['adminRank']==1){ ?>
                                            <li class="nav-main-heading">Build</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="set.php">
                                                    <i class="nav-main-link-icon fa fa-cogs"></i>
                                                    <span class="nav-main-link-name"><b>网站配置</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="module.php">
                                                    <i class="nav-main-link-icon fa fa-box"></i>
                                                    <span class="nav-main-link-name"><b>模块配置</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="smtp.php">
                                                    <i class="nav-main-link-icon fa fa-envelope-open"></i>
                                                    <span class="nav-main-link-name"><b>邮箱配置</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="expand.php">
                                                    <i class="nav-main-link-icon fa fa-bomb"></i>
                                                    <span class="nav-main-link-name"><b>拓展配置</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-heading">Expand</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="team_approval.php">
                                                    <i class="nav-main-link-icon fa fa-user-plus"></i>
                                                    <span class="nav-main-link-name"><b>成员审批</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="system_log.php">
                                                    <i class="nav-main-link-icon fa fa-bar-chart"></i>
                                                    <span class="nav-main-link-name"><b>系统日志</b></span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <li class="nav-main-heading text-center">- 更多功能敬请期待 -</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 735px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
            </div>
        </div>
    </nav>
    <header id="page-header">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                        data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block"
                        data-toggle="layout" data-action="sidebar_mini_toggle">
                    <i class="fa fa-fw fa-ellipsis-v"></i>
                </button>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="https://q2.qlogo.cn/g?b=qq&nk=<?=$_SESSION['adminQq']?>%3E&s=100" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ms-2"><?=$_SESSION['adminUser']?></span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb"
                                 src="https://q2.qlogo.cn/g?b=qq&nk=<?=$_SESSION['adminQq']?>%3E&s=100" alt="">
                            <p class="mt-2 mb-0 fw-medium"><?=$_SESSION['adminUser']?></p>
                            <p class="mb-0 text-muted fs-sm fw-medium">Web Admin,Developer</p>
                        </div>
                        <div class="px-2 py-3 bg-body-light rounded-top">
                            <h5 class="h6 fs-xs text-center mb-0">
                                QQ：<?=$_SESSION['adminQq']?>
                            </h5>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="edit_pwd.php">
                                <span>修改密码</span>
                                <i class="fa fa-fw fa-user opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="set.php" data-toggle="layout" data-action="side_overlay_toggle">
                                <span>网站配置</span>
                                <i class="fa fa-fw fa-wrench opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="./login.php?logout">
                                <span>退出登入</span>
                                <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="page-header-loader" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
    </header>
    <main id="main-container">