<?php
include("./Common/Core_brain.php");

$id=$_GET['id'];

$sql = "SELECT * FROM nteam_project_list WHERE id='$id' LIMIT 1";
$rows=$DB->getRow($sql);
if(!$rows){exit("该项目不存在！");}
$projects=$DB->query($sql);
while($project = $projects->fetch()){
?>
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php echo $project['name'];?> - <?php echo conf('Name') ?> - <?php echo conf('SiteName') ?></title>
  <meta name="keywords" content="<?php echo conf('Keywords');?>">
  <meta name="description" content="<?php echo conf('Descriptison');?>">
  <link rel="shortcut icon" href="../assets/media/various/favicon.png">
  <link rel="stylesheet" href="../assets/css/magnific-popup.css">
  <link rel="stylesheet" id="css-main" href="../assets/css/oneui.min-5.6.css">
  <script src="../assets/js/darkmode.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9HQDQJJYW7"></script>
  <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'G-9HQDQJJYW7');</script>
  <?php if(!empty($project['img'])){
    $pi = parse_url($project['img']);
    if($pi && isset($pi['scheme']) && isset($pi['host'])){
        echo '<link rel="preconnect" href="'.$pi['scheme'].'://'.$pi['host'].'" crossorigin>';
    }
    echo '<link rel="preload" as="image" href="'.$project['img'].'" fetchpriority="high">';
    echo "<script>try{(new Image()).src='".$project['img']."';}catch(e){};</script>";
  } ?>
</head>
<body>
  <header id="page-header">
  <div class="content-header">
    <div class="d-flex align-items-center">
      <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" onclick="javascript:history.back(-1);">
        <i class="fa fa-fw fa-sign-out-alt"></i> 返回
      </button>
      <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" onclick="javascript:history.back(-1);">
        <i class="fa fa-fw fa-sign-out-alt"></i> 返回
      </button>
      <!-- 深色模式切换按钮 -->
      <button type="button" class="btn btn-sm btn-alt-secondary me-2" data-action="dark_mode_toggle" id="dark-mode-toggle" title="切换深色/浅色模式">
        <i class="far fa-moon"></i>
      </button>
    </div>
    <div class="d-flex align-items-center">
      <div class="dropdown d-inline-block ms-2">
        <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-bell"></i>
          <span class="text-primary">•</span>
          服务器信息
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">
          <div class="p-2 bg-body-light border-bottom text-center rounded-top">
            <h5 class="dropdown-header text-uppercase">服务器信息</h5>
          </div>
          <ul class="nav-items mb-0">
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器类型：<?php if ($project['type'] == 'web') {echo "网页";}else{echo "程序";}?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器名称：<?php echo $project['name'];?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器类型/标签：<?php echo $project['money'];?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器版本：<?php echo $project['version'];?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">添加MCMSF时间：<?php echo $project['intime'];?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="//<?php echo $project['url'];?>" target="_blank">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器bilibili BV号：<?php echo $project['url'];?></div>
                </div>
              </a>
            </li>
            <li>
              <a class="text-dark d-flex py-2" href="javascript:void(0)">
                <div class="flex-shrink-0 me-2 ms-3">
                  <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="flex-grow-1 pe-2">
                  <div class="fw-semibold">服务器报告运营状态：<?php if ($project['status'] == 1) {  echo "<font color='green'>正常运营</font>";}else{  echo "<<font color='red'>暂停运营</font>";} ?></div>
                </div>
              </a>
            </li>
          </ul>
          <div class="p-2 border-top text-center">
            <a class="d-inline-block fw-medium" href="javascript:void(0)">
              <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="page-header-search" class="overlay-header bg-body-extra-light">
    <div class="content-header">
      <form class="w-100" action="be_pages_generic_search.html" method="POST">
        <div class="input-group">
          <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
            <i class="fa fa-fw fa-times-circle"></i>
          </button>
          <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
        </div>
      </form>
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
<div class="bg-image" style="background-image: url('<?php echo $project['img'];?>');">
  <div class="bg-primary-dark-op">
    <div class="content content-full text-center pt-9 pb-8">
      <h1 class="text-white mb-2">
        <?php echo $project['name'];?>
      </h1>
      <h2 class="h4 fw-normal text-white-75 mb-0">
        <?php echo $project['sketch'];?>
      </h2>
    </div>
  </div>
