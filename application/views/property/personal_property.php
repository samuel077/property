
<br/>
<br/>

<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th>財產編號</th>
                        <th>名稱</th>
                        <th>種類</th>
                        <th>財產位置</th>
                        <th>借用狀態</th>
                        <th>申請借用日期</th>
                        <th>財產歸還</th>
                </tr>
        </thead>
        <?php foreach($personalPropertyList as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['property_serial_id'];?></td>
                        <td><?php echo $value['property_name'];?></td>
                        <td><?php echo $value['property_type_name'];?></td>
                        <td><?php echo $value['location_name'];?></td>
			<td><?php echo $value['borrow_status']?></td>
                        <td><?php echo $value['issue_date'];?></td>
                        <td>
                        <button type="button" class="<?php echo $value['returnButtonStyle'];?>" <?php echo $value['extraInfo'];?> <?php echo $value['linkURL'];?>"><?php echo $value['returnButtonString'];?></button>
                        &nbsp;
                        </td>
                </tr>
        <?php endforeach; ?>
        </table>

