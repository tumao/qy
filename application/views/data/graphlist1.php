<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/static/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src='/static/js/jquery.js'></script>
<script type="text/javascript" src='/static/js/bootstrap.min.js'></script>
<script type="text/javascript" src='/static/js/echarts.min.js'></script>
<script type="text/javascript" src='/static/js/bootstrap-datetimepicker.min.js'></script>
<style type="text/css">
#part1{
	width: 500px;
	height: 370px;
}
#part2{
	width: 500px;
	height: 370px;
}
#center{
	height:800px;
}
#centercontent{
	height: 715px;
}
div#centercontent{
	margin-left: 500px;
}
.config{
	text-align: right;
	padding: 15px;
	border-top: 5px solid #8FBC8F;
}
.center-config{
	border: 5px solid #8FBC8F;
	border-radius: 10px;
	margin-left: 500px;
	/*height: 40px;*/
	padding: 10px;
}
</style>
<div class='menu'>
    <li class='menuitem'><a href="/">数据</a></li>
    <li class='miditem'><a href="#">烟草卷包生产均衡性研究智能平台</a></li>
    <li class='logout'><a href="/logout">退出</a></li>
</div>
<div style="clear:both;"></div>
<div class="containers">
	<div class='leftsidebar'>
		<div class='config'><!-- others --></div>
		<div class='part1' id='part1'>

		</div>
		<div class='config'><!-- others --></div>
		<div class='part2' id='part2'>
			
		</div>
	</div>
	<div class='center' id='center'>
		<div class="center-config">
			<div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">选择月份:</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
				<label>others</label>
            </div>
		</div>
		<div id='centercontent'>
			
		</div>
		<div class="center-config">
			<red>数据质量描述&nbsp;&nbsp;&nbsp;&nbsp;</red>
			制造一部：交接班数据43%&nbsp;&nbsp;&nbsp;
					    制造二部：交接班数据58%.

		</div>
	</div>
</div>
<div class='newpart' id='newpart'>
</div>
<script type="text/javascript" src='/static/js/graph.js'></script>