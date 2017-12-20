<script type="text/javascript" src='/static/js/jquery.js'></script>
<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src='/static/js/echarts.min.js'></script>
<script type="text/javascript" src='/static/js/graph.js'></script>
<style type="text/css">
    body{
        background-image: url(/static/images/background.jpg);
        padding: 0px;
        margin: 0px;
    }
    .container{
        /*margin: 20px;
        padding: 20px;*/
        width: auto;
    }
    .classchart{
        float: left;
    }
    .classtitle span{
        font-size: 18px;
        text-align: center;
        padding: 20px;
    }
    .menu{
        height: 30px;
        background-color: #8FBC8F;
    }
    .menu li{
        list-style: none;
        padding:3px 10px;
        /*padding-left: 10px;*/

    }
    .menu li a{
        text-decoration: none;
        color: white;
    }
    li.menuitem{
        float: left;
    }
    li.miditem{
        float: left;
        display: inline-block;
        width: 1200px;
        text-align: center;
    }
    li.logout{
        float: right;
    }
</style>
<div class='menu'>
    <li class='menuitem'><a href="/">数据</a></li>
    <li class='miditem'><a href="#">烟草卷包生产均衡性研究智能平台</a></li>
    <li class='logout'><a href="/logout">退出</a></li>
</div>
<div style="clear:both;"></div>
<div class="container">

    <div class='classscore'>
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
