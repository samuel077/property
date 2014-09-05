<div style="width:97%; margin:0 auto;">
<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th>學號</th>
                        <th>姓名</th>
                        <th>帳號</th>
                        <th>入學年</th>
                        <th>管理者審核專區</th>
                </tr>
        </thead>
	<?php foreach($userlist as $value => $user) :?>
		<tr>
                        <td><?php echo $user['school_id'];?></td>
                        <td><?php echo $user['name'];?></td>
                        <td><?php echo $user['account'];?></td>
                        <td><?php echo $user['enroll_year'];?></td>
			<td>
				&nbsp;&nbsp;<button class="btn btn-success" onclick="javascript:location.href='<?=base_url("/user/approve/")?><?php echo "/".$user['id']?>'"><span class="glyphicon glyphicon-ok"></span></button>
				&nbsp;&nbsp;<button class="btn btn-danger" onclick="javascript:location.href='<?=base_url("/user/disapprove/")?><?php echo "/".$user['id']?>'"><span class="glyphicon glyphicon-remove"></span></button>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
</div>
