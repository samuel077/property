<div class="row"> 
<!--Nav Bar -->
    <nav class="col-xs-2" id = "my_scrollspy">
        <ul id="sidebar" class="nav nav-list affix">
            <li class="nav nav-stacked"><a href="#LAB315">LAB 315</a></li>
            <li><a href="#LAB501">LAB 501</a></li>
	    <li><a href="#LAB402">LAB 402</a></li>
            <li><a href="#LAB510A">LAB 510A</a></li>
            <li><a href="#LAB501D">LAB 501D</a></li>
            <li><a href="#R206">R 206</a></li>
        </ul>
    </nav>

    <div class="col-xs-10" >
    <?php foreach($ptList as $value => $ptlist) :?>
    <section id="<?php echo $ptlist['name'];?>" >
	<br/>
	<br/>
	<div>
		<h2><kbd><?php echo $ptlist['name'];?></kbd></h2>
		<button class="btn btn-info pull-right" style="margin-right:30px;">列印</button>
	</div>

	<table class="table table-striped" style="align:center; font-family:Microsoft JhengHei;">
        <thead>
                <tr>
                        <th>財產編號</th>
                        <th>名稱</th>
                        <th>廠牌</th>
                        <th>種類</th>
                        <!--<th>擺放位置</th>-->
                        <th>購買日期</th>
                        <th>使用年限(月)</th>
                        <th>借用人</th>
                </tr>
        </thead>
        <?php foreach($ptlist['propertyList'] as $list => $value) : ?>
                <tr>
                        <td><?php echo $value['serial_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['brand'];?></td>
                        <td><?php echo $value['property_type_name'];?></td>
                        <td><?php echo $value['purchase_date'];?></td>
                        <td><?php echo $value['expire_info'];?></td>
                        <td>待實作</td>
		</tr>
        <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
    </section>
	</div>
</div>

