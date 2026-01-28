<?php
include("./Common/Core_brain.php");
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
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://player.bilibili.com" crossorigin>
    <link rel="preconnect" href="https://sdk.jinrishici.com" crossorigin>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"></noscript>
    <?php
    $__idx_img = conf('Index_Image');
    if(!empty($__idx_img)){
        $p = parse_url($__idx_img);
        if($p && isset($p['scheme']) && isset($p['host'])){
            echo '<link rel="preconnect" href="' . $p['scheme'] . '://' . $p['host'] . '" crossorigin>'; 
        }
        echo '<link rel="preload" as="image" href="' . $__idx_img . '" fetchpriority="high">';
        // 立即启动图片下载以加快浏览器进度条
        echo "<script>try{(new Image()).src='" . $__idx_img . "';}catch(e){};</script>";
    }
    ?>
<style>
    .theme-selector.active {
        border-color: var(--oneui-primary) !important;
        border-width: 2px !important;
    }
    
    .theme-selector.active .fa-check {
        display: inline-block !important;
    }
    
    #integrated-nav-dropdown {
        background: linear-gradient(135deg, var(--oneui-primary) 0%, var(--oneui-primary-dark) 100%);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }
    
    #integrated-nav-dropdown:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);
    }
    
    .oneui-dark .bg-primary-light {
        background-color: rgba(0, 102, 255, 0.15) !important;
    }
    
    .oneui-dark .dropdown-menu {
        background-color: #2d3748;
        border-color: #4a5568;
    }
    
    .oneui-dark .dropdown-item {
        color: #e2e8f0;
    }
    
    .oneui-dark .dropdown-item:hover {
        background-color: #4a5568;
    }
    
    @media (max-width: 991px) {
        .nav-main-horizontal {
            display: none !important;
        }
        
        #integrated-nav-dropdown span {
            display: none;
        }
        
        #integrated-nav-dropdown {
            padding: 0.5rem;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 主题选择器交互
    const themeSelectors = document.querySelectorAll('.theme-selector');
    const darkModeToggle = document.getElementById('dark-mode-toggle') || document.querySelector('[data-action="dark_mode_toggle"]');

    // 初始化当前主题
    const currentTheme = localStorage.getItem('theme') || 'default';
    if (themeSelectors && themeSelectors.length) themeSelectors.forEach(selector => {
        if (selector.getAttribute('data-theme') === currentTheme) {
            selector.classList.add('active');
        }
        
        selector.addEventListener('click', function(e) {
            e.preventDefault();
            
            // 移除所有激活状态
            themeSelectors.forEach(s => s.classList.remove('active'));
            
            // 添加当前激活状态
            this.classList.add('active');
            
            // 获取主题
            const theme = this.getAttribute('data-theme');
            
            // 保存到本地存储
            localStorage.setItem('theme', theme);
            
            // 应用主题
            if (theme === 'default') {
                // 移除主题样式
                document.querySelector('link[data-theme]')?.remove();
            } else {
                // 移除现有主题
                document.querySelector('link[data-theme]')?.remove();
                
                // 添加新主题
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = theme;
                link.setAttribute('data-theme', theme);
                document.head.appendChild(link);
            }
            
            // 关闭下拉菜单（有 bootstrap 时才调用）
            const dropdown = document.getElementById('integrated-nav-dropdown');
            if (typeof bootstrap !== 'undefined' && dropdown) {
                const bootstrapDropdown = bootstrap.Dropdown.getInstance(dropdown);
                if (bootstrapDropdown) bootstrapDropdown.hide();
            }
        });
    });
    
    // 深色模式：由 assets/js/darkmode.js 统一管理，页面仅保留触发按钮（data-action="dark_mode_toggle").
    
    // 导航菜单悬停效果
    const navItems = document.querySelectorAll('.nav-main-item');
    navItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.classList.add('nav-main-item-hover');
        });
        
        item.addEventListener('mouseleave', function() {
            this.classList.remove('nav-main-item-hover');
        });
    });
});
</script>
    <script src="assets/js/darkmode.js" defer></script>
</head>
<body>
    <div id="page-container" class="page-header-fixed main-content-boxed">
        <header id="page-header">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <a class="fw-bold fs-lg tracking-wider text-dual me-2 d-flex align-items-center" href="/">
                        <img src="company-logo.svg" alt="Logo" loading="lazy" style="height: 32px; margin-right: 8px;">
                         <?php echo conf('Name');?><span class="fw-semibold"><?php echo conf('SiteName');?></span>
                    </a>
                </div>
                
                <!-- 重新设计的导航栏部分 -->
                <div class="d-flex align-items-center">
                    <!-- 主导航菜单 -->
                    <ul class="nav-main nav-main-horizontal nav-main-hover d-none d-lg-block me-3">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name"><strong>首页</strong></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/dashboard">
                                <i class="nav-main-link-icon fa fa-chart-bar"></i>
                                <span class="nav-main-link-name">控制面板</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/content">
                                <i class="nav-main-link-icon fa fa-file-alt"></i>
                                <span class="nav-main-link-name">内容管理</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/users">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">用户管理</span>
                            </a>
                        </li>
                    </ul>
                    
 <?php /*                <!-- 整合的导航与主题切换菜单 -->
                    <div class="dropdown d-inline-block me-2">
                        <button type="button" class="btn btn-alt-primary d-flex align-items-center" id="integrated-nav-dropdown" 
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-layer-group me-1"></i>
                            <span>导航与主题</span>
                            <i class="fa fa-chevron-down ms-1 fs-xs"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0 border-0 shadow" 
                             aria-labelledby="integrated-nav-dropdown" style="min-width: 280px;">
                            <!-- 菜单头部 -->
                            <div class="bg-primary-light text-primary p-3 rounded-top">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-user me-2"></i>
                                    <div>
                                        <h6 class="mb-0">这里是用户名字</h6>
                                        <small class="opacity-75">这里是用户id</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 导航索引部分 -->
                            <div class="p-3 border-bottom">
                                <h6 class="mb-2 text-uppercase fs-sm text-muted">服主快速导航</h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a class="dropdown-item d-flex align-items-center rounded p-2" href="/dashboard">
                                            <i class="fa fa-chart-line text-primary me-2"></i>
                                            <div>
                                                <div class="fw-medium">数据统计</div>
                                                <small class="text-muted">查看分析报告</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="dropdown-item d-flex align-items-center rounded p-2" href="/content/add">
                                            <i class="fa fa-plus-circle text-success me-2"></i>
                                            <div>
                                                <div class="fw-medium">创建服务</div>
                                                <small class="text-muted">发布新服务器</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="dropdown-item d-flex align-items-center rounded p-2" href="/settings">
                                            <i class="fa fa-cog text-warning me-2"></i>
                                            <div>
                                                <div class="fw-medium">展示设置</div>
                                                <small class="text-muted">配置服务器信息</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="dropdown-item d-flex align-items-center rounded p-2" href="/help">
                                            <i class="fa fa-question-circle text-info me-2"></i>
                                            <div>
                                                <div class="fw-medium">帮助中心</div>
                                                <small class="text-muted">查看文档</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 主题切换部分 -->
                            <div class="p-3 border-bottom">
                                <h6 class="mb-2 text-uppercase fs-sm text-muted">主题风格</h6>
                                
                                <!-- 深色/浅色模式切换 -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-moon me-2"></i>
                                        <span>深色模式</span>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle" id="dark-mode-toggle">
                                        <i class="far fa-circle"></i>
                                    </button>
                                </div>
                                
                                <!-- 主题颜色选择 -->
                                <h6 class="mb-2 text-uppercase fs-sm text-muted">主题颜色</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="default" href="#">
                                <span>Default</span>
                                <i class="fa fa-circle text-default"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="assets/css/themes/amethyst.min-5.6.css" href="#">
                                <span>Amethyst</span>
                                <i class="fa fa-circle text-amethyst"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="assets/css/themes/city.min-5.6.css" href="#">
                                <span>City</span>
                                <i class="fa fa-circle text-city"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="assets/css/themes/flat.min-5.6.css" href="#">
                                <span>Flat</span>
                                <i class="fa fa-circle text-flat"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="assets/css/themes/modern.min-5.6.css" href="#">
                                <span>Modern</span>
                                <i class="fa fa-circle text-modern"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="assets/css/themes/smooth.min-5.6.css" href="#">
                                <span>Smooth</span>
                                <i class="fa fa-circle text-smooth"></i>
                            </a>
                                </div>
                            </div>
                            
                            <!-- 快捷操作 -->
                            <div class="p-3">
                                <h6 class="mb-2 text-uppercase fs-sm text-muted">快捷操作</h6>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-alt-primary flex-grow-1" href="/profile">
                                        <i class="fa fa-user me-1"></i> 个人资料
                                    </a>
                                    <a class="btn btn-sm btn-alt-success flex-grow-1" href="/notifications">
                                        <i class="fa fa-bell me-1"></i> 通知
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>    
                    */ ?>
                             
                                      
                                                        
                    <!-- 独立的深色模式切换按钮（保留原有功能） -->
                    <button type="button" class="btn btn-alt-secondary me-2" data-toggle="layout" data-action="dark_mode_toggle" title="切换深色/浅色模式">
                        <i class="far fa-moon"></i>
                    </button>
                    
                    <!-- 用户菜单或其他 -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-secondary" id="user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end fs-sm border-0 shadow" aria-labelledby="user-dropdown">
                            <a class="dropdown-item" href="/l">
                                <i class="fa fa-user me-1"></i> 登录/注册
                            </a>
                            <a class="dropdown-item" href="/n">
                                <i class="fa fa-bell me-1"></i> 平台通知
                                <span class="badge bg-primary rounded-pill ms-1">3</span>
                            </a>
                            <a class="dropdown-item" href="/r">
                                <i class="fa fa-question-circle me-1"></i> 用户协议
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://mcmsf.com">
                                <i class="fa fa-sign-out-alt me-1"></i> 返回H5版网站
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-primary-lighter">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
                    </div>
                </div>
            </div>
        </header>
<main id="main-container">
    <div id="one-hero" class="bg-body-extra-light bg-image"
        data-bg="<?php echo conf('Index_Image');?>"
        style="background-color: #f3f4f6; background-size: cover; background-position: center center; background-repeat: no-repeat; min-height: 400px;">

    <div class="content content-full h-100">
        <div class="row g-0 h-100 align-items-center">
            <div class="col-md-8 pt-5 pb-5 text-start">

                <!-- 名言（你原来的，未改） -->
                <div class="d-inline-flex align-items-center space-x-1 fs-sm badge bg-success-light text-success mb-2 p-2">
                    <span>「 <span id="jinrishici-sentence"></span>」</span>
                </div>

                <!-- LOGO + 标题 + 类型轮播（核心） -->
                <h1 class="hero-main-title mb-3 d-flex align-items-center flex-wrap">
                    <img src="company-logo.svg"
                        alt="MCMSF Logo"
                        loading="lazy"
                        class="hero-logo">

                    <span class="hero-site-title">
                        <?php echo conf('Name');?> - <?php echo conf('SiteName');?>
                    </span>

                    <div class="hero-type-line-inline">
  为您精选
  <span class="hero-type-rotate">
    <span class="type-survival is-visible">生存</span>
    <span class="type-tech">生电</span>
    <span class="type-creative">创造</span>
    <span class="type-mod">模组</span>
    <span class="type-mini">小游戏</span>
    <span class="type-group">群组</span>
    <span class="type-anarchy">无政府</span>
  </span>
  服务器
                    </span>
                </h1>

                <!-- 平台简介 -->
                <p class="hero-type-line-inline">
                    <?php echo conf_index('Index_About') ?>
                </p>

                <!-- 按钮（你原来的，未改） -->
                <a class="btn btn-alt-primary py-2 px-3 m-1"
                   data-toggle="click-ripple"
                   data-pjax
                   href="javascript:;"
                   onclick="moyi();">
                    <i class="fa fa-fw fa-arrow-up opacity-50 me-1"></i>
                    提交服务器
                </a>

                <a class="btn btn-alt-primary py-2 px-3 m-1 flex-fill text-nowrap"
                   style="max-width: 280px;"
                   data-toggle="click-ripple"
                   data-pjax
                   href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=SrMWlwJewLLGjy2xDTYYN-XNJ8JDaCSw"
                   onclick="Ma();">
                    <i class="fab fa-qq me-2"></i>
                    玩家企鹅群
                </a>

            </div>
        </div>
    </div>
