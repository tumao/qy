<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script src="/static/js/data.js"></script>
<div class="container">
    <div style="margin-bottom:20px;"><button id='delbutton'>删除该月数据</button></div>
    <table class="table table-condensed">
    <input type="hidden" id='partment' name="partment" value="<?php echo $partment; ?>">
    <input type="hidden" name="year" value="<?php echo $year; ?>">
    <input type="hidden" name="month" value="<?php echo $month; ?>">
        <thead>
            <tr>
                <th>日期</th>
                <th>工班</th>
                <th>班次</th>
                <th>机组</th>
                <th>停机时长（s）</th>
                <th>部门</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $value) {?>
            <tr>
                <td><?php echo $value->date; ?></td>
                <td><?php echo $value->class; ?></td>
                <td><?php echo $value->class_sort; ?></td>
                <td><?php echo $value->mid; ?></td>
                <td><?php echo $value->halttime; ?></td>
                <td><?php echo $value->part; ?></td>
            </tr>
        <?php } ?>
             
        </tbody>
    </table>

</div>
