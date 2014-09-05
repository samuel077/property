<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title?></title>
	<link rel="stylesheet" href="<?=base_url("/public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/public/css/navbar.css")?>">
	<!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
	<script src="<?=base_url("/public/js/jquery-1.11.1.min.js")?>"></script>
	<script src="<?=base_url("/public/js/bootstrap.js")?>"></script>
<!--	<link rel="stylesheet" href="<?=base_url("/public/css/bootstrap-responsive.min.css")?>"> -->
</head>
<body>
<div class="container">
<div class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url("/property/")?>">HSNG(ANT)</a>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">實驗室財產<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url("/property/")?>"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;財產列表(借用)</a></li>
              </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">使用者<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
		<?php if(isset($is_admin)) : ?>
			<?php if($is_admin) : ?>
                		<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;會員列表</a></li>
			<?php else : ?>
                		<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;個人資料(待討論)</a></li>
                		<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;財產借用列表</a></li>
			<?php endif; ?>
		<?php endif; ?>
              </ul>
          </li>
	  <?php if(isset($is_admin)) : ?>
	  	<?php if($is_admin) : ?>
	  <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理者專區<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url("/property/create")?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;財產單筆新建</a></li>
                <li><a href="<?=base_url("/property/import")?>"><span class="glyphicon glyphicon-import"></span>&nbsp;&nbsp;財產匯入</a></li>
                <li><a href="<?=base_url("/property/location")?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;依地區列出財產</a></li>
                <li><a href="<?=base_url("/property/dumplist")?>"><span class="glyphicon glyphicon-remove-sign" style="color:red;"></span>&nbsp;&nbsp;可報廢財產列表</a></li>
                <li><a href="<?=base_url("/property/countedlist")?>"><span class="glyphicon glyphicon-barcode"></span>&nbsp;&nbsp;年度清點財產結果</a></li>
		<li class="divider"></li>
                <!-- <li><a href="#">危險財產清單</a></li>-->
                <li><a href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;新建使用者</a></li>
                <li><a href="<?=base_url("/user/checkuser")?>"><span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;審核使用者頁面</a></li>
              </ul>
          </li>
	  	<? endif; ?>
	  <? endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
		<?php if(isset($user_name)) : ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_name;?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" style="width:50px;">
                <li><a href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;設定</a></li>
                <li><a href="<?=base_url("/user/logout")?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;登出</a></li>
              </ul>
          </li>
          <? endif; ?>
		<!--
		<?php if(isset($user_name)) : ?>
	  		<li> <a href="#"><?php echo $user_name;?></a></li>
		<?php endif; ?>
		-->
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </div>

  <!-- fixed size container -->
  <div style="height:700px; width:auto;">
	<?php if( !empty($pageHeaderBig)) : ?>
	<!-- we need a form here.-->
        <div class="page-header"> <h1 style="align:center; font-family:Microsoft JhengHei; margin-left:180;"><b><?php echo $pageHeaderBig;?></b><small><b><?php echo $pageHeaderSmall;?></b></small></h1></div>
	<?php endif; ?>

