
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $title?></title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?=base_url("/public/css/navbar.css")?>">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
/* Custom Styles */
ul.nav-tabs {
	width: 140px;
	margin-top: 20px;
	border-radius: 4px;
	border: 1px solid #ddd;
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
}
ul.nav-tabs li {
	margin: 0;
	border-top: 1px solid #ddd;
}
ul.nav-tabs li:first-child {
	border-top: none;
}
ul.nav-tabs li a {
	margin: 0;
	padding: 8px 16px;
	border-radius: 0;
}
ul.nav-tabs li.active a, ul.nav-tabs li.active a:hover {
	color: #fff;
	background: #0088cc;
	border: 1px solid #0088cc;
}
ul.nav-tabs li:first-child a {
	border-radius: 4px 4px 0 0;
}
ul.nav-tabs li:last-child a {
	border-radius: 0 0 4px 4px;
}
ul.nav-tabs.affix {
	top: 30px; /* Set the top position of pinned element */
}
</style>
</head>
<body data-spy="scroll" data-target="#myScrollspy">
<?php 

	//echo "<pre>";
	//print_r($ptList);
	//echo "</pre>";

?>
<div class="container">
<div class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url("/property/")?>">HSNG(ANT)</a>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">實驗室財產<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url("/property/")?>"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;財產列表(>借用)</a></li>
                <!--
                <li class="divider"></li>
                <li><a href="#">年度可報廢財產</a></li>
                -->
              </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">使用者<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php if(isset($is_admin)) : ?>
                        <?php if($is_admin) : ?>
                                <li><a href="<?=base_url("/user/list_user")?>"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;會員列表</a></li>
                        <?php else : ?>
                                <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;個人資料(待討論)</a></li>
                                <li><a href="<?=base_url("/property/personal_pro")?>"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;財產借用列表</a></li>
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
                <li><a href="<?=base_url("/property/location")?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;依>地區列出財產</a></li>
                <li><a href="<?=base_url("/property/dumplist")?>"><span class="glyphicon glyphicon-remove-sign" style="color:red;"></span>&nbsp;&nbsp;可報廢財產列表</a></li>
                <li><a href="<?=base_url("/property/countedlist")?>"><span class="glyphicon glyphicon-barcode"></span>&nbsp;&nbsp;年度清點財產結果</a></li>
                <li class="divider"></li>
                <!-- <li><a href="#">危險財產清單</a></li>-->
                <li><a href="<?=base_url("/user/signup")?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;新建使用者</a></li>
                <li><a href="<?=base_url("/user/checkuser")?>"><span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;審核使用者頁面</a></li>
				<li><a href="<?=base_url("/property/application")?>"><span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;審核財產借用頁面</a></li>
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

    <!--<div class="jumbotron">
        <h1>Bootstrap ScrollSpy</h1>
    </div>-->
<!-- fixed size container -->
  <div style="height:auto; width:auto;">
        <?php if( !empty($pageHeaderBig)) : ?>
        <!-- we need a form here.-->
        <div class="page-header" style="margin-left:180px;"> <h1 style="align:center; font-family:Microsoft JhengHei; margin-left:300;"><b><?php echo $pageHeaderBig;?></b><small><b><?php echo $pageHeaderSmall;?></b></small></h1></div>
        <?php endif; ?>