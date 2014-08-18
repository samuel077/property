<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?> - CodeIgniter 2 Tutorial</title>
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
    <a class="navbar-brand" href="./index.php">HSNG(ANT)</a>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">實驗室財產<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">財產列表(借用)</a></li>
		<li class="divider"></li>
                <li><a href="#">年度可報廢財產</a></li>
              </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">使用者<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">個人資料</a></li>
		<li class="divider"></li>
                <li><a href="#">財產借用列表</a></li>
              </ul>
          </li>
	  <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理者專區<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">使用者匯入/匯出</a></li>
		<li class="divider"></li>
                <li><a href="#">財產匯入/匯出</a></li>
		<li class="divider"></li>
                <li><a href="#">危險財產清單</a></li>
              </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
	  <li> <a href="#">註冊</a></li>
	  <li> <a href="#">登入/登出</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </div>

