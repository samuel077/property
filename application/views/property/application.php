	<h2><kbd style="align:center; font-family:Microsoft JhengHei;">財產借用申請列表</kbd></h2>
<br/>
<br/>
<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th style="text-align: center;">財產編號</th>
                        <th style="text-align: center;">名稱</th>
                        <th style="text-align: center;">種類</th>
                        <th style="text-align: center;">借用人</th>
                        <th style="text-align: center;">申請借用日期</th>
                        <th style="text-align: center;">管理者功能</th>
                </tr>
        </thead>
        <?php foreach($propertyBorrowList as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['serial_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td style="text-align: center;"><?php echo $value['property_type_name'];?></td>
                        <td style="text-align: center;"><?php echo $value['borrower']?></td>
                        <td style="text-align: center;"><?php echo $value['issue_date']?></td>
			<td>
			<button type="button" class="btn btn-success" onclick="javascript:location.href='<?=base_url("/property/approve_app/")?><?php echo "/".$value['appId']?>'"><span class="glyphicon glyphicon-ok"></span></button>
			&nbsp;
			<button type="button" class="btn btn-danger" onclick="javascript:location.href='<?=base_url("/property/disapprove_app/")?><?php echo "/".$value['appId']?>'"><span class="glyphicon glyphicon-remove"></span></button>
			 
			</td>
		</tr>
        <?php endforeach; ?>
</table>
<br/>
<br/>
	<h2><kbd style="align:center; font-family:Microsoft JhengHei;">財產歸還確認列表</kbd></h2>
<br/>
<br/>
<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th style="text-align: center;">財產編號</th>
                        <th style="text-align: center;">名稱</th>
                        <th style="text-align: center;">種類</th>
                        <th style="text-align: center;">借用人</th>
                        <th style="text-align: center;">申請歸還日期</th>
                        <th style="text-align: center;">管理者功能</th>
                </tr>
        </thead>
        <?php foreach($propertyReturnList as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['serial_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td style="text-align: center;"><?php echo $value['property_type_name'];?></td>
                        <td style="text-align: center;"><?php echo $value['borrower']?></td>
                        <td style="text-align: center;"><?php echo $value['issue_date']?></td>
                        <td>
                        <button type="button" class="btn btn-success" onclick="javascript:location.href='<?=base_url("/property/return_pro_check/")?><?php echo "/".$value['appId']?>'"><!-- <span class="glyphicon glyphicon-ok"></span> -->確認歸還</button>
                        &nbsp;
                        </td>
                </tr>
        <?php endforeach; ?>
</table>
