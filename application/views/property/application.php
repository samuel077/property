<br/>
<br/>
<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th>財產編號</th>
                        <th>名稱</th>
                        <th>廠牌</th>
                        <th>種類</th>
                        <th>借用人</th>
                        <th>申請借用日期</th>
                        <th>管理者功能</th>
                </tr>
        </thead>
        <?php foreach($propertyBorrowList as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['serial_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['brand'];?></td>
                        <td><?php echo $value['property_type_name'];?></td>
                        <td><?php echo $value['borrower']?></td>
                        <td><?php echo $value['issue_date']?></td>
			<td>
			<button type="button" class="btn btn-warning" onclick="javascript:location.href='<?=base_url("/property/approve_app/")?><?php echo "/".$value['appId']?>'"><span class="glyphicon glyphicon-ok"></span></button>
			&nbsp;
			<button type="button" class="btn btn-danger" onclick="javascript:location.href='<?=base_url("/property/disapprove_app/")?><?php echo "/".$value['appId']?>'"><span class="glyphicon glyphicon-remove"></span></button>
			 
			</td>
		</tr>
        <?php endforeach; ?>
        </table>