</div>
<script>
(function () {
    const items = document.querySelectorAll('.hero-type-rotate span');
    let index = 0;

    setInterval(() => {
        items[index].classList.remove('is-visible');
        index = (index + 1) % items.length;
        items[index].classList.add('is-visible');
    }, 2400);
})();
// 延迟加载 Hero 背景图，避免首次渲染阻塞
document.addEventListener('DOMContentLoaded', function() {
    try {
        const hero = document.getElementById('one-hero');
        if (hero) {
            const bg = hero.getAttribute('data-bg');
            if (bg) {
                const img = new Image();
                img.src = bg;
                img.onload = function() {
                    hero.style.backgroundImage = "url('" + bg + "')";
                };
            }
        }
    } catch (e) {
        console && console.warn && console.warn('hero bg lazy load failed', e);
    }
});
</script>
    <style>
    /* ===== Hero 主标题 ===== */

.hero-main-title {
    font-size: 30px;
    font-weight: 700;
    line-height: 1.4;
    gap: 10px;
}

/* Logo */
.hero-logo {
    height: 40px;
    width: auto;
}

/* 网站名渐变（高级、稳重） */
.hero-site-title {
    background: linear-gradient(90deg, #60A5FA, #A78BFA, #F472B6);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: siteGradient 5s ease infinite;
}

@keyframes siteGradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== 为您精选 ××× 服务器 ===== */

.hero-type-line-inline {
    font-size: 18px;
    font-weight: 500;
    margin-left: 6px;
    color: #ffffff;
    opacity: 0.95;
    display: inline-flex;
    align-items: center;
}

/* 轮播容器 */
.hero-type-rotate {
    position: relative;
    min-width: 1.5em;
    height: 1.4em;
    margin: 0 6px;
}

/* 公共动画 */
.hero-type-rotate span {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    transform: translateY(100%);
    transition: opacity .45s ease, transform .45s ease;
    white-space: nowrap;

    background-size: 200% 200%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: typeGradient 3s ease infinite;
}

.hero-type-rotate span.is-visible {
    opacity: 1;
    transform: translateY(0);
    position: relative;
}

/* 每种服务器类型独立渐变 */

/* 每种服务器类型独立渐变 */

.type-survival{
    background: linear-gradient(90deg, #22C55E, #4ADE80);
}

.type-tech{
    background: linear-gradient(90deg, #06B6D4, #00aaff);
}

.type-creative{
    background: linear-gradient(90deg, #A855F7, #EC4899);
}

.type-mod{
    background: linear-gradient(90deg, #F97316, #FACC15);
}

.type-mini{
    background: linear-gradient(90deg, #38BDF8, #22D3EE);
}

.type-group{
    background: linear-gradient(90deg, #6366F1, #4F46E5);
}

.type-anarchy{
    background: linear-gradient(90deg, #EF4444, #991B1B);
}
@keyframes typeGradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== 平台简介 ===== */

.hero-intro {
    font-size: 17px;
    line-height: 1.8;
    max-width: 720px;
    color: rgba(255, 255, 255, 0.85);
    margin-top: 6px;
}

/* ===== 移动端 ===== */

@media (max-width: 768px) {
    .hero-main-title {
        font-size: 24px;
    }

    .hero-type-line-inline {
        font-size: 16px;
    }

    .hero-logo {
        height: 32px;
    }

    .hero-intro {
        font-size: 15px;
    }
}
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; }
        body.sf-body { background-color: #f7f8fa; color: #333; min-height: 100vh; display: flex; flex-direction: column; }
        
        .sf-container { width: 100%; margin: 0 auto; padding: 20px; display: flex; flex-direction: column; }
        .sf-header { display: flex; align-items: center; margin-top: 10px; margin-bottom: 80px; }
        .sf-logo-icon { width: 32px; height: 32px; margin-right: 10px; }
        .sf-logo-text { font-size: 24px; font-weight: 700; color: #2d9cdb; letter-spacing: 1px; line-height: 1.2; }
        .sf-logo-subtext { font-size: 10px; color: #2d9cdb; font-weight: 700; letter-spacing: 0.5px; }
        
        .sf-content-area { display: flex; flex-direction: column; justify-content: center; }
        .sf-promo-banner { display: inline-flex; align-items: center; background-color: #e6eaf8; color: #4a90e2; padding: 8px 14px; border-radius: 6px; font-size: 15px; font-weight: 600; margin-bottom: 5px; align-self: flex-start; cursor: pointer; transition: 0.3s; }
        .sf-promo-banner svg { width: 16px; height: 16px; margin-left: 6px; fill: currentColor; }
        
        h1.sf-main-title { font-size: 42px; color: #3c9cf8; margin-bottom: 15px; font-weight: 500; letter-spacing: 2px; line-height: 1.2; }
        
        .sf-features-wrapper { margin-bottom: 10px; }
        .sf-features-grid { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 12px; }
        .sf-feature-pill { background-color: #e0e0e0; color: #333; padding: 4px 12px; border-radius: 14px; font-size: 12px; font-weight: 500; display: inline-flex; align-items: center; justify-content: center; transition: background-color 0.2s; }
        
        .sf-badge-yellow { display: inline-flex; align-items: center; background-color: #fde8bc; color: #e67e22; padding: 10px 18px; border-radius: 30px; font-size: 15px; font-weight: bold; margin-bottom: 30px; align-self: flex-start; }
        .sf-badge-icon { background-color: #e67e22; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 12px; flex-shrink: 0; }
        
        .sf-button-group { display: flex; gap: 15px; width: 100%; }
        .sf-btn { padding: 14px 0; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; text-align: center; flex: 1 1 0%; border: 1px solid transparent; transition: 0.2s ease-in-out; white-space: nowrap; }
        .sf-btn-primary { background-color: #587bf0; color: white; box-shadow: rgba(88,123,240,0.3) 0 4px 12px; }
        .sf-btn-secondary { background-color: white; color: #666; border-color: #ccc; }
        .sf-btn-outline-green { background-color: white; color: #28c445; border-color: #28c445; }
        
        .sf-logo-svg { fill: none; stroke: #f2994a; stroke-width: 5; stroke-linecap: round; }

        @media (min-width: 768px) {
            body.sf-body { justify-content: center; }
            .sf-container { max-width: 1000px; padding: 40px; flex-direction: column; }
            .sf-header { margin-bottom: 60px; }
            .sf-logo-icon { width: 40px; height: 40px; }
            .sf-logo-text { font-size: 28px; }
            .sf-content-area { padding-left: 0; }
            h1.sf-main-title { font-size: 56px; margin-bottom: 40px; }
            .sf-feature-pill { font-size: 16px; padding: 10px 24px; }
            .sf-badge-yellow { font-size: 16px; }
            .sf-button-group { width: auto; justify-content: flex-start; gap: 20px; }
            .sf-btn { flex: 0 0 auto; padding: 15px 40px; min-width: 160px; font-size: 18px; }
            .sf-promo-banner:hover { background-color: #dce2f5; }
            .sf-feature-pill:hover { background-color: #d0d0d0; cursor: default; }
            .sf-btn:hover { transform: translateY(-3px); }
            .sf-btn-primary:hover { background-color: #4a6cdd; box-shadow: rgba(88,123,240,0.4) 0 8px 20px; }
            .sf-btn-secondary:hover { background-color: #f5f5f5; border-color: #bbb; }
            .sf-btn-outline-green:hover { background-color: #f0fdf4; box-shadow: rgba(40,196,69,0.2) 0 4px 12px; }
        }
    </style>
<?php /*                <div id="one-hero-after" class="bg-body-light">
                <div class="content">
                    <div class="row py-4 text-center" >
                        
                        <div class="col-6 col-md-4 col-xl-3 ">
                            <div class="item item-rounded my-3 item-1x mx-auto text-amethyst bg-amethyst-lighter push">
                                <i class="fa fa-fw fa-2x fa-boxes"></i>
                            </div>
                            <h4 class="mb-2"><?php echo conf_index('Index_Services_t1') ?></h4>
                            <p class="text-muted">
                                <?php echo conf_index('Index_Services_d1') ?>
                            </p>
                        </div>
                        
                                               <div class="col-6 col-md-4 col-xl-3 ">
                            <div class="item item-rounded my-3 item-1x mx-auto text-flat bg-flat-lighter push">
                             <i class="fa fa-fw fa-2x fa-laptop-code"></i>
                            </div>
                            <h4 class="mb-2"><?php echo conf_index('Index_Services_t2') ?></h4>
                            <p class="text-muted">
                                <?php echo conf_index('Index_Services_d2') ?>
                            </p>
                        </div>
                                               <div class="col-6 col-md-4 col-xl-3 ">
                            <div class="item item-rounded my-3 item-1x mx-auto text-smooth bg-smooth-lighter push">
                                <i class="fa fa-fw fa-2x fa-cloud"></i>
                            </div>
                            <h4 class="mb-2"><?php echo conf_index('Index_Services_t3') ?></h4>
                            <p class="text-muted">
                                <?php echo conf_index('Index_Services_d3') ?>
                            </p>
                        </div>
                                               <div class="col-6 col-md-4 col-xl-3 ">
                            <div class="item item-rounded my-3 item-1x mx-auto text-city bg-city-lighter push">
                                <i class="fa fa-fw fa-2x fa-user-lock"></i>
                            </div>
                            <h4 class="mb-2"><?php echo conf_index('Index_Services_t4') ?></h4>
                            <p class="text-muted">
                                <?php echo conf_index('Index_Services_d4') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="moyi" class="bg-body-extra-light">
                <div class="content content-full">
                    <div class="row py-5">
                        <div class="order-md-0 col-md-0 text-center  align-items-center">
                            <div>
                                <h2 class="h1 fw-bold mb-2">
                                    Hitokoto
                                </h2>
                                <p class="fs-lg fw-medium text-muted mb-4" id="hitokoto_text">
                                    :D 获取中...
                                </p>
                                <h3 class="h4 fw-bold mb-2" id="hitokoto_from">
                                    :D 获取中...
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>*/ ?>
            
<div class="oneui-wheel-nav">
    <div class="wheel-track">
        <div class="wheel-item active" data-target="servers">🔥服务器列表</div>
        <div class="wheel-item" data-target="videos">浆果视频</div>
        <div class="wheel-item" data-target="recommend">✨精选服务器</div>
        <div class="wheel-item" data-target="forum">社区讨论</div>
        <div class="wheel-item" data-target="ai">AI 对话</div>
        <div class="wheel-item" data-target="docs">文档</div>
    </div>
</div>
<!-- 模块内容区域 -->
<div class="module-wrapper">

    <!-- 服务器列表（放你原来的服务器页面内容） -->
<div class="module-page active" id="page-servers">
    <div id="one-versions" class="bg-body-light">
        <div class="content content-full">
            <div class="py-4"> <!-- 从 py-5 改为 py-4 -->
                <div class="row mb-4"> <!-- 从 mb-5 改为 mb-4 -->
                    <div class="col-md-12 text-center">
                        <!-- 插入的小标签 -->
                        <div class="section-badge slide-in-bottom mb-2"> <!-- 从 mb-3 改为 mb-2 -->
                            <span class="badge bg-primary px-3 py-2 rounded-pill">
                                <i class="fas fa-server me-2"></i>MCMSF - 服务器专区
                            </span>
                        </div>
                        
                        <h2 class="fw-bold mb-2">推荐服务器列表</h2> <!-- 从 mb-3 改为 mb-2 -->
                        <p class="text-muted mb-0">使用Ai高效搜索，找到最适合您的服务器</p>
                    </div>
                </div>
<style>
/* 加载更多按钮样式 */
#loadMoreContainer {
    margin-top: 30px;
}

#loadMoreBtn {
    padding: 10px 30px;
    font-size: 16px;
    border-radius: 8px;
}

/* 项目卡片样式（确保与原有样式一致） */
.project-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.2s ease;
    text-decoration: none;
    color: inherit;
}

.project-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-decoration: none;
}

.image-container {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.source-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    color: white;
}

.badge-member { background: #10b981; }
.badge-mcjpg { background: #3b82f6; }
.badge-mscpo { background: #8b5cf6; }
.badge-other { background: #6b7280; }

.hotness-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    color: white;
}

.hotness-high { background: #ef4444; }
.hotness-medium { background: #f59e0b; }
.hotness-low { background: #6b7280; }

.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: #f9fafb;
}

.online-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 5px;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}
</style>
<!-- OneUI 5.6 风格搜索区域 - 仅优化PC适配 -->
<div class="oneui-search-container" style="max-width: 500px; margin: 20px 0;">
    <!-- 第一排：搜索框 -->
    <div class="oneui-search-row">
        <div class="oneui-search-input-group">
            <input type="text" class="oneui-search-input" id="searchInput" 
                   placeholder="搜索服务器、版本、标签..." 
                   value="<?php echo isset($_GET['kw']) ? htmlspecialchars($_GET['kw']) : ''; ?>">
            <button type="button" class="oneui-search-btn" id="searchBtn">
                <i class="fa fa-search"></i>
                <span>GO</span>
            </button>
        </div>
    </div>

    <!-- 第二排：下拉筛选 + AI按钮 -->
    <div class="oneui-search-row" style="margin-top: 12px;">
        <div class="oneui-filter-group">
            <!-- 下拉1：版本服务器类型 -->
            <div class="oneui-dropdown">
                <button class="oneui-dropdown-btn" id="typeBtn">
                    <?php echo isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '全部类型'; ?>
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="oneui-dropdown-menu" id="typeMenu">
                    <a href="javascript:void(0)" data-value="">全部类型</a>
                    <a href="javascript:void(0)" data-value="生存">生存</a>
                    <a href="javascript:void(0)" data-value="生电">生电</a>
                    <a href="javascript:void(0)" data-value="创造">创造</a>
                    <a href="javascript:void(0)" data-value="模组">模组</a>
                    <a href="javascript:void(0)" data-value="小游戏">小游戏</a>
                    <a href="javascript:void(0)" data-value="群组服">群组服</a>
                    <a href="javascript:void(0)" data-value="无政府">无政府</a>
                </div>
            </div>
            
            <!-- 下拉2：服务器版本 -->
            <div class="oneui-dropdown">
                <button class="oneui-dropdown-btn" id="versionBtn">
                    <?php echo isset($_GET['version']) ? htmlspecialchars($_GET['version']) : '全部版本'; ?>
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="oneui-dropdown-menu" id="versionMenu">
                    <a href="javascript:void(0)" data-value="">全部版本</a>
                    <a href="javascript:void(0)" data-value="1.12.2">1.12.2</a>
                    <a href="javascript:void(0)" data-value="1.16.5">1.16.5</a>
                    <a href="javascript:void(0)" data-value="1.18.2">1.18.2</a>
                    <a href="javascript:void(0)" data-value="1.19.4">1.19.4</a>
                    <a href="javascript:void(0)" data-value="1.20.1">1.20.1</a>
                    <a href="javascript:void(0)" data-value="1.21">1.21</a>
                    <a href="javascript:void(0)" data-value="基岩版">基岩版</a>
                    <a href="javascript:void(0)" data-value="微软租赁服">微软租赁服</a>
                    <a href="javascript:void(0)" data-value="网易我的山头">网易我的山头</a>
                </div>
            </div>
            
            <!-- 按钮3：AI搜索 -->
            <button class="oneui-ai-btn" id="aiSearchBtn" onclick="openAISearch()">
                <i class="fa fa-robot"></i> AI 搜索
            </button>
        </div>
    </div>
</div>

<style>
/* 基础样式完全不变，只添加PC端优化 */
.oneui-search-row {
    width: 100%;
}
.oneui-search-input-group, .oneui-filter-group {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* 第一排：搜索框样式 */
.oneui-search-input {
    flex: 1;
    padding: 10px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    line-height: 24px;
    color: #1f2937;
    background-color: #ffffff;
    transition: all 0.2s ease;
    outline: none;
    box-sizing: border-box;
}
.oneui-search-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
.oneui-search-input::placeholder {
    color: #9ca3af;
}
.oneui-search-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    background-color: #3b82f6;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}
.oneui-search-btn:hover {
    background-color: #2563eb;
    transform: translateY(-1px);
}
.oneui-search-btn:active {
    transform: translateY(0);
}

/* 第二排：下拉筛选 + AI按钮样式 */
.oneui-dropdown {
    flex: 1;
    position: relative;
}
.oneui-dropdown-btn {
    width: 100%;
    padding: 10px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background-color: #ffffff;
    color: #1f2937;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s ease;
}
.oneui-dropdown-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
}
.oneui-dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    margin-top: 4px;
    padding: 8px 0;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 99;
}
.oneui-dropdown-menu a {
    display: block;
    padding: 8px 16px;
    color: #1f2937;
    font-size: 14px;
    text-decoration: none;
}
.oneui-dropdown-menu a:hover {
    background-color: #f3f4f6;
}

/* AI按钮样式 */
.oneui-ai-btn {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    background-color: #D2DDF7;
    color: #2E4885;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}
.oneui-ai-btn:hover {
    background-color: #059669;
}

/* ====================== */
/* PC端专属优化 - 仅在大屏生效 */
/* ====================== */
@media (min-width: 768px) {
    /* 增大容器宽度 */
    .oneui-search-container {
        max-width: 700px;
        margin: 30px auto;
    }
    
    /* 增大字体和间距 */
    .oneui-search-input {
        padding: 12px 20px;
        font-size: 16px;
    }
    
    .oneui-search-btn {
        padding: 12px 24px;
        font-size: 16px;
        min-width: 90px;
    }
    
    .oneui-dropdown-btn {
        padding: 12px 20px;
        font-size: 15px;
    }
    
    .oneui-ai-btn {
        padding: 12px 24px;
        font-size: 15px;
    }
    
    /* 下拉菜单宽度优化 */
    .oneui-dropdown-menu {
        min-width: 160px;
        width: auto;
        left: 0;
        right: 0;
        max-height: 300px;
        overflow-y: auto;
    }
    
    /* 确保下拉菜单文本完整显示 */
    .oneui-dropdown-menu a {
        white-space: nowrap;
        padding: 10px 20px;
    }
    
    /* 增大间距 */
    .oneui-search-input-group,
    .oneui-filter-group {
        gap: 12px;
    }
}

/* 超大屏幕进一步优化 */
@media (min-width: 1024px) {
    .oneui-search-container {
        max-width: 800px;
    }
    
    .oneui-search-input-group {
        gap: 15px;
    }
    
    .oneui-filter-group {
        gap: 15px;
    }
}

/* 深色模式适配 - 保持原样，只添加PC端优化 */
@media (prefers-color-scheme: dark) {
    .oneui-search-input, .oneui-dropdown-btn {
        background-color: #1f2937;
        border-color: #374151;
        color: #f9fafb;
    }
    .oneui-search-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }
    .oneui-search-input::placeholder {
        color: #9ca3af;
    }
    .oneui-search-btn {
        background-color: #2563eb;
    }
    .oneui-search-btn:hover {
        background-color: #1d4ed8;
    }
    .oneui-dropdown-btn:hover {
        border-color: #60a5fa;
        color: #60a5fa;
    }
    .oneui-dropdown-menu {
        background-color: #1f2937;
        border-color: #374151;
    }
    .oneui-dropdown-menu a {
        color: #f9fafb;
    }
    .oneui-dropdown-menu a:hover {
        background-color: #374151;
    }
    .oneui-ai-btn {
        background-color: #059669;
    }
    .oneui-ai-btn:hover {
        background-color: #047857;
    }
}

/* PC端深色模式优化 */
@media (prefers-color-scheme: dark) and (min-width: 768px) {
    .oneui-search-input:focus {
        box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.25);
    }
    
    .oneui-dropdown-menu {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }
}

/* 卡片相关样式保持原样 */
.project-card {
    border-radius: 8px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
}
.project-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}
.image-container {
    position: relative;
    height: 160px;
    overflow: hidden;
}
.image-container img {
    object-fit: cover;
}
.source-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
    color: #fff;
}
.hotness-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
    color: #fff;
    background-color: #ff7e33;
}
.card-content {
    background-color: #fff;
}
.action-bar {
    padding: 8px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9fafb;
}
.status-indicator {
    display: flex;
    align-items: center;
    font-size: 12px;
}
.status-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin-right: 4px;
}

/* ========== 仅PC端生效（>= 1024px） ========== */
@media (min-width: 1024px) {
  /* 1. 放宽搜索区域最大宽度 */
  .oneui-search-container {
    max-width: 800px !important;
    margin: 32px auto !important; /* 居中，上下留白更多 */
  }

  /* 2. 输入框：更大、更扁、圆角变小 */
  .oneui-search-input {
    font-size: 16px !important;
    padding: 14px 24px !important;
    height: 52px !important;
    border-radius: 6px !important;
  }

  /* 3. 按钮：同步高度 */
  .oneui-search-btn {
    height: 52px !important;
    padding: 0 28px !important;
    border-radius: 6px !important;
    font-size: 15px !important;
  }

  /* 4. 下拉与AI按钮也同步高度 */
  .oneui-dropdown-btn,
  .oneui-ai-btn {
    height: 52px !important;
    font-size: 15px !important;
    border-radius: 6px !important;
  }

  /* 5. 统一行高，防止错位 */
  .oneui-search-input-group,
  .oneui-filter-group {
    align-items: stretch !important;
  }
}

</style>

<!-- 卡片容器：默认隐藏 -->
<div class="row" id="cardContainer" style="display: none;">
    <?php
    // 初始加载时不渲染任何内容
    ?>
</div>

<!-- 加载更多按钮 -->
<div id="loadMoreContainer" class="text-center mt-4" style="display: none;">
    <button id="loadMoreBtn" class="btn btn-alt-primary">
        <i class="fas fa-spinner fa-spin me-2 d-none"></i>
        加载更多
    </button>
    <div id="noMoreData" class="text-muted mt-3" style="display: none;">
        <i class="fas fa-check-circle text-success me-2"></i>以上是全部搜索数据
    </div>
</div>

<script>
// 全局变量
let currentPage = 1;
let isLoading = false;
let hasMore = true;
let currentFilters = {
    kw: '',
    type: '',
    version: ''
};

// 定义颜色映射（与PHP保持一致）
const tagColorMap = {
    '生存': { bg: 'bg-success-light', text: 'text-success' },
    '生电': { bg: 'bg-info-light', text: 'text-info' },
    '创造': { bg: 'bg-primary-light', text: 'text-primary' },
    '模组': { bg: 'bg-danger-light', text: 'text-danger' },
    '小游戏': { bg: 'bg-warning-light', text: 'text-warning' },
    '群组服': { bg: 'bg-smooth-light', text: 'text-smooth' },
    '无政府': { bg: 'bg-dark-light', text: 'text-dark' },
    '免费': { bg: 'bg-success-light', text: 'text-success' },
    '公益': { bg: 'bg-info-light', text: 'text-info' }
};

const oneuiColors = [
    { bg: 'bg-success-light', text: 'text-success' },
    { bg: 'bg-info-light', text: 'text-info' },
    { bg: 'bg-warning-light', text: 'text-warning' },
    { bg: 'bg-danger-light', text: 'text-danger' },
    { bg: 'bg-primary-light', text: 'text-primary' },
    { bg: 'bg-smooth-light', text: 'text-smooth' }
];

const typeValueMap = {
    '1': '成员服',
    '0': 'MCJPG',
    '2': 'MSCPO',
    '3': '其他平台'
};

const sourceIcons = {
    '成员服': 'fa-users',
    'MCJPG': 'fa-image',
    'MSCPO': 'fa-server',
    '其他平台': 'fa-globe'
};

const sourceClasses = {
    '成员服': 'badge-member',
    'MCJPG': 'badge-mcjpg',
    'MSCPO': 'badge-mscpo',
    '其他平台': 'badge-other'
};

// 页面加载完成
document.addEventListener('DOMContentLoaded', function() {
    initSearch();
    // 移除初始加载：默认不显示卡片
});

// 初始化搜索事件
function initSearch() {
    // 搜索按钮
    document.getElementById('searchBtn').addEventListener('click', function() {
        currentFilters.kw = document.getElementById('searchInput').value.trim();
        currentPage = 1;
        loadProjects(true);
    });
    
    // 回车搜索
    document.getElementById('searchInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            currentFilters.kw = this.value.trim();
            currentPage = 1;
            loadProjects(true);
        }
    });
    
    // 下拉菜单点击事件
    initDropdown('typeBtn', 'typeMenu', 'type');
    initDropdown('versionBtn', 'versionMenu', 'version');
    
    // 加载更多按钮
    document.getElementById('loadMoreBtn').addEventListener('click', function() {
        if (!isLoading && hasMore) {
            currentPage++;
            loadProjects(false);
        }
    });
    
    // 点击外部关闭下拉菜单
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.oneui-dropdown')) {
            document.querySelectorAll('.oneui-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
}

// 初始化下拉菜单
function initDropdown(btnId, menuId, filterKey) {
    const btn = document.getElementById(btnId);
    const menu = document.getElementById(menuId);
    
    // 按钮点击切换菜单
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = menu.style.display === 'block';
        
        // 关闭其他菜单
        document.querySelectorAll('.oneui-dropdown-menu').forEach(m => {
            if (m !== menu) m.style.display = 'none';
        });
        
        menu.style.display = isOpen ? 'none' : 'block';
    });
    
    // 菜单项点击事件
    menu.querySelectorAll('a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            currentFilters[filterKey] = value;
            
            // 更新按钮文本
            btn.innerHTML = (value ? value : btnId === 'typeBtn' ? '全部类型' : '全部版本') + 
                          ' <i class="fa fa-chevron-down"></i>';
            
            menu.style.display = 'none';
            currentPage = 1;
            loadProjects(true);
        });
    });
}

// 加载项目
function loadProjects(reset = true) {
    if (isLoading) return;
    
    // 关键修改：当同时为全部类型和全部版本时，直接隐藏搜索结果
    const isTypeEmpty = !currentFilters.type || currentFilters.type === '';
    const isVersionEmpty = !currentFilters.version || currentFilters.version === '';
    const isKwEmpty = !currentFilters.kw || currentFilters.kw.trim() === '';
    
    // 如果是同时全部且没有搜索关键词
    if (isTypeEmpty && isVersionEmpty && isKwEmpty) {
        // 隐藏搜索结果区域，显示底部的完整列表
        document.getElementById('cardContainer').style.display = 'none';
        document.getElementById('loadMoreContainer').style.display = 'none';
        
        // 滚动到页面底部（完整列表的位置）
        setTimeout(() => {
            window.scrollTo({
                top: document.querySelector('.row.g-4.my-0').offsetTop - 100,
                behavior: 'smooth'
            });
        }, 100);
        
        return; // 直接返回，不执行搜索
    }
    
    isLoading = true;
    
    // 显示加载状态 + 显示卡片容器
    if (reset) {
        document.getElementById('cardContainer').style.display = 'flex';
        document.getElementById('cardContainer').style.flexWrap = 'wrap';
        document.getElementById('cardContainer').innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">加载中...</span>
                </div>
                <p class="mt-2 text-muted">加载中...</p>
            </div>`;
        document.getElementById('loadMoreContainer').style.display = 'none';
    } else {
        document.getElementById('loadMoreBtn').querySelector('i').classList.remove('d-none');
    }
    
    // 构建查询参数
    const params = new URLSearchParams();
    params.append('act', 'search_projects');
    
    // 添加搜索关键词（如果有）
    if (!isKwEmpty) {
        params.append('kw', currentFilters.kw.trim());
    }
    
    // 添加类型筛选（如果不是全部）
    if (!isTypeEmpty) {
        params.append('type', currentFilters.type);
    }
    
    // 添加版本筛选（如果不是全部）
    if (!isVersionEmpty) {
        params.append('version', currentFilters.version);
    }
    
    params.append('page', currentPage);
    params.append('limit', 12);
    
    // 发送请求
    fetch(`Ajax.php?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            isLoading = false;
            
            if (data.code === 1) {
                const projects = data.data.projects;
                const total = data.data.total;
                
                // 渲染项目
                if (reset) {
                    renderProjects(projects, true);
                } else {
                    renderProjects(projects, false);
                }
                
                // 更新加载更多按钮状态
                hasMore = currentPage < data.data.pages;
                updateLoadMoreButton(total);
            } else {
                showError(data.msg || '加载失败');
            }
        })
        .catch(error => {
            isLoading = false;
            showError('网络请求失败');
            console.error('Error:', error);
        });
}

// 渲染项目卡片
function renderProjects(projects, reset = true) {
    const container = document.getElementById('cardContainer');
    
    if (reset) {
        container.innerHTML = '';
    }
    
    if (projects.length === 0 && reset) {
        container.innerHTML = `
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">暂无项目</h4>
                    <p class="text-muted">没有找到匹配的服务器</p>
                </div>
            </div>`;
        return;
    }
    
    // 渲染每个项目
    projects.forEach((project, index) => {
        const projectHtml = createProjectCard(project, (reset ? 0 : container.children.length) + index + 1);
        container.innerHTML += projectHtml;
    });
}

// 创建单个项目卡片
function createProjectCard(project, index) {
    // 解析标签
    const moneyStr = project.money || "1.14.5,生存";
    const tags = moneyStr.split(',').map(tag => tag.trim()).filter(tag => tag);
    
    // 版本标签
    const version = project.version || '1.14.5';
    
    // 来源类型
    const sourceTypeValue = project.type || '1';
    const sourceType = typeValueMap[sourceTypeValue] || '成员服';
    const sourceIcon = sourceIcons[sourceType] || 'fa-hashtag';
    const sourceClass = sourceClasses[sourceType] || 'badge-member';
    
    // 状态颜色
    const statusClass = project.server_status === '运行中' ? 'text-success' : 'text-danger';
    const statusDotColor = project.server_status === '运行中' ? '#28a745' : '#dc3545';
    
    // 生成标签HTML
    let tagsHtml = '';
    
    // 版本标签
    tagsHtml += `
        <span class="badge bg-primary text-white d-inline-flex align-items-center px-2 py-1 me-0.7 mb-2">
            <i class="fas fa-cube me-1 opacity-75 fa-sm"></i> 
            <span>${escapeHtml(version)}</span>
        </span>`;
    
    // 其他标签
    if (tags.length > 0) {
        tags.forEach(tag => {
            const cleanTag = tag.trim();
            if (!cleanTag) return;
            
            let colorTheme = tagColorMap[cleanTag];
            if (!colorTheme) {
                colorTheme = oneuiColors[Math.floor(Math.random() * oneuiColors.length)];
            }
            
            tagsHtml += `
                <span class="badge ${colorTheme.bg} ${colorTheme.text} px-2 py-1 me-0.5 mb-2">
                    ${escapeHtml(cleanTag)}
                </span>`;
        });
    }
    
    // 行列分隔（模拟PHP逻辑）
    let rowSeparator = '';
    if (index % 4 === 0) rowSeparator += '<div class="w-100 d-none d-xl-block"></div>';
    if (index % 3 === 0) rowSeparator += '<div class="w-100 d-none d-lg-block d-xl-none"></div>';
    if (index % 2 === 0) rowSeparator += '<div class="w-100 d-none d-md-block d-lg-none"></div>';
    
    return `
        ${rowSeparator}
        <div class="col-md-6 col-lg-4 col-xl-3 project-item mb-4">
    <a class="project-card shadow-sm d-flex flex-column h-100" 
       href="works.php?id=${project.id}">
        
        <!-- 图片区域 -->
        <div class="image-container">
            <img class="img-fluid w-100 h-100" 
                 src="${project.img || 'default-project.jpg'}" 
                 alt="${escapeHtml(project.name)}"
                 onerror="this.src='default-project.jpg'">
            
            <!-- 左上角来源标签 -->
            <div class="source-badge ${sourceClass}">
                <i class="fas ${sourceIcon} me-1"></i> 
                ${escapeHtml(sourceType)}
            </div>
            
            <!-- 右上角热度标签 -->
            <div class="hotness-badge hotness-${project.hotness_class}">
                <i class="fas fa-fire"></i> 
                ${escapeHtml(project.hotness)}
            </div>
        </div>

        <!-- 内容区域 -->
        <div class="card-content flex-grow-1 p-3">
            <h4 class="project-title mb-2 fw-bold">
                ${escapeHtml(project.name)}
            </h4>

            <!-- 标签区域 -->
            <div class="tags-container mb-3">
                ${tagsHtml}
            </div>

            <!-- 项目简介 -->
            <p class="project-description fs-sm text-muted mb-0">
                ${escapeHtml(project.sketch || '暂无简介')}
            </p>
        </div>
        
<!-- 操作栏 -->
<div class="action-bar p-3 pt-2">
    <div class="d-flex justify-content-between align-items-center">
        <!-- 左侧：在线人数和状态 -->
        <div class="online-info d-flex align-items-center gap-1">
    <div class="d-flex align-items-center gap-2 px-1 py-1">
        <span class="icon ${statusClass}">
            <i class="fas fa-user fa-sm"></i>
        </span>
        <span class="count fw-bold">
            ${project.online_count}
        </span>
        <span class="label text-muted fs-xs">在线</span>
    </div>
            
            <div class="status-indicator d-flex align-items-center gap-2">
                <span class="status-dot" style="background-color: ${statusDotColor};"></span>
                <span class="text-muted">${project.server_status}</span>
            </div>
        </div>

        <!-- 右侧：查看详情按钮 -->
        <button class="btn btn-alt-primary border py-1 px-2 fs-xs"
                onclick="event.stopPropagation(); window.location.href='works.php?id=${project.id}'">
            查看详情
            <i class="fas fa-arrow-right fa-xs ms-1"></i>
        </button>
    </div>
</div>`;
}

// 更新加载更多按钮
function updateLoadMoreButton(total) {
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const noMoreData = document.getElementById('noMoreData');
    
    loadMoreBtn.querySelector('i').classList.add('d-none');
    
    if (total === 0) {
        loadMoreContainer.style.display = 'none';
    } else if (hasMore) {
        loadMoreContainer.style.display = 'block';
        loadMoreBtn.style.display = 'block';
        noMoreData.style.display = 'none';
    } else {
        loadMoreContainer.style.display = 'block';
        loadMoreBtn.style.display = 'none';
        noMoreData.style.display = 'block';
    }
}

// 显示错误
function showError(message) {
    const container = document.getElementById('cardContainer');
    container.style.display = 'flex';
    container.style.flexWrap = 'wrap';
    container.innerHTML = `
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                <h4 class="text-danger">加载失败</h4>
                <p class="text-muted">${escapeHtml(message)}</p>
                <button class="btn btn-alt-primary mt-3" onclick="loadProjects(true)">
                    重试
                </button>
            </div>
        </div>`;
}

// HTML转义
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// AI搜索跳转
function openAISearch() {
    const kw = document.getElementById('searchInput').value.trim();
    window.open(`ai.php?wd=${encodeURIComponent(kw)}`, '_blank', 'width=800,height=600');
}

// 切换下拉菜单函数（供按钮使用）
window.toggleDropdown = function(btn) {
    const menu = btn.nextElementSibling;
    const isOpen = menu.style.display === 'block';
    
    // 关闭其他菜单
    document.querySelectorAll('.oneui-dropdown-menu').forEach(m => {
        if (m !== menu) m.style.display = 'none';
    });
    
    menu.style.display = isOpen ? 'none' : 'block';
};
</script>


                                         <?php
// 定义 OneUI 风格的浅色系颜色数组，用于标签循环
$oneui_colors = [
    ['bg' => 'bg-success-light', 'text' => 'text-success'],   // 浅绿
    ['bg' => 'bg-info-light',    'text' => 'text-info'],      // 浅蓝
    ['bg' => 'bg-warning-light', 'text' => 'text-warning'],   // 浅橙
    ['bg' => 'bg-danger-light',  'text' => 'text-danger'],    // 浅红
    ['bg' => 'bg-primary-light', 'text' => 'text-primary'],   // 浅紫
    ['bg' => 'bg-smooth-light',  'text' => 'text-smooth'],    // 浅粉
];

// 标签内容-颜色映射数组
$tag_color_map = [
    '生存'      => ['bg' => 'bg-success-light', 'text' => 'text-success'],
    '生电'      => ['bg' => 'bg-info-light',    'text' => 'text-info'],
    '创造'      => ['bg' => 'bg-primary-light', 'text' => 'text-primary'],
    '模组'      => ['bg' => 'bg-danger-light',  'text' => 'text-danger'],
    '小游戏'    => ['bg' => 'bg-warning-light', 'text' => 'text-warning'],
    '群组服'    => ['bg' => 'bg-smooth-light',  'text' => 'text-smooth'],
    '无政府'    => ['bg' => 'bg-dark-light',    'text' => 'text-dark']
    // 可继续添加其他标签
];

// ========== 核心修改：将 ORDER BY id 改为 ORDER BY RAND() 实现随机排序 ==========
$projects = $DB->query("SELECT * FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1 ORDER BY RAND()");

// 项目计数器
$project_count = 0;

// ========== 关键修复1：移除 row 默认间距，添加 g-4 控制列间距 ==========
echo '<div class="row g-4 my-0">';

while($project = $projects->fetch()){
    $project_count++;
    
    $version = isset($project['version']) && !empty(trim($project['version'])) 
              ? trim($project['version']) 
              : '1.14.5';
              
    // ========== 核心修改：替换为 money 字段，适配逗号分隔格式 ==========
    $money_str = isset($project['money']) && !empty($project['money']) ? $project['money'] : "1.14.5,生存";
    $tags = explode(',', trim($money_str)); // 用逗号分割
    $tags = array_filter($tags, function($tag) {
        return !empty(trim($tag));
    });
    $tags = array_values($tags); // 重置索引，避免循环时索引错乱
    
    // 新增：数值 -> 类型名称 映射数组
    $type_value_map = [
        '1' => '成员服',
        '0' => 'MCJPG',
        '2' => 'MSCPO',
        '3' => '其他平台'
    ];

    // 来源类型图标映射（保持不变）
    $source_icons = [
        '成员服'  => 'fa-users',
        'MCJPG'   => 'fa-image',
        'MSCPO'   => 'fa-server',
        '其他平台'=> 'fa-globe'
    ];

    // 新增：类型 -> 类名 映射（用于 CSS 颜色区分）
    $source_classes = [
        '成员服'  => 'badge-member',
        'MCJPG'   => 'badge-mcjpg',
        'MSCPO'   => 'badge-mscpo',
        '其他平台'=> 'badge-other'
    ];

    // ========== 调整顺序：先获取 $source_type，再获取 $source_class ==========
    // 获取来源类型：数值转名称，无匹配则默认成员服
    $source_type_value = isset($project['type']) ? $project['type'] : '1';
    $source_type = isset($type_value_map[$source_type_value]) ? $type_value_map[$source_type_value] : '成员服';
    $source_icon = isset($source_icons[$source_type]) ? $source_icons[$source_type] : 'fa-hashtag';

    // 获取类名，无匹配则默认
    $source_class = isset($source_classes[$source_type]) ? $source_classes[$source_type] : 'badge-member';
?>

<!-- ========== 关键修复2：移除 project-item 的 mb-4 类，避免叠加间距 ========== -->
<div class="col-md-6 col-lg-4 col-xl-3 project-item">
    <a class="project-card shadow-sm d-flex flex-column h-100" 
       href="works.php?id=<?php echo htmlspecialchars($project['id']); ?>">
        
        <!-- 图片区域 -->
        <div class="image-container">
            <img class="img-fluid w-100 h-100" 
                 src="<?php echo !empty($project['img']) ? htmlspecialchars($project['img']) : 'default-project.jpg'; ?>" 
                 alt="<?php echo htmlspecialchars($project['name']); ?>"
                 onerror="this.src='default-project.jpg'">
            
            <!-- 左上角来源标签 -->
            <div class="source-badge <?php echo $source_class; ?>">
                <i class="fas <?php echo $source_icon; ?> me-1"></i> 
                <?php echo htmlspecialchars($source_type); ?>
            </div>
            
            <!-- 右上角热度标签 -->
            <?php
            // ========== 1. 先获取服务器状态和人数（复用online-info里的逻辑） ==========
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

            // ========== 2. 热度判定（现在能拿到正确的 $online_count 和 $server_status 了） ==========
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
            ?>
            <div class="hotness-badge hotness-<?php echo $hotness_class; ?>">
                <i class="fas fa-fire"></i> 
                <?php echo htmlspecialchars($hotness); ?>
            </div>
        </div>

        <!-- 内容区域 -->
        <div class="card-content flex-grow-1 p-3">
            <h4 class="project-title mb-2 fw-bold">
                <?php echo htmlspecialchars($project['name']); ?>
            </h4>

            <!-- 标签区域 -->
            <div class="tags-container mb-3">
                <?php
                // 1. 单独显示版本号标签（样式不变，用 $version 字段）
                ?>
                <span class="badge bg-primary text-white d-inline-flex align-items-center px-2 py-1 me-0.7 mb-2">
                    <i class="fas fa-cube me-1 opacity-75 fa-sm"></i> 
                    <span><?php echo htmlspecialchars($version); ?></span>
                </span>

                <?php
                // 2. 循环显示 money 字段拆分的所有类型标签（无索引判断，保留全部）
                if (!empty($tags)) {
                    foreach($tags as $tag) {
                        $clean_tag = trim($tag);
                        if (empty($clean_tag)) continue;
                        
                        $color_theme = isset($tag_color_map[$clean_tag]) 
                                      ? $tag_color_map[$clean_tag] 
                                      : $oneui_colors[array_rand($oneui_colors)];
                ?>
                    <span class="badge <?php echo $color_theme['bg']; ?> <?php echo $color_theme['text']; ?> px-2 py-1 me-0.5 mb-2">
                        <?php echo htmlspecialchars($clean_tag); ?>
                    </span>
                <?php
                    }
                } else {
                ?>
                    <span class="badge bg-secondary-light text-secondary px-2 py-1 me-1 mb-2">
                        暂无标签
                    </span>
                <?php } ?>
            </div>

            <!-- 项目简介 -->
            <p class="project-description fs-sm text-muted mb-0">
                <?php echo !empty($project['sketch']) ? htmlspecialchars($project['sketch']) : '暂无简介'; ?>
            </p>
        </div>
        
        <!-- 操作栏 -->
        <div class="action-bar p-3 pt-2">
            <div class="d-flex justify-content-between align-items-center">
                <!-- 左侧：在线人数和状态 -->
                <div class="online-info d-flex align-items-center gap-1">
                    <?php
                    // 这里可以直接复用上面的 $online_count 和 $server_status，无需重复调用API
                    $status_class = $server_status === '运行中' ? 'text-success' : 'text-danger';
                    $status_dot_color = $server_status === '运行中' ? '#28a745' : '#dc3545';
                    ?>
                    
                    <div class="d-flex align-items-center gap-2 px-1 py-1">
                        <span class="icon <?php echo $status_class; ?>">
                            <i class="fas fa-user fa-sm"></i>
                        </span>
                        <span class="count fw-bold">
                            <?php echo $online_count; ?>
                        </span>
                        <span class="label text-muted fs-xs">在线</span>
                    </div>
                    
                    <div class="status-indicator d-flex align-items-center gap-2">
                        <span class="status-dot" style="background-color: <?php echo $status_dot_color; ?>;"></span>
                        <span class="text-muted"><?php echo $server_status; ?></span>
                    </div>
                </div>

                <!-- 右侧：查看详情按钮 -->
                <button class="btn btn-alt-primary border py-1 px-2 fs-xs"
                        onclick="event.stopPropagation(); window.location.href='works.php?id=<?php echo $project['id']; ?>'">
                    查看详情
                    <i class="fas fa-arrow-right fa-xs ms-1"></i>
                </button>
            </div>
        </div>
    </a>
</div> <!-- 结束 .col-md-6.col-lg-4.col-xl-3.project-item -->

<?php
}

// 闭合行容器
echo '</div>';

// 如果没有项目
if ($project_count === 0) {
?>
<div class="col-12">
    <div class="text-center py-5">
        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">暂无项目</h4>
        <p class="text-muted">暂时没有可显示的项目</p>
    </div>
</div>
<?php
}
?>
                            </div>
                        </div>
                    </div>
                </div>

<!-- ================== 浆果视频（瀑布流） ================== -->
<div class="module-page" id="page-videos">
                  <!-- 浆果视频模块 -->
               
                    <div class="bg-body-light">
                        <div class="content content-full py-5">
                            <div class="row mb-5">
                                <div class="col-md-12 text-center">
                                    <div class="section-badge slide-in-bottom mb-3">
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            <i class="fas fa-video me-2"></i>浆果视频专区
                                        </span>
                                    </div>
                                    <h2 class="fw-bold mb-3">热门MC视频</h2>
                                    <p class="text-muted mb-0">精选Minecraft相关视频内容</p>
                                </div>
                            </div>
                            <div class="row g-4">
                                <?php
                                $video_projects = $DB->query("SELECT * FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1 AND url != '' AND url IS NOT NULL ORDER BY id DESC LIMIT 6");
                                $video_count = 0;
                                while($video = $video_projects->fetch()){
                                    $video_count++;
                                    if(!empty($video['url'])){
                                ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                            <div>
                                                <h4 class="mb-1"><?php echo htmlspecialchars($video['name']);?></h4>
                                                <p class="fs-sm text-muted mb-0"><?php echo htmlspecialchars($video['sketch']);?></p>
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full bg-body-light">
                                            <div class="ratio ratio-16x9">
                                                <iframe 
                                                    src="https://player.bilibili.com/player.html?bvid=<?php echo htmlspecialchars($video['url']); ?>&page=1&high_quality=1&danmaku=0"
                                                    loading="lazy"
                                                    scrolling="no"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                            <div class="mt-3 text-center">
                                                <a href="works.php?id=<?php echo $video['id'];?>" class="btn btn-sm btn-alt-primary">
                                                    <i class="fa fa-eye me-1"></i> 查看详情
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                if($video_count == 0){
                                ?>
                                <div class="col-12 text-center py-5">
                                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">暂无视频内容</p>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- 公告活动-->
<div class="module-page" id="page-recommend">
    <!-- 推荐列表模块 -->
    <div id="recommend-list" class="module">
        <div class="bg-body-light">
            <div class="content content-full py-5">
                <div class="row mb-5">
                    <div class="col-md-12 text-center">
                        <div class="section-badge slide-in-bottom mb-3">
                            <span class="badge bg-warning px-3 py-2 rounded-pill">
                                <i class="fas fa-star me-2"></i>编辑推荐
                            </span>
                        </div>
                        <h2 class="fw-bold mb-3">本周精选推荐</h2>
                        <p class="text-muted mb-0">本周精心挑选的优质服务器推荐</p>
                    </div>
                </div>
                <div class="row g-4">
                    <?php
                    // 首先查询所有符合条件的项目
                    $featured_projects = $DB->query("SELECT * FROM nteam_project_list WHERE status=1 AND is_show=1 AND Audit_status=1 ORDER BY id DESC LIMIT 12");
                    $featured_count = 0;
                    $displayed_count = 0; // 实际显示的计数
                    $max_display = 6; // 最多显示6个
                    
                    $featured_tag_color_map = [
                        '生存' => 'bg-success',
                        '生电' => 'bg-info',
                        '创造' => 'bg-primary',
                        '模组' => 'bg-danger',
                        '小游戏' => 'bg-warning',
                        '群组服' => 'bg-smooth',
                        '无政府' => 'bg-dark'
                    ];
                    
                    while($featured = $featured_projects->fetch()){
                        // 检查在线人数是否超过20人
                        $online_count = 0;
                        
                        // 方法1：如果数据库中有存储在线人数的字段（请根据实际字段名修改）
                        // 假设字段名为 'online' 或 'players' 或 'online_count'
                        if(isset($featured['online']) && $featured['online'] > 20) {
                            $online_count = $featured['online'];
                        }
                        // 或者如果有其他字段名
                        elseif(isset($featured['players']) && $featured['players'] > 20) {
                            $online_count = $featured['players'];
                        }
                        // 或者如果有 'online_count' 字段
                        elseif(isset($featured['online_count']) && $featured['online_count'] > 20) {
                            $online_count = $featured['online_count'];
                        }
                        // 方法2：如果没有存储在线人数，使用API获取（需要服务器地址）
                        elseif(isset($featured['paycontact']) && !empty(trim($featured['paycontact']))){
                            // 调用API获取在线人数
                            $server_addr = trim($featured['paycontact']);
                            $api_url = 'https://uapis.cn/api/v1/game/minecraft/serverstatus?server=' . urlencode($server_addr);
                            
                            $ch = curl_init();
                            curl_setopt_array($ch, [
                                CURLOPT_URL => $api_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_TIMEOUT => 3,
                                CURLOPT_SSL_VERIFYPEER => false
                            ]);
                            
                            $response = curl_exec($ch);
                            if($response){
                                $data = json_decode($response, true);
                                if(isset($data['online']) && $data['online'] === true && isset($data['players'])){
                                    $online_count = intval($data['players']);
                                }
                            }
                            curl_close($ch);
                        }
                        
                        // 如果在线人数不足20人，跳过这个项目
                        if($online_count < 20){
                            continue;
                        }
                        
                        // 如果已经显示了足够的项目，停止循环
                        if($displayed_count >= $max_display){
                            break;
                        }
                        
                        $featured_count++;
                        $displayed_count++;
                        $tag_color = isset($featured_tag_color_map[$featured['money']]) ? $featured_tag_color_map[$featured['money']] : 'bg-secondary';
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="block block-rounded block-link-pop h-100 mb-0 overflow-hidden">
                            <div class="bg-image" style="background-image: url('<?php echo htmlspecialchars($featured['img']);?>'); height: 180px;">
                                <div class="block-content bg-primary-dark-op">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="text-white mb-2"><?php echo htmlspecialchars($featured['name']);?></h4>
                                            <span class="badge <?php echo $tag_color; ?>"><?php echo htmlspecialchars($featured['money']);?></span>
                                            <!-- 可选：显示在线人数 -->
                                            <span class="badge bg-success ms-2">
                                                <i class="fas fa-users me-1"></i><?php echo $online_count; ?>人在线
                                            </span>
                                        </div>
                                        <i class="fa fa-star text-warning fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <p class="fs-sm text-muted mb-2"><?php echo htmlspecialchars(mb_substr($featured['sketch'], 0, 50));?><?php echo mb_strlen($featured['sketch']) > 50 ? '...' : '';?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fs-sm text-muted">
                                        <i class="fa fa-tag me-1"></i><?php echo htmlspecialchars($featured['version']);?>
                                    </span>
                                    <a href="works.php?id=<?php echo $featured['id'];?>" class="btn btn-sm btn-alt-primary">
                                        查看详情
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    if($displayed_count == 0){
                    ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-star fa-3x text-muted mb-3"></i>
                        <p class="text-muted">暂无符合条件的推荐内容</p>
                        <p class="text-muted fs-sm">（在线人数超过20人的服务器）</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- 讨论区 -->
    <div class="module-page" id="page-forum">
                <!-- 讨论区模块 -->
                <div id="discussion" class="module">
                    <div class="bg-body-light">
                        <div class="content content-full py-5">
                            <div class="row mb-5">
                                <div class="col-md-12 text-center">
                                    <div class="section-badge slide-in-bottom mb-3">
                                        <span class="badge bg-info px-3 py-2 rounded-pill">
                                            <i class="fas fa-comments me-2"></i>玩家讨论区
                                        </span>
                                    </div>
                                    <h2 class="fw-bold mb-3">社区讨论</h2>
                                    <p class="text-muted mb-0">与玩家交流心得、分享经验</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="block block-rounded mb-4">
                                        <div class="block-content block-content-full">
                                            <h4 class="mb-3">热门讨论</h4>
                                            <div class="list-group list-group-flush">
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1"><i class="fa fa-fire text-danger me-2"></i>新服务器推荐 - 生存服</h5>
                                                        <small class="text-muted">2小时前</small>
                                                    </div>
                                                    <p class="mb-1">有没有好的生存服务器推荐？想要一个和谐的社区...</p>
                                                    <small class="text-muted"><i class="fa fa-comments me-1"></i>12 回复</small>
                                                </a>
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1"><i class="fa fa-star text-warning me-2"></i>模组服务器如何选择？</h5>
                                                        <small class="text-muted">5小时前</small>
                                                    </div>
                                                    <p class="mb-1">想找一个有趣的模组服务器，有什么推荐吗？</p>
                                                    <small class="text-muted"><i class="fa fa-comments me-1"></i>8 回复</small>
                                                </a>
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1"><i class="fa fa-heart text-danger me-2"></i>分享一个不错的建筑服</h5>
                                                        <small class="text-muted">1天前</small>
                                                    </div>
                                                    <p class="mb-1">发现一个很棒的创造建筑服务器，大家可以来看看...</p>
                                                    <small class="text-muted"><i class="fa fa-comments me-1"></i>25 回复</small>
                                                </a>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <button class="btn btn-alt-primary" onclick="alert('讨论区功能正在完善中，敬请期待！')">
                                                    <i class="fa fa-plus me-1"></i> 发表新话题
                                                </button>
                                                <a href="javascript:void(0)" class="btn btn-alt-secondary">
                                                    查看更多讨论
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

    <!-- AI 对话 -->
    <div class="module-page" id="page-ai">
                <!-- AI对话模块 -->
                <div id="ai-chat" class="module">
                    <div class="bg-body-light">
                        <div class="content content-full py-5">
                            <div class="row mb-5">
                                <div class="col-md-12 text-center">
                                    <div class="section-badge slide-in-bottom mb-3">
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-robot me-2"></i>AI助手
                                        </span>
                                    </div>
                                    <h2 class="fw-bold mb-3">AI对话助手</h2>
                                    <p class="text-muted mb-0">智能回答MC相关问题</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-lg-8 mx-auto">
                                    <div class="block block-rounded mb-4">
                                        <div class="block-content block-content-full">
                                            <div class="text-center mb-4">
                                                <div class="item item-circle bg-success-light text-success mx-auto mb-3" style="width: 80px; height: 80px;">
                                                    <i class="fa fa-robot fa-2x"></i>
                                                </div>
                                                <h4 class="mb-2">AI 智能助手</h4>
                                                <p class="text-muted">我可以帮你解答关于MC服务器的问题，推荐合适的服务器，或者聊聊游戏相关的话题！</p>
                                            </div>
                                            <div class="chat-preview bg-body-light rounded p-3 mb-4" style="min-height: 200px; max-height: 300px; overflow-y: auto;">
                                                <div class="d-flex mb-3">
                                                    <div class="flex-shrink-0">
                                                        <div class="item item-circle bg-success text-white" style="width: 32px; height: 32px;">
                                                            <i class="fa fa-robot"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <div class="bg-white rounded p-2 shadow-sm">
                                                            <small class="text-muted d-block mb-1">AI助手</small>
                                                            <p class="mb-0">你好！我是MCMSF AI助手，有什么可以帮你的吗？</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-3 justify-content-end">
                                                    <div class="flex-grow-1 me-2 text-end">
                                                        <div class="bg-primary text-white rounded p-2 shadow-sm d-inline-block">
                                                            <small class="opacity-75 d-block mb-1">用户</small>
                                                            <p class="mb-0">推荐一个生存服务器</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="item item-circle bg-primary text-white" style="width: 32px; height: 32px;">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="item item-circle bg-success text-white" style="width: 32px; height: 32px;">
                                                            <i class="fa fa-robot"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <div class="bg-white rounded p-2 shadow-sm">
                                                            <small class="text-muted d-block mb-1">AI助手</small>
                                                            <p class="mb-0">根据你的需求，我推荐以下几个优质的生存服务器...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a href="ai.php" target="_blank" class="btn btn-success btn-lg">
                                                    <i class="fa fa-comments me-2"></i> 开始与AI对话
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

    <!-- 文档 -->
    <div class="module-page" id="page-docs">
                <!-- 文档模块 -->
                <div id="docs" class="module">
                    <div class="bg-body-light">
                        <div class="content content-full py-5">
                            <div class="row mb-5">
                                <div class="col-md-12 text-center">
                                    <div class="section-badge slide-in-bottom mb-3">
                                        <span class="badge bg-dark px-3 py-2 rounded-pill">
                                            <i class="fas fa-book me-2"></i>帮助文档
                                        </span>
                                    </div>
                                    <h2 class="fw-bold mb-3">帮助文档</h2>
                                    <p class="text-muted mb-0">平台使用指南和教程</p>
                                </div>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-primary-light text-primary mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-question-circle fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">新手指南</h4>
                                            <p class="fs-sm text-muted mb-3">了解如何开始使用MCMSF平台，找到合适的服务器</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="showDoc('getting-started')">
                                                查看指南
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-info-light text-info mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-server fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">服务器申请</h4>
                                            <p class="fs-sm text-muted mb-3">学习如何申请和提交你的Minecraft服务器</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="showDoc('server-application')">
                                                查看文档
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-success-light text-success mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-users fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">团队加入</h4>
                                            <p class="fs-sm text-muted mb-3">了解如何加入我们的团队，成为MCMSF的一员</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="$('#Join').click()">
                                                申请加入
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-warning-light text-warning mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-shield-alt fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">安全须知</h4>
                                            <p class="fs-sm text-muted mb-3">平台安全使用指南，保护你的账号安全</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="showDoc('security')">
                                                查看须知
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-danger-light text-danger mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-life-ring fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">常见问题</h4>
                                            <p class="fs-sm text-muted mb-3">查看常见问题解答，快速解决你的疑问</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="showDoc('faq')">
                                                查看FAQ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="block block-rounded block-link-pop h-100 mb-0">
                                        <div class="block-content block-content-full text-center">
                                            <div class="item item-circle bg-dark-light text-dark mx-auto mb-3" style="width: 64px; height: 64px;">
                                                <i class="fa fa-phone-alt fa-2x"></i>
                                            </div>
                                            <h4 class="mb-2">联系我们</h4>
                                            <p class="fs-sm text-muted mb-3">遇到问题需要帮助？联系我们获取支持</p>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" onclick="showDoc('contact')">
                                                联系方式
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div id="one-call-to-action" class="bg-body-light">
                        <div class="content content-full">
                       <div id="cookieads"></div>
</div>
<style>
/* ===== OneUI A 方案：文字为主，底色为辅 ===== */

.oneui-wheel-nav {
    margin: 8px 0 14px;
    padding-left: 20px;   /* ← 和内容区对齐 */
    padding-right: 20px;
}

/* 横向滑动轨道 */
.wheel-track {
    display: flex;
    gap: 22px;                 /* 拉开“阅读节奏” */
    padding: 4px 0;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.wheel-track::-webkit-scrollbar {
    display: none;
}

/* 分类文字（默认态 ≈ 正文结构） */
.wheel-item {
    flex-shrink: 0;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;            /* OneUI 常用次级文字色 */
    cursor: pointer;
    padding: 4px 2px;          /* 几乎无“按钮感” */
    white-space: nowrap;
    transition: color .2s ease;
}

/* hover：只变色，不加底 */
.wheel-item:hover {
    color: #2563eb;
}

/* 选中态：轻承托，而不是按钮 */
.wheel-item.active {
    color: #1f2937;
    font-weight: 600;
    background: #D2DDF7;

    padding: 2px 8px;     /* ← 比你直觉想的更小 */
    border-radius: 4px;  /* ← 接近文字块，而不是按钮 */
}

/* ===== 模块切换淡入 ===== */
.module-page {
    display: none;
    opacity: 0;
    transform: translateY(4px);
}

.module-page.active {
    display: block;
    animation: oneuiFade .25s ease forwards;
}

@keyframes oneuiFade {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== 视频瀑布流（示例） ===== */
.video-waterfall {
    column-count: 3;
    column-gap: 16px;
    padding: 12px 0;
}

.video-card {
    break-inside: avoid;
    margin-bottom: 16px;
}
</style>
<script>
const items = document.querySelectorAll('.wheel-item');
const pages = document.querySelectorAll('.module-page');
const track = document.querySelector('.wheel-track');

items.forEach(item => {
    item.addEventListener('click', () => {
        items.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        pages.forEach(p => p.classList.remove('active'));
        const page = document.getElementById('page-' + item.dataset.target);
        if (page) page.classList.add('active');

        // 滑到中间（轻微即可）
        const center = item.offsetLeft + item.offsetWidth / 2;
        track.scrollTo({
            left: center - track.clientWidth / 2,
            behavior: 'smooth'
        });
    });
});
</script>


<style>
/* OneUI 风格颜色定义 */
:root {
    --success-light: #d4edda;
    --success: #28a745;
    --info-light: #d1ecf1;
    --info: #17a2b8;
    --warning-light: #fff3cd;
    --warning: #ffc107;
    --danger-light: #f8d7da;
    --danger: #dc3545;
    --primary-light: #e0d4f9;
    --primary: #4a6fa5;
    --smooth-light: #f8d7f8;
    --smooth: #e83e8c;
    --dark: #343a40;
}

.bg-success-light { background-color: var(--success-light) !important; }
.text-success { color: var(--success) !important; }

.bg-info-light { background-color: var(--info-light) !important; }
.text-info { color: var(--info) !important; }

.bg-warning-light { background-color: var(--warning-light) !important; }
.text-warning { color: var(--warning) !important; }

.bg-danger-light { background-color: var(--danger-light) !important; }
.text-danger { color: var(--danger) !important; }

.bg-primary-light { background-color: var(--primary-light) !important; }
.text-primary { color: var(--primary) !important; }

.bg-smooth-light { background-color: var(--smooth-light) !important; }
.text-smooth { color: var(--smooth) !important; }

.bg-secondary-light { background-color: #e9ecef !important; }
.text-secondary { color: #6c757d !important; }

/* 自定义样式 */
.project-card {
    border: 1px solid #e9ecef;
    background: white;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.project-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    text-decoration: none;
    color: inherit;
}

.project-card:hover .project-title {
    color: #4a6fa5 !important;
}

.project-card:hover .action-bar {
    background: linear-gradient(135deg, #f8faff 0%, #edf2ff 100%);
}

/* 图片容器 */
.image-container {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .image-container img {
    transform: scale(1.05);
}

/* 图片左上角来源标签 基础样式 */
.source-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    backdrop-filter: blur(4px);
    z-index: 10;
    border: 1px solid rgba(255,255,255,0.2);
}

/* 成员服 渐变 - 深海蓝（沉稳大气） */
.badge-member {
    background: linear-gradient(135deg, rgba(54, 162, 235, 0.95) 0%, rgba(32, 114, 184, 0.95) 100%);
}

/* MCJPG 渐变 - 蜂蜜黄（明亮活力）- Google风 */
.badge-mcjpg {
    background: linear-gradient(135deg, #FFD600 0%, #FFAB00 100%);
}

/* MSCPO 渐变 - 嫩芽绿（清新醒目）- Google风 */
.badge-mscpo {
    background: linear-gradient(135deg, #00C853 0%, #00A152 100%);
}

/* 其他平台 渐变 - 岩石灰（低调质感）- Google风 */
.badge-other {
    background: linear-gradient(135deg, #9E9E9E 0%, #757575 100%);
}

/* 图片右上角热度标签 */
.hotness-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    color: white;
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    backdrop-filter: blur(4px);
    z-index: 10;
    border: 1px solid rgba(255,255,255,0.2);
}

.hotness-high {
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.95) 0%, rgba(220, 53, 69, 0.95) 100%);
}

.hotness-medium {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.95) 0%, rgba(255, 149, 0, 0.95) 100%);
}

.hotness-low {
    background: linear-gradient(135deg, rgba(108, 117, 125, 0.95) 0%, rgba(73, 80, 87, 0.95) 100%);
}

/* 内容区域 */
.card-content {
    padding: 16px;
    flex-grow: 1;
}

.project-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 12px;
    line-height: 1.3;
    transition: color 0.2s;
    color: #2c3e50;
}

/* 标签容器 */
.tags-container {
    margin-bottom: 16px;
}

.tags-container .badge {
    font-size: 0.7rem;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s;
}

.tags-container .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

/* 项目描述 */
.project-description {
    font-size: 0.85rem;
    color: #6c757d;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0;
}

/* 操作栏 */
.action-bar {
    padding: 8px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 40px;
    background-color: inherit; /* 继承父元素背景色 */
}

/* 操作栏左侧 - 在线人数 */
.online-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.online-count {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.9);
    padding: 6px 12px;
    border-radius: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.05);
}

.online-count .icon {
    color: #28a745;
    font-size: 0.9rem;
}

.online-count .count {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.online-count .label {
    color: #6c757d;
    font-size: 0.8rem;
}

/* 服务器状态指示器 */
.status-indicator {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.75rem;
    color: #6c757d;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #28a745;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

/* 操作栏右侧 - 查看详情按钮 */
.view-details-btn {
    background: linear-gradient(135deg, #4a6fa5 0%, #3a5a8c 100%);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(74, 111, 165, 0.2);
    position: relative;
    overflow: hidden;
}

.view-details-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.view-details-btn:hover {
    transform: translateX(3px);
    box-shadow: 0 5px 15px rgba(74, 111, 165, 0.3);
}

.view-details-btn:hover::before {
    left: 100%;
}

.view-details-btn i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.view-details-btn:hover i {
    transform: translateX(3px);
}

/* 响应式调整 */
@media (max-width: 768px) {
    .action-bar {
        flex-direction: column;
        gap: 12px;
        align-items: stretch;
    }
    
    .online-info {
        justify-content: space-between;
    }
    
    .view-details-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ========== 关键修复3：强制清除可能的父容器间距继承 ========== */
.project-item {
    margin: 3 !important;
}
</style>
<script>
// 模拟在线人数更新
document.addEventListener('DOMContentLoaded', function() {
    // 为每个项目的在线人数添加随机变化（仅演示用）
    setInterval(function() {
        document.querySelectorAll('.online-count .count').forEach(function(element) {
            // 在现有数值附近随机变化
            let current = parseInt(element.textContent);
            if (current > 0) {
                let change = Math.floor(Math.random() * 11) - 5; // -5到+5
                let newValue = Math.max(1, current + change);
                element.textContent = newValue;
                
                // 添加动画效果
                element.style.transform = 'scale(1.1)';
                element.style.color = '#28a745';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                    element.style.color = '#2c3e50';
                }, 300);
            }
        });
    }, 8000); // 每8秒更新一次
});

// 处理卡片点击
document.querySelectorAll('.project-card').forEach(function(card) {
    card.addEventListener('click', function(e) {
        // 如果点击的是按钮，不触发卡片点击
        if (e.target.closest('.view-details-btn')) {
            return;
        }
        window.location.href = this.getAttribute('href');
    });
});
</script>


                            </div>
                        </div>
                    </div>
                </div>
                                      


<script>
fetch("/ads/request.php?type=6")
  .then(r => r.json())
  .then(d => {
    if (d.error === 1000) {
      const ad = d.ad;
      document.getElementById("cookieads").innerHTML = `
        <a href="${ad.aurl}" target="_blank" rel="nofollow">
          <img src="${ad.td}" alt="${ad.title}"
               style="width:100%;max-width:100%;border-radius:8px">
        </a>
      `;
    }
  });
</script> 
<section class="recruit-section">
    <div class="recruit-inner">

        <!-- 左侧视觉图 -->
        <div class="recruit-bg">
            <img src="girl1.png" alt="志愿者招募">
        </div>

        <!-- 右侧文案 + 按钮 -->
        <div class="recruit-text">
            <h1>MCMSF志愿者</h1>
            <p class="subtitle">为平台运营提供您的力量</p>

            <ul>
                <li>招募平台审核</li>
                <li>招募宣传委员</li>
                <li>招募 Web 开发</li>
            </ul>

            <!-- 按钮区 -->
            <div class="recruit-actions">
               
                <a class="btn btn-primary py-2 px-3 m-1" data-toggle="click-ripple"
                   href="javascript:;" id="Join">
                    <i class="nav-main-link-icon fa fa-rocket"></i> 加入我们
                </a>
            </div>
        </div>

    </div>
</section>
<style>
.recruit-section {
    width: 100%;
    padding: 28px 0;
}

.recruit-inner {
    max-width: 1200px;
    margin: 0 auto;

    display: flex;
    align-items: flex-start; /* 不再强制垂直居中 */
}

/* 左侧视觉：略收 */
.recruit-bg {
    flex: 0 0 320px;
}

.recruit-bg img {
    width: 100%;
    height: auto;
    display: block;
}

/* 右侧文字 */
.recruit-text {
    flex: 1;
    padding-left: 56px;
    padding-top: 12px; /* 轻微上移 */
}

/* 标题 */
.recruit-text h1 {
    font-size: 46px;
    font-weight: 800;
    margin-bottom: 14px;
}

/* 副标题 */
.recruit-text .subtitle {
    font-size: 19px;
    margin-bottom: 22px;
    color: #555;
}

/* 列表 */
.recruit-text ul {
    list-style: none;
    padding: 0;
    margin-bottom: 1px; /* 给按钮让位 */
}

.recruit-text li {
    font-size: 17px;
    line-height: 1.9;
}

/* 按钮区 */
.recruit-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}
@media (max-width: 768px) {

    .recruit-inner {
        padding: 0 16px;
    }

    .recruit-bg {
        flex: 0 0 140px;
    }

    .recruit-text {
        padding-left: 14px;
        padding-top: 4px;
    }

    .recruit-text h1 {
        font-size: 24px;
    }

    .recruit-text .subtitle {
        font-size: 14px;
        margin-bottom: 16px;
    }

    .recruit-text li {
        font-size: 14px;
    }
}
</style>

<style>
/* 深色模式覆盖：搜索框、卡片、页脚 */
.oneui-dark .oneui-search-input,
.oneui-dark .oneui-dropdown-btn,
.oneui-dark .oneui-search-btn {
    background-color: #0f1720 !important;
    border-color: #26313a !important;
    color: #e6eef8 !important;
}
.oneui-dark .oneui-search-input::placeholder { color: #9aa6b2 !important; }
.oneui-dark .oneui-dropdown-menu {
    background-color: #0b1220 !important;
    border-color: #22303a !important;
    color: #dbe8f8 !important;
}

.oneui-dark .project-card,
.oneui-dark .project-card .card-content {
    background-color: #071021 !important;
    border-color: #172631 !important;
    color: #e6eef8 !important;
}
.oneui-dark .project-card:hover {
    box-shadow: 0 8px 20px rgba(2,6,23,0.6) !important;
}
.oneui-dark .project-card .image-container {
    background-color: #071021 !important;
}
.oneui-dark .action-bar {
    background-color: #071721 !important;
    color: #dbe8f8 !important;
}

.oneui-dark footer.footer {
    background-color: #061018 !important;
    color: #cbd5e1 !important;
}
.oneui-dark footer.footer a,
.oneui-dark footer.footer .text-muted,
.oneui-dark footer.footer .fw-semibold {
    color: #cbd5e1 !important;
}
.oneui-dark footer.footer .border-top {
    border-color: rgba(255,255,255,0.04) !important;
}
</style>


                            </div>
                        </div>
                    </div>
                   <footer class="footer mt-auto" style="background-color: #F6F7F9;">
  <div class="container py-4 py-md-2">

    <!-- 主体信息 -->
    <div class="row gy-4">

      <!-- 品牌信息 -->
      <div class="col-12 col-md-4">
        <div class="text-muted fs-sm lh-lg">
          <div class="mb-1">
            © 2025 - <span data-toggle="year-copy"></span> 浆果服 版权所有 | 开源许可证发布
          </div>
          <a href="//<?php echo conf('Url') ?>" class="d-block mb-3" style="max-width: 250px;">
            <img src="logo.svg" alt="浆果服 Logo" style="width: 100%; height: auto; display: block;">
          </a>
          <a href="//beian.miit.gov.cn/" target="_blank" class="d-block text-decoration-none mb-1">
            <span class="badge bg-success">
              <i class="fa fa-location-arrow me-1"></i><?php echo conf('ICP') ?>
            </span>
          </a>
          <a href="//beian.miit.gov.cn/" target="_blank" class="d-block text-decoration-none">
            <span class="badge bg-primary">
              <i class="fa fa-location-arrow me-1"></i>公安网备申请中
            </span>
          </a>
        </div>
      </div>

      <!-- 快速链接 -->
      <div class="col-6 col-md-4">
        <div class="fw-semibold text-muted mb-2">快速链接</div>
        <ul class="list-unstyled fs-sm lh-lg mb-0">
          <li><a href="/docs" class="text-muted text-decoration-none">使用前文档（必读）</a></li>
          <li><a href="/feedback" class="text-muted text-decoration-none">问题反馈</a></li>
          <li><a href="/status" class="text-muted text-decoration-none">服务器状态</a></li>
          <li><a href="/links" class="text-muted text-decoration-none">友情链接</a></li>
          <li><a href="/about" class="text-muted text-decoration-none">关于我们</a></li>
        </ul>
      </div>

      <!-- 合作伙伴 -->
      <div class="col-6 col-md-4">
        <div class="fw-semibold text-muted mb-2">合作伙伴</div>
        <ul class="list-unstyled fs-sm lh-lg mb-0">
          <li><a href="https://mcserverwiki.com" target="_blank" class="text-muted text-decoration-none">McServerWiki</a></li>
          <li><a href="https://cookiebox.com" target="_blank" class="text-muted text-decoration-none">饼盒 Cookiebox</a></li>
          <li><a href="https://sodayo.com" target="_blank" class="text-muted text-decoration-none">北京速德优</a></li>
        </ul>
      </div>

    </div>

    <!-- 新增：技术支持与鸣谢 -->
    <div class="row mt-4 pt-4 border-top" style="border-color: rgba(0,0,0,0.1) !important;">
      <div class="col-12">
        <div class="fs-sm text-muted lh-lg text-center text-md-start">
          <p class="mb-2">
            部分图片鸣谢 
            <a href="https://minecraft-wallpaper.com" target="_blank" class="text-decoration-none fw-semibold">
              我的世界壁纸站
            </a>
            | MCAPI提供者: 
            <a href="https://uapi.dev" target="_blank" class="text-decoration-none fw-semibold">
              Uapi
            </a>
          </p>
          <p class="mb-2">
            由
            <a href="https://sdyst.com" target="_blank" class="text-decoration-none fw-semibold">
              速德优北京网络科技有限公司
            </a>
            提供运营支持
            | 本页面基于 
            <a href="https://getbootstrap.com" target="_blank" class="text-decoration-none fw-semibold">
              AGPL v3
            </a>
            开源
          </p>
          <p class="mb-0">
            <a href="/privacy" class="text-muted text-decoration-none me-3">隐私政策</a>
            <a href="/terms" class="text-muted text-decoration-none me-3">服务条款</a>
            <a href="/sitemap" class="text-muted text-decoration-none">网站地图</a>
          </p>
        </div>
      </div>
    </div>

    <!-- 统计 -->
    <div class="mt-4 text-start">
      <script id="LA-DATA-WIDGET"
        crossorigin="anonymous"
        charset="UTF-8"
        src="<?php echo conf_index('Statistics_Dm'); ?>">
      </script>
    </div>

  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 自动更新年份
    const yearElements = document.querySelectorAll('[data-toggle="year-copy"]');
    yearElements.forEach(element => {
        element.textContent = new Date().getFullYear();
    });
});
</script>
    </div>
    <!-- Load jQuery first (required by plugins) -->
    <script src="../assets/js/jquery.min.js"></script>
    <!-- Non-critical scripts deferred to avoid blocking render -->
    <script src="../assets/layer/layer.js" defer></script>
    <script src="../assets/js/oneui.app.min-5.6.js" defer></script>
    <script src="../assets/js/jump.js" defer></script>
    <script src="https://sdk.jinrishici.com/v2/browser/jinrishici.js" charset="utf-8" async></script>
    
    <?php if (conf('Index_Fang') == 1) {?>
    <script src="../assets/js/fang.js"></script>
    <?php }?>
    <!-- 1. 在页面底部添加毛玻璃通知容器 -->
<div id="notificationContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

<!-- 2. 添加毛玻璃通知的CSS样式 -->
<style>
/* 毛玻璃通知样式 - 精简版 */
.frosted-notification {
    width: 300px;
    max-width: 90vw;
    padding: 14px 18px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(15px) saturate(180%);
    -webkit-backdrop-filter: blur(15px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 
        0 6px 20px rgba(31, 38, 135, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    transform: translateX(120%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    margin-bottom: 10px;
    position: relative;
    overflow: hidden;
}

.frosted-notification.show {
    transform: translateX(0);
    opacity: 1;
}

/* 进度条 */
.notification-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg, #6275FE 0%, #D2DDF7 100%);
    width: 100%;
    transform-origin: left;
    animation: progress 7.5s linear forwards;
}

@keyframes progress {
    from { transform: scaleX(1); }
    to { transform: scaleX(0); }
}

/* 通知头部 */
.notification-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}

.notification-title {
    font-weight: 600;
    font-size: 15px;
    color: #2d3748;
    display: flex;
    align-items: center;
    gap: 8px;
}

.icon-success {
    background: none;      /* 无背景 */
    color: inherit;        /* 继承父元素颜色（让🎉显示原色） */
    width: auto;           /* 自动宽度 */
    height: auto;          /* 自动高度 */
    display: inline-block; /* 行内显示 */
    font-size: 18px;       /* 稍大一点 */
    border-radius: 0;      /* 无圆角 */
}

/* 关闭按钮 */
.notification-close {
    background: none;
    border: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #a0aec0;
    font-size: 16px;
    transition: all 0.2s;
    background: rgba(160, 174, 192, 0.1);
    padding: 0;
    line-height: 1;
}

.notification-close:hover {
    background: rgba(160, 174, 192, 0.2);
    color: #718096;
}

/* 通知内容 */
.notification-content {
    font-size: 13px;
    line-height: 1.5;
    color: #4a5568;
}

/* 手机适配 */
@media (max-width: 640px) {
    #notificationContainer {
        top: 10px;
        right: 10px;
    }
    
    .frosted-notification {
        width: 260px;
        padding: 12px 16px;
    }
}
</style>

<!-- 3. 修改原来的弹窗调用 -->
<script>
// 页面加载完成后显示通知
document.addEventListener('DOMContentLoaded', function() {
    <?php if(conf_index('Index_Tc')): ?>
    showNotification(
        'success', 
        '页面初始化完成', 
        '<?php echo addslashes(conf_index('Index_Tc')); ?>'
    );
    <?php endif; ?>
});

// 显示通知函数
function showNotification(type, title, message) {
    const container = document.getElementById('notificationContainer');
    const notification = document.createElement('div');
    notification.className = 'frosted-notification';
    
    // 图标映射
    const iconMap = {
        success: '🎉',
        info: 'ℹ',
        warning: '⚠',
        error: '✗'
    };
    
    notification.innerHTML = `
        <div class="notification-progress"></div>
        <div class="notification-header">
            <div class="notification-title">
                <span class="icon-${type}">${iconMap[type] || 'ℹ'}</span>
                ${title}
            </div>
            <button class="notification-close" onclick="closeNotification(this)">×</button>
        </div>
        <div class="notification-content">${message}</div>
    `;
    
    container.appendChild(notification);
    
    // 显示动画
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // 5秒后自动关闭
    setTimeout(() => {
        closeNotification(notification.querySelector('.notification-close'));
    }, 7500);
}

// 关闭通知
function closeNotification(closeBtn) {
    const notification = closeBtn.closest('.frosted-notification');
    if (!notification) return;
    
    notification.classList.remove('show');
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 400);
}
</script>
    <script>
        fetch('https://v1.hitokoto.cn')
            .then(response => response.json())
            .then(data => {
                const text = document.getElementById('hitokoto_text')
                text.innerText = data.hitokoto
                const from = document.getElementById('hitokoto_from')
                var author = !!data.from ? data.from : "无名氏";
                from.innerText = "—— " + (data.from_who || '') + "「" + author + "」"
            })
            .catch(console.error)
    </script>
    <script>
function showDoc(type) {
    const docs = {
        'getting-started': {
            title: '新手指南',
            content: '<h5>欢迎来到MCMSF平台！</h5><p><strong>如何使用平台：</strong></p><ol><li>浏览首页，查看推荐的服务器</li><li>使用筛选器按类型、版本查找服务器</li><li>点击服务器卡片查看详细信息</li><li>使用AI助手获取智能推荐</li></ol><p><strong>功能说明：</strong></p><ul><li>视频专区：查看服务器宣传视频</li><li>编辑推荐：查看精选优质服务器</li><li>讨论区：与玩家交流心得</li><li>AI助手：智能问答和推荐</li></ul>'
        },
        'server-application': {
            title: '服务器申请指南',
            content: '<h5>如何申请服务器？</h5><p><strong>申请步骤：</strong></p><ol><li>点击首页的"加入我们"按钮</li><li>填写成员信息：姓名、QQ、简介</li><li>完成人机验证</li><li>提交申请等待审核</li></ol><p><strong>注意事项：</strong></p><ul><li>确保信息真实有效</li><li>提供准确的联系方式</li><li>等待管理员审核，一般1-3个工作日</li></ul>'
        },
        'security': {
            title: '安全须知',
            content: '<h5>账号安全</h5><p><strong>重要提示：</strong></p><ul><li>不要在公共场合泄露个人信息</li><li>使用强密码，定期更换</li><li>不要相信任何要求提供密码的信息</li><li>遇到可疑行为及时联系管理员</li></ul><p><strong>平台安全措施：</strong></p><ul><li>人机验证保护</li><li>数据加密传输</li><li>定期安全检查</li></ul>'
        },
        'faq': {
            title: '常见问题',
            content: '<h5>FAQ</h5><p><strong>Q: 如何查找服务器？</strong><br>A: 使用首页的筛选器，可以按类型、版本筛选，也可以使用搜索框输入关键词。</p><p><strong>Q: 如何申请服务器？</strong><br>A: 点击首页"加入我们"按钮，填写相关信息提交申请即可。</p><p><strong>Q: 如何联系管理员？</strong><br>A: 可以通过留言功能、QQ等方式联系，具体联系方式见"联系我们"文档。</p><p><strong>Q: AI助手能做什么？</strong><br>A: AI助手可以推荐服务器、解答问题、提供使用帮助等。</p>'
        },
        'contact': {
            title: '联系我们',
            content: '<h5>联系方式</h5><p><strong>多种方式联系我们：</strong></p><ul><li>QQ：查看管理员QQ信息</li><li>邮箱：通过留言功能发送邮件</li><li>平台留言：使用网站留言功能</li></ul><p><strong>服务时间：</strong></p><p>周一至周日 9:00 - 22:00</p><p><strong>反馈建议：</strong></p><p>欢迎提出宝贵意见和建议，帮助我们改进平台！</p>'
        }
    };
    
    const doc = docs[type] || {title: '文档', content: '内容加载中...'};
    
    // 获取屏幕宽度
    const screenWidth = window.innerWidth;
    
    // 根据屏幕宽度设置不同大小
    let areaSize = ['600px', '500px']; // 默认桌面端
    let maxHeight = '450px';
    let className = '';
    
    if (screenWidth <= 768) {
        // 平板和手机
        areaSize = ['90%', '70%'];
        maxHeight = '65vh';
        className = 'mobile-doc-modal';
        
        // 添加移动端样式
        if (!document.querySelector('#mobileDocModalStyles')) {
            const style = document.createElement('style');
            style.id = 'mobileDocModalStyles';
            style.innerHTML = `
                .mobile-doc-modal .layui-layer-content {
                    padding: 15px !important;
                }
                .mobile-doc-modal h5 {
                    font-size: 1.1rem !important;
                    margin-bottom: 12px !important;
                }
                .mobile-doc-modal p {
                    font-size: 0.95rem !important;
                    margin-bottom: 10px !important;
                    line-height: 1.5 !important;
                }
                .mobile-doc-modal ol, .mobile-doc-modal ul {
                    padding-left: 20px !important;
                    margin-bottom: 12px !important;
                }
                .mobile-doc-modal li {
                    font-size: 0.9rem !important;
                    margin-bottom: 8px !important;
                    line-height: 1.4 !important;
                }
                .mobile-doc-modal strong {
                    font-weight: 600 !important;
                    display: block !important;
                    margin-bottom: 5px !important;
                }
                .mobile-doc-modal br {
                    display: block !important;
                    margin: 5px 0 !important;
                    content: "" !important;
                }
                .mobile-doc-modal .layui-layer-title {
                    font-size: 1.2rem !important;
                    padding: 15px !important;
                    height: auto !important;
                    line-height: 1.4 !important;
                }
                .mobile-doc-modal .layui-layer-btn {
                    padding: 12px 15px !important;
                }
                .mobile-doc-modal .layui-layer-btn a {
                    min-height: 44px !important;
                    min-width: 44px !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    font-size: 1rem !important;
                }
            `;
            document.head.appendChild(style);
        }
    } else if (screenWidth <= 1024) {
        // 平板
        areaSize = ['75%', '65%'];
        maxHeight = '60vh';
    }
    
    layer.open({
        type: 1,
        title: doc.title,
        area: areaSize,
        content: '<div class="p-3 p-md-4" style="max-height: ' + maxHeight + '; overflow-y: auto; font-size: inherit;">' + doc.content + '</div>',
        skin: 'layui-layer-mobile' + (screenWidth <= 768 ? ' layui-layer-mobile-responsive' : ''),
        className: className,
        shade: 0.5,
        shadeClose: true,
        scrollbar: false,
        success: function(layero) {
            // 确保模态框在视口内
            layero.css({
                'top': '50%',
                'transform': 'translateY(-50%)',
                'max-height': '90vh'
            });
            
            // 调整关闭按钮大小（移动端）
            if (screenWidth <= 768) {
                const closeBtn = layero.find('.layui-layer-close');
                if (closeBtn.length) {
                    closeBtn.css({
                        'width': '44px',
                        'height': '44px',
                        'font-size': '1.2rem'
                    });
                }
            }
        }
    });
}
        $(document).ready(function() {
            $("#Query").click(function() {
                layer.open({
                    type: 2,
                    title: '成员查询',
                    shadeClose: true,
                    scrollbar: false,
                    shade: false,
                    area: ['315px', '358px'],
                    content: '/indexs.php?my=Query'
                });
            });
            $("#Join").click(function() {
                layer.open({
                    type: 2,
                    title: '申请加入',
                    shadeClose: true,
                    scrollbar: false,
                    shade: false,
                    maxmin: true,
                    area: ['315px', '538px'],
                    content: '/indexs.php?my=Join'
                });
            })
        });
    </script>
</body>
</html>