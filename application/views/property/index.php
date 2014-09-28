<div style="width:97%; margin:0 auto;">
	<!-- the script is used for add a click for pagination icon -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
        $(document).ready(function(){
                $('#pagination a').bind('click', function() {
                        var url = $(this).attr('href');
                        pageno = ((matchs = url.match(/(\d+)$/))!= undefined) ? matchs[0] : 0;
                        $('#offset').attr('value', pageno);
                        $('#search').submit();
                        return false;
                        });
        });
	</script>	
	<form id="search" role="form" method="post" action="<?=base_url("/property/index")?>">
          <div class="row">
            <div class="col-md-6">
              <p style="margin-top:25px;">顯示<?php echo $totalRows;?>筆資料中 第 <?php echo $rowFrom?> 到 第 <?php echo $rowTo;?> 筆 資料</p>
            </div>
            <div class="col-md-6">
	      <input type="hidden" id="offset" name="offset"/>
	      <!--<input type="text" id="searcterm" name="searchterm"/ placeholder="輸入關鍵字搜尋">-->
              <div class="row" id="pagination">
              <?php echo $pagination;?>
              </div>
            </div>
          </div>
        </form>
	<!-- add a list page -->
	<table class="table table-striped table-hover" style=" font-family:Microsoft JhengHei;">
	<thead> 
		<tr>
			<th style="text-align: center;">財產編號</th>
			<th style="text-align: center;">名稱</th>
			<!-- <th style="text-align: center;">廠牌</th>--> 
			<th style="text-align: center;">擺放位置</th>
			<th style="text-align: center;">詳細資訊</th>
			<th style="text-align: center;">借用人</th>
			<?php if(isset($is_admin)) : ?>
				<?php if($is_admin) :?>
				<th style="text-align: center;">管理者功能</th>
				<?php endif; ?>
			<?php endif; ?>
		</tr>
	</thead>
		<?php foreach($propertyList as $list => $value) : ?>
		<tr>
			<td width="15%"><?php echo $value['serial_id'];?></td>
			<td> 
				<div style="border-style:solid; border-width:0px; width: 250px; text-overflow: ellipsis; overflow: hidden">
				<?php echo $value['name'];?>
				</div>
			</td>
			<!-- <td style="text-align: center;"><?php echo $value['brand'];?></td>-->
			<td style="text-align: center;"><?php echo $value['location_name'];?></td>
			<td style="text-align: center;"><button type="button" class="btn btn-info" data-target="#info<?php echo $value['serial_id']?>" data-toggle="modal" >詳細資訊</button></td>
			<td style="text-align: center;"><button type="button" class="<?php echo $value['applyButtonStyle'];?>" <?php echo $value['applyButtonExtraInfo'];?> ><?php echo $value['applyButtonString'];?></button></td>
			<?php if(isset($is_admin)) : ?>
				<?php if($is_admin) :?>
				<td style="text-align: center;"> 
					<button type="button" class="btn btn-warning" data-target="#update<?php echo $value['serial_id']?>" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span></button>
					&nbsp;
					<button type="button" class="btn btn-danger" data-target="#delete<?php echo $value['serial_id']?>" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button>
				</td>
				<?php endif; ?>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


<?php foreach($propertyList as $list => $value) :?>
<div class="modal fade" id="info<?php echo $value['serial_id']?>" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-list"></span> &nbsp; <b>財產詳細資訊</b></h4>
      </div>
      <div class="modal-body">
	<form class="form-horizontal" role="form">
	  <div class="form-group">
	    <label class="col-sm-3 control-label">產編：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['serial_id']?></p>
	    </div>
	  </div>
	  <div class="form-group">
            <label class="col-sm-3 control-label">名稱：</label>
            <div class="col-sm-5">
              <p class="form-control-static"><?php echo $value['name']?></p>
            </div>
          </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">廠牌：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['brand']?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">地點：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['location_name']?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">種類：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['property_type_name']?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">借用人：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['borrowerName'];?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">購買日期：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['purchase_date']?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">財產原始價值：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['origin_value']?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">使用年限：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['expire_info']?>個月</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">備註：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static"><?php echo $value['note']?></p>
	    </div>
	  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach; ?>
