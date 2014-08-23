
<div style="width:95%; margin:0 auto;">
	<!-- add a list page -->
	<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
	<thead> 
		<tr>
			<th>財產編號</th>
			<th>名稱</th>
			<th>廠牌</th>
			<th>擺放位置</th>
			<th>詳細資訊</th>
			<th>借用人</th>
		</tr>
	</thead>
		<?php foreach($propertyList as $list => $value) : ?>
		<tr>
			<td><?php echo $value['serial_id'];?></td>
			<td><?php echo $value['name'];?></td>
			<td><?php echo $value['brand'];?></td>
			<td><?php echo $value['location_name'];?></td>
			<td><button type="button" class="btn btn-info" data-target="#modal<?php echo $value['serial_id']?>" data-toggle="modal" >詳細資訊</button></td>
			<td><button type="button" class="btn btn-primary">申請借用</button></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


<?php foreach($propertyList as $list => $value) :?>
<div class="modal fade" id="modal<?php echo $value['serial_id']?>" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-list"></span> &nbsp; 財產詳細資訊</h4>
      </div>
      <div class="modal-body">
	<label>產編 : </label> <?php echo $value['serial_id']?> <br/> 
	<label>廠牌 : </label> <?php echo $value['brand']?> <br/>
	<label>地點 : </label> <?php echo $value['location_name']?> <br/>
	<label>種類 : </label> <?php echo $value['property_type_name']?> <br/>
	<label>借用人 : </label> TBD <br/>
	<label>購買日期 : </label> <?php echo $value['purchase_date']?> <br/>
	<label>財產現值 : </label> <?php echo $value['present_value']?> <br/>
	<label>使用年限 : </label> <?php echo $value['expire_info']?> 月 <br/> 
	<label>備註 : </label> <?php echo $value['note']?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach; ?>
