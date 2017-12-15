<script type="text/javascript" src='/static/js/jquery.js'></script>
<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src='/static/js/echarts.min.js'></script>
<script type="text/javascript" src='/static/js/graph.js'></script>
<style type="text/css">
    body{
        background-image: url(/static/images/background.jpg);
    }
    .container{
        margin: 20px;
        padding: 20px;
    }
    .classchart{
        float: left;
    }
    .classtitle span{
        font-size: 18px;
        text-align: center;
        padding: 20px;
    }
</style>
<div class="container">
    <div>
        
    </div>
    <div style='classscore'>
        <div class="classtitle"><span>班组得分</span></div>
        <?php foreach ($mvers as $val) {?>
        <div class='classchart' id="<?php echo $val->mver; ?>" style="height:400px; width:600px;"></div>
        <?php } ?>
    </div>
    <div class='merscore'>
        <div class="classtitle" style="display: block;"><span></span></div>    
        <div class='merchart' id='merchart' style="height: 400px;">
            
        </div>
    </div>

</div>