</div>
<div class="bg-body-extra-light">
  <div class="content content-boxed">
    <div class="text-center fs-sm push">
      <span class="d-inline-block py-2 px-4 bg-body fw-medium rounded">
        <strong> &bull; <?php echo $project['intime'];?> &bull; </strong>
      </span>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-8">
        <article class="story">
          <h3 class="fw-normal mt-5 mb-3  text-center">服务器介绍</h3>
          <p><?php echo $project['descriptison'];?></p>
          <?php if (!empty($project['url'])) { ?>
<h3 class="fw-normal mt-5 mb-3 text-center">服务器宣传视频</h3>

<div class="block block-rounded block-bordered shadow-sm mb-4">
  <div class="block-content p-0">
    <div class="ratio ratio-16x9">
      <iframe
        src="https://player.bilibili.com/player.html?bvid=<?php echo $project['url']; ?>&page=1&high_quality=1&danmaku=0"
        scrolling="no"
        border="0"
        frameborder="no"
        framespacing="0"
        allowfullscreen="true">
      </iframe>
    </div>
  </div>
</div>
<?php } ?>
          <h3 class="fw-normal mt-5 mb-3 text-center">图片预览</h3>
          <div class="row g-sm items-push js-gallery push img-fluid-100">
            <div class="col-12 animated fadeIn">
              <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $project['img'];?>">
                <img class="img-fluid" src="<?php echo $project['img'];?>" alt="<?php echo $project['name'];?>">
              </a>
            </div>
            <div class="col-6 animated fadeIn">
              <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $project['img2'];?>">
                <img class="img-fluid" src="<?php echo $project['img2'];?>" alt="<?php echo $project['name'];?>">
              </a>
            </div>
            <div class="col-6 animated fadeIn">
              <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $project['img3'];?>">
                <img class="img-fluid" src="<?php echo $project['img3'];?>" alt="<?php echo $project['name'];?>">
              </a>
            </div>
          </div>
<?php if (!empty($project['paycontact'])) { ?>
<div class="text-center mt-5">
    <?php 
        // 对服务器名称进行编码，防止中文在 URL 中导致失效
        $encodedName = urlencode($project['name']); 
        // 拼接你服务器的 API 地址（假设你的域名是 api.yourdomain.com，请替换为实际地址）
        $bannerUrl = "https://api.mcmsf.com/banner/" . $project['paycontact'] . "/" . $encodedName;
    ?>
    <img loading="lazy" 
         src="<?php echo $bannerUrl; ?>" 
         alt="<?php echo $project['name']; ?>" 
         class="img-fluid" 
         style="max-width: 600px; width: 100%; height: auto;" />
</div>
<?php } ?>
        </article>
        <div class="mt-5 d-flex justify-content-between push">
          <a class="btn btn-alt-primary" href="//<?php echo $project['url'];?>" target="_blank">
            <i class="fa fa-heart me-1"></i> 体验服务器
          </a>
          <div class="btn-group" role="group">
            <a href="//cdn.oss.uaovo.com/qq.php?qq=<?php echo $project['paycontact'];?>" class="btn btn-alt-secondary">
              <i class="fa fa-thumbs-up"></i> 点赞服务器
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content content-boxed">
  <div class="row py-5">
      <?php
      $projects=$DB->query("SELECT * FROM nteam_project_list WHERE status=1 and is_show=1 and Audit_status=1 ORDER BY id");
      while($project = $projects->fetch()){
      ?>
    <div class="col-md-4">
      <a class="block block-rounded block-link-pop overflow-hidden" href="works.php?id=<?php echo $project['id'];?>">
        <div class="bg-image" style="background-image: url('<?php echo $project['img'];?>');">
          <div class="block-content bg-primary-dark-op">
            <h4 class="text-white mt-5 push"><?php echo $project['name'];?></h4>
          </div>
        </div>
        <div class="block-content block-content-full fs-sm fw-medium">
          <strong><span class="text-primary"><?php echo $project['paysketch'];?></span> · <?php echo $project['intime'];?> · <span><?php echo $project['money'];?></span></strong>
        </div>
      </a>
    </div>
    <?php
    }
    ?>
  </div>
</div>
  </main>
  <footer id="page-footer" class="bg-body-light">
  <div class="content py-3">
    <div class="row fs-sm">
      <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
        <a class="fw-semibold" href="//beian.mitt.gov.cn/" target="_blank"><?php echo conf('ICP') ?></a>
      </div>
      <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
        &copy; 2023 <a class="fw-semibold" href="//<?php echo conf('Url') ?>"><?php echo conf('Name') ?></a>
      </div>
    </div>
  </div>
</footer>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.magnific-popup.min.js"></script>
<script src="../assets/js/oneui.app.min-5.6.js"></script>
<script>One.helpersOnLoad(['jq-magnific-popup']);</script>
<?php if (conf('Index_Fang') == 1) {?>
<script src="../assets/js/fang.js"></script>
<?php }?>
</body>
</html>
<?php
}
?>