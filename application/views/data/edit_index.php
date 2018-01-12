<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/static/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src='/static/js/jquery.js'></script>
<script type="text/javascript" src='/static/js/bootstrap.min.js'></script>
<script type="text/javascript" src='/static/js/echarts.min.js'></script>
<script type="text/javascript" src='/static/js/bootstrap-datetimepicker.min.js'></script>
<script type="text/javascript" src='/static/js/editgraph.js'></script>
<div class="container">
    <div class="center-config" style='padding: 20px;'>
        <div class="form-group">
            <label for="dtp_input2" class="col-md-2 control-label">选择月份:</label>
            <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value="" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" id="dtp_input2" value="" /><br/>
        </div>
    </div>
    <a href="#" onclick = "editdata('output', 1)">
        <div class="data">
             修改一部的交接班数据
        </div>
    </a>
    <a href="#" onclick="editdata('output', 2)">
        <div class="data">
             修改二部的交接班数据
         </div>
    </a>
    <a href="#" onclick="editdata('halttime', 1)">
        <div class="data">
             修改一部停机时长数据
        </div>
    </a>
    <a href="#" onclick="editdata('halttime', 2)">
        <div class="data">
             修改二部停机时长数据
        </div>
    </a>
</div>
