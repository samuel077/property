<div class="container">
	<div class="row" 
	style="
        width:850px; height:550px;
        position:absolute;z-index:1;
        margin-left:10%; margin-top:10%; font-family:Microsoft JhengHei;">
		<div id="div1" class="col-md-6" style="color:white; width:500px; height:630px;">

		<h1><b>HSNG 財產管理系統</b></h1>
		<br>
		<h4>
			<p>確實登錄實驗室財產資訊，可以讓每年度的盤點更輕鬆唷</p>
			<p>山妙副總好有錢~大家快跟他要$___$</p>
		</h4> 
		</div>
		<div id="div2" class="col-md-6" style="width:330px; height:630px;">
			<div class="row" style="background-color:white; border-radius:5px; height:145px; ">
				<div style="margin-left:16px; margin-top:5%;">
					<h4><b>Login</b></h4>
				</div>
                <form method = "post" action = "user/login">
				<input  type="text" class="form-control"  name="login_account" style="width:300px; margin-left:15px; margin-top:15px;" placeholder="Please type User ID" />
				<table  style=" margin:auto; margin-top: 10px;" >
					<tr>
						<td><input type="password" id=" "  class="form-control" name="login_passwd" style="height:35px;width:225px;" placeholder="password" /></td>
						<td><button type="submit" class="btn btn-primary" style="width: 65px; margin-left: 10px;"><b>登入</b></button></td>
                        </form>
					</tr>
				</table>
			</div>
			<div class="row" style="height:230px; background-color:white; 
						margin-top:5%; border-radius:5px;">
				<div style="margin-left:16px; margin-top:5%;">
					<h4><b>First time here?</b></h4>
				</div>
				<form method="post" action="user/signup">
					<input type="text" class="form-control" name="signup_account" placeholder="Please type Account"
					style="width:300px; margin-left:15px; margin-top:15px;"/>
					<input type="password" class="form-control" name="signup_passwd" placeholder="Please type Password" 
					style="width:300px; margin-left:15px; margin-top:10px;"/>
					<input type="text" class="form-control" name="signup_name" placeholder="Please type Chinese Name" 
					style="width:300px; margin-left:15px; margin-top:10px;"/>
					<button type="submit" class="btn btn-success" style="width: 65px; margin-left:245px; margin-top:10px;"><b>註冊</b></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="position:relative;z-index:0;">
  <!-- Indicators -->
  <!--
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" style="height:100%;">
    <div class="item">
      <img src="http://140.123.105.16/~tutu/property/public/image/oncall.JPG" >
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="http://140.123.105.16/~tutu/property/public/image/bird.JPG" >
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="http://140.123.105.16/~tutu/property/public/image/samuel.JPG">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item active">
      <img src="http://140.123.105.16/~tutu/property/public/image/table.JPG">
      <div class="carousel-caption">       
      </div>
    </div>
	<div class="item">
      <img src="http://140.123.105.16/~tutu/property/public/image/night.JPG">
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
<!--  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>-->
</div>


