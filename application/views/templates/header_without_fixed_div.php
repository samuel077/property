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

<script type="text/javascript">
function change_password(url){
        var origin_pw=document.getElementById('cpm_origin_pw').value;
        var new_pw=document.getElementById('cpm_new_pw').value;
        var new_pw_con=document.getElementById('cpm_new_pw_con').value;

        if(new_pw == new_pw_con)
        {
                xmlhttp=null;
                if(window.XMLHttpRequest){
                        xmlhttp= new XMLHttpRequest();
                }
                else if(window.ActiveXObject){
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                if(xmlhttp != null)
                {
                    xmlhttp.onreadystatechange=state_Change;
                    xmlhttp.open("POST",url,true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("origin="+origin_pw+"&new_pw="+new_pw);
                }else{
                // xmlhttp = null
                alert("Your browser does not support XMLHTTP.");
                }
        }else{
                alert("新密碼輸入不相同，請重新確認輸入");
                document.getElementById('cpm_new_pw').value="";
                document.getElementById('cpm_new_pw_con').value="";
        }
}

function state_Change()
{
if (xmlhttp.readyState==4)
  {// 4 = "loaded"
  if (xmlhttp.status==200)
    {// 200 = "OK"
        if(xmlhttp.responseText == "success"){
                alert("密碼已重置");
        }
        else if(xmlhttp.responseText == "fail_1"){
                alert("密碼重置失敗，請聯絡管理員");
                reset_password_modal();
        }else if(xmlhttp.responseText == "fail_2"){
                alert("密碼重置失敗，原始密碼不符合");
                reset_password_modal();
        }
    }
  else
    {
    alert("Problem retrieving data:" + xmlhttp.statusText);
    }
  }
}

function reset_password_modal(){
        document.getElementById('cpm_origin_pw').value="";
        document.getElementById('cpm_new_pw').value="";
        document.getElementById('cpm_new_pw_con').value="";
}
</script>


</head>
<body>
<!-- 更改密碼 modal -->
<div class="modal fade" id="changePasswordModal" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" action="<?=base_url("/user/change_password")?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-refresh"></span> &nbsp; <b>變更密碼</b></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">原始密碼：</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="cpm_origin_pw" name="origin_pw" placeholder="請輸入原始密碼" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">設定新密碼：</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="cpm_new_pw" name="new_pw" placeholder="設定新密碼" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">設定新密碼：</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="cpm_new_pw_con" name="new_pw_con" placeholder="確認新密碼" />
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="change_password('<?=base_url("/user/change_password")?>');">更改密碼</button>
      </div>
      </form>
    </div>
  </div>
</div>

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
                <li><a href="<?=base_url("/property/location")?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;依地區列出財產</a></li>
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
	    <?php if(isset($_SESSION['username'])) : ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'];?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" style="width:50px;">
                <li><a href="<?=base_url("/user/setting")?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;設定</a></li>
                <li><a href="#" data-target="#changePasswordModal" data-toggle="modal" ><span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;變更密碼</a></li>
                <li><a href="<?=base_url("/user/logout")?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;登出</a></li>
              </ul>
          </li>
          <? endif; ?>
		<!--
		<?php if(isset($_SESSION['username'])) : ?>
	  		<li> <a href="#"><?php echo $user_name;?></a></li>
		<?php endif; ?>
		-->
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </div>

  <!-- fixed size container -->
  <div style="height:auto; width:auto;">
	<?php if( !empty($pageHeaderBig)) : ?>
	<!-- we need a form here.-->
        <div class="page-header"> <h1 style="align:center; font-family:Microsoft JhengHei; margin-left:180;"><b><?php echo $pageHeaderBig;?></b><small><b><?php echo $pageHeaderSmall;?></b></small></h1></div>
	<?php endif; ?>

