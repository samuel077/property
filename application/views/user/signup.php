<?php
    echo validation_errors();
    
    $attributes = array('class' => 'form-horizontal col-sm-offset-2' , 'role' => 'form');
    echo form_open('./user/signup' , $attributes); 
?> 
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者帳號</label>
            <div class = "col-sm-4">
            <input name = "account" type = "text" class = "form-control" placeholder = "請輸入使用者帳號" value ="<?php 
                if(!$is_admin)
                {
                    echo set_value('account',$account);
                } ?>" />
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者密碼</label>
            <div class = "col-sm-4">
            <input name = "passwd" type = "password" class = "form-control" placeholder = "請輸入使用者密碼" value ="<?php 
                if(!$is_admin)
                {
                    echo set_value('password',$passwd);
                }?>"/>
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者姓名</label>
            <div class = "col-sm-4">
            <input name = "name" type = "text" class = "form-control" placeholder = "請輸入使用者姓名" value="<?php 
                if(!$is_admin)
                {
                    echo set_value('name',$name); 
                }?>"/>
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者學號</label>
            <div class = "col-sm-4">
                <input name = "school_id" type = "text" class = "form-control" placeholder = "請輸入使用者學號" />
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者手機</label>
            <div class = "col-sm-4">
                <input name = "phone_number" type = "text" class = "form-control" placeholder = "請輸入使用者手機" />
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者E-mail</label>
            <div class = "col-sm-4">
                <input name = "email" type = "text" class = "form-control" placeholder = "請輸入使用者E-mail" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者入學年</label>
            <div class = "col-sm-4">
                <input name = "enroll_year" type = "text" class = "form-control" placeholder = "請輸入使用者入學年" />
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者身份</label>
            <div class = "col-sm-4">
                <select class = "form-control" name = "identity_type">
                    <option value ="1" selected = "selected" >
                        大學部
                    </option>
                    <option value ="2" >
                        研究所
                    </option>
                    <option value ="3" >
                        博士班
                    </option>
                </select>
            </div>
        </div>
        <input type = "submit" name = "send_btn" class = "btn btn-default" value="確定"/>
<?php echo form_close(); ?>
</div><!-- -->