<!-- update page -->

<?php foreach($propertyList as $list => $value) :?>
<div class="modal fade" id="update<?php echo $value['serial_id']?>" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" action="<?=base_url("/property/update")?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-list"></span> &nbsp; <b>財產詳細資訊</b></h4>
      </div>
      <div class="modal-body">
	  <div class="form-group">
	    <label class="col-sm-3 control-label">產編：</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" id="serial_id" name="serial_id" value="<?php echo $value['serial_id']?>" />
	    </div>
	  </div>
	  <div class="form-group">
            <label class="col-sm-3 control-label">名稱：</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $value['name']?>" />
            </div>
          </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">廠牌：</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $value['brand']?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">地點：</label>
	    <div class="col-sm-5">
                     <select class="form-control" id="location" name="location">
                       <?php foreach($location_list as $key=>$locationFront): ?>
		       <option value="<?php echo $locationFront['id'];?>" <?php if($locationFront['id'] == $value['location_id']) echo "selected"; ?>><?php echo $locationFront['name']?></option>
		       <?php endforeach; ?>
		     </select>
	    </div>
	  </div>
	  <div class="form-group">
                        <label class="col-sm-3 control-label" for="property_type">種類：</label>
                        <div class="col-sm-5">
                                <select class="form-control" id="property_type" name="property_type">
                                <?php foreach($property_type_list as $key=>$propertyTypeFront): ?>
                                        <option value="<?php echo $propertyTypeFront['id'];?>" <?php if($propertyTypeFront['id'] == $value['property_type']) echo "selected"; ?>><?php echo $propertyTypeFront['name']?></option>
                                <?php endforeach; ?>
                                </select>
                        </div>
          </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">借用人：</label>
	    <div class="col-sm-5">
	      <p class="form-control-static">TBD</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">購買日期：</label>
	    <div class="col-sm-5">
	      <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="<?php echo $value['purchase_date']?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">財產原始價值：</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" id="current_value" name="current_value" value="<?php echo $value['origin_value']?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">使用年限(月)：</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" id="expire_info" name="expire_info"value="<?php echo $value['expire_info']?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label">備註：</label>
	    <div class="col-sm-5">
	      <textarea rows="2"  id="note" name="note" class="form-control"/><?php echo $value['note'];?></textarea>
	    </div>
	  </div>
      </div>
      <input id="id" name="id" type="hidden" value="<?php echo $value['id']?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-success">送出修改</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php foreach($propertyList as $list => $value) :?>
<div class="modal fade" id="delete<?php echo $value['serial_id']?>" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" action="./property/remove/" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-list"></span> &nbsp; <b>財產詳細資訊</b></h4>
      </div>
      <div class="modal-body">
	  <p><h3>確認是否刪除財產&nbsp;『<?php echo $value['name']?>』</h3></p>
      </div>
      <input id="id" name="id" type="hidden" value="<?php echo $value['id']?>">
      <input id="status" name="status" type="hidden" value="remove">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-danger">確認刪除</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php foreach($propertyList as $list => $value) :?>
<div class="modal fade" id="borrow<?php echo $value['serial_id']?>" style="align:center; font-family:Microsoft JhengHei;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" action="<?=base_url("/property/borrow")?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h6 class="modal-title"><span class="glyphicon glyphicon-list"></span> &nbsp; <b>申請借用財產</b></h4>
      </div>
      <div class="modal-body">
          <p><h3>確認是否申請借用財產&nbsp;『<?php echo $value['name']?>』</h3></p>
      </div>
      <input id="property_id" name="property_id" type="hidden" value="<?php echo $value['id']?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">申請用借</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
