<?php
    echo vaildation_error();
?>

<?php
    echo from_open('users/signup');
?>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者帳號</label>
            <div class = "col-sm-4">
                <input name = "account" type = "text" class = "form-control" placeholder = "請輸入使用者帳號">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者密碼</label>
            <div class = "col-sm-4">
                <input name = "passwd" type = "password" class = "form-control" placeholder = "請輸入使用者密碼">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">確認使用者密碼</label>
            <div class = "col-sm-4">
                <input name = "repasswd" type = "password" class = "form-control" placeholder = "請再次輸入使用者密碼">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者姓名</label>
            <div class = "col-sm-4">
                <input name = "name" type = "text" class = "form-control" placeholder = "請輸入使用者姓名">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者學號</label>
            <div class = "col-sm-4">
                <input name = "school_id" type = "text" class = "form-control" placeholder = "請輸入使用者學號">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者E-mail</label>
            <div class = "col-sm-4">
                <input name = "email" type = "text" class = "form-control" placeholder = "請輸入使用者E-mail">
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者入學年</label>
            <div class = "col-sm-4">
                <input name = "enroll_year" type = "text" class = "form-control" placeholder = "請輸入使用者入學年">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-sm-2 control-label">使用者身份</label>
            <div class = "col-sm-4">
                <select class = "form-control" name = "identity_type">
                    <?php for ($i = 0 ;$i < count($type)-1 ;$i++):
                        if($i = 0)
                            echo '<option value ='.$i.' selected = "selected" >';
                        else 
                            echo '<option value ='.$i.' >';
                        echo $type[$i];
                        echo '</option>';
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-sm-4 col-sm-offset-5">
                <button type = "submet" id = "send_btn" class = "btn btn-default">確定</button>
            </div>
        </div>
    </div>
</form>

