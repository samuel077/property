
<br/>
<br/>

<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th style="text-align: center;">財產編號</th>
                        <th style="text-align: center;">名稱</th>
                        <th style="text-align: center;">種類</th>
                        <th style="text-align: center;">財產位置</th>
                        <th style="text-align: center;">借用狀態</th>
                        <th style="text-align: center;">申請借用日期</th>
                        <th style="text-align: center;">財產歸還</th>
                </tr>
        </thead>
        <?php foreach($personalPropertyList as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['property_serial_id'];?></td>
                        <td><?php echo $value['property_name'];?></td>
                        <td style="text-align: center;"><?php echo $value['property_type_name'];?></td>
                        <td style="text-align: center;"><?php echo $value['location_name'];?></td>
			<td style="text-align: center;"><?php echo $value['borrow_status']?></td>
                        <td style="text-align: center;"><?php echo $value['issue_date'];?></td>
                        <td>
                        <button type="button" class="<?php echo $value['returnButtonStyle'];?>" <?php echo $value['extraInfo'];?> <?php echo $value['linkURL'];?>"><?php echo $value['returnButtonString'];?></button>
                        &nbsp;
                        </td>
                </tr>
        <?php endforeach; ?>
        </table>

