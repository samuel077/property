	<!-- we need a form here.-->
	<!-- <div class="page-header"> <h1 style="align:center; font-family:Microsoft JhengHei; margin-left:180;"><b>新建財產</b><small><b>手動輸入</b></small></h1></div> -->
	<div style="margin-top:30px;">
	<?php
    		echo validation_errors();
    		$attributes = array('class' => 'form-horizontal' , 'role' => 'form');
    		echo form_open('property/create' , $attributes);
	?>

	<!-- <form class="form-horizontal" role="form" action="<?=base_url("/property/create")?>" method="post" accept-charset="utf-8">-->
		<div class="form-group">
			<label class="col-sm-3 control-label" for="name">財產名稱：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="name" name="name"placeholder="請輸入財產名稱">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="sequence">財產編號：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="sequence" name="sequence"placeholder="請輸入財產編號">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="purchaseDate">購入日期：</label>
			<div class="col-sm-5">
				<input type="date" id="purchaseDate" name="purchaseDate" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="expire_info">財產年限：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="expire_info" name="expire_info" placeholder="請輸入財產保存年限，以月為單位。EX : 12">
			</div>
		</div>
		<!-- 財產種類，應該要設計一個下拉式選單-->
		<div class="form-group">
			<label class="col-sm-3 control-label" for="property_type">財產種類：</label>
			<div class="col-sm-5">
				<select class="form-control" id="property_type" name="property_type">
				<?php foreach($property_type_list as $key=>$value): ?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['name']?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="brand">財產廠牌：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="brand" name="brand" placeholder="請輸入財產廠牌">
			</div>
		</div>
		
		<!-- 財產的位置，這裡也需要一個下拉式選單 -->
		<div class="form-group">
			<label class="col-sm-3 control-label" for="location">財產位置：</label>
			<div class="col-sm-5">
				<select class="form-control" id="location" name="location">
				<?php foreach($location_list as $key=>$value): ?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['name']?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="currentValue">財產現值：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="currentValue" name="currentValue" placeholder="請輸入財產現值">
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="note">備註：</label>
			<div class="col-sm-5">
				<textarea class="form-control" rows="2" name="note"></textarea>
			</div>
		</div>
		<!-- unused form list 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="sequence">財產編號：</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="sequence" placeholder="請輸入財產編號">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="sequence">財產編號：</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="sequence" placeholder="請輸入財產編號">
			</div>
		</div> -->
	<br/>
	<input type="submit" class="btn btn-primary" style="margin-left:180;" value="建立財產"/>
	</form>
</div>
