	<!-- we need a form here.-->
	<!-- <div class="page-header"> <h1 style="align:center; font-family:Microsoft JhengHei; margin-left:180;"><b>新建財產</b><small><b>手動輸入</b></small></h1></div> -->
	<div style="margin-top:30px;">
	<form class="form-horizontal" action="<?=base_url("/user/setting")?>" method="post">

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者帳號</label>
            <div class = "col-sm-5">
            <input name = "account" type = "text" class = "form-control" placeholder = "請輸入使用者帳號" value="<?php echo $user['account'];?>" disabled/> 
            </div>
        </div>

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者姓名</label>
            <div class = "col-sm-5">
            <input name = "name" type = "text" class = "form-control" placeholder = "請輸入使用者姓名" value="<?php echo $user['name'];?>"/>
            </div>
        </div>

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者學號</label>
            <div class = "col-sm-5">
                <input name = "school_id" type = "text" class = "form-control" placeholder = "請輸入使用者學號" value="<?php echo $user['school_id'];?>"/>
            </div>
        </div>

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者手機</label>
            <div class = "col-sm-5">
                <input name = "phone_number" type = "text" class = "form-control" placeholder = "請輸入使用者手機" value="<?php echo $user['phone_number'];?>"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-sm-3 control-label">使用者E-mail</label>
            <div class = "col-sm-5">
                <input name = "email" type = "text" class = "form-control" placeholder = "請輸入使用者E-mail" value="<?php echo $user['email'];?>"/>
            </div>
        </div>

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者入學年</label>
            <div class = "col-sm-5">
                <input name = "enroll_year" type = "text" class = "form-control" placeholder = "請輸入使用者入學年" value="<?php echo $user['enroll_year'];?>"/>
            </div>
        </div>

	<div class = "form-group">
            <label class = "col-sm-3 control-label">使用者身份</label>
            <div class = "col-sm-5">
                <select class = "form-control" name = "identity_type">
                    <option value ="1" <?php if($user['identity_type'] == 1) echo "selected";?>>
                        大學部
                    </option>
                    <option value ="2" <?php if($user['identity_type'] == 2) echo "selected";?>>
                        研究所
                    </option>
                    <option value ="3" <?php if($user['identity_type'] == 3) echo "selected";?>>
                        博士班
                    </option>
                </select>
            </div>
        </div>
	
	<br/>
	<input type="submit" class="btn btn-primary" style="margin-left:180;" value="送出修改"/>
	</form>
</div>
