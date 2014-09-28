    <div class="row">
        <div class="col-xs-3" id="myScrollspy" style="width: 20%;">
            <ul class="nav nav-tabs nav-stacked affix-top" data-spy="affix" data-offset-top="125">
			<?php foreach($ptList as $value => $ptlist) :?>
				<li><a href="#<?php echo $ptlist['name'];?>"><?php echo $ptlist['name'];?></a></li>
			<?php endforeach; ?>	
            </ul>
        </div>
	<div class="col-xs-9" >
    <?php foreach($ptList as $value => $ptlist) :?>
        <br/>
        <br/>
	<section id="<?php echo $ptlist['name'];?>">
        <div>
                <h2><kbd><?php echo $ptlist['name'];?></kbd></h2>
                <button class="btn btn-info pull-right" style="margin-right:30px;">列印</button>
        </div>

        <table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th style="text-align : center;">財產編號</th>
                        <th style="text-align : center;">名稱</th>
                        <!-- <th>廠牌</th> -->
                        <th style="text-align : center;">種類</th>
                        <!--<th>擺放位置</th>-->
                        <th style="text-align : center;">購買日期</th>
                        <th style="text-align : center;">使用年限(月)</th>
                        <th style="text-align : center;">借用人</th>
                </tr>
        </thead>
        <?php foreach($ptlist['propertyList'] as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['serial_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <!-- <td><?php echo $value['brand'];?></td> -->
                        <td style="text-align : center;"><?php echo $value['property_type_name'];?></td>
                        <td style="text-align : center;"><?php echo $value['purchase_date'];?></td>
                        <td style="text-align : center;"><?php echo $value['expire_info'];?></td>
                        <td style="text-align : center;"><?php echo $value['borrowerName'];?></td>
                </tr>
        <?php endforeach; ?>
        </table>
	</section>
    <?php endforeach; ?>
    </div>
 
    </div></div>
    <div style="height:50px;">
