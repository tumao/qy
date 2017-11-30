
<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script src="/static/js/data.js"></script>
<div class="container">
    <div style="font-size:20px; padding:10px;">数据清洗的主要流程：</div>
    <div class="clearinfo">
        1、清洗不参与评估的机组， 如 T1...。<br/>
        2、带有换牌生产的工班。<br/>
        3、同一工班在一天内有两个生产班次，如一工班，早班和夜班。<br/>
        4、清洗无停机时长的数据。<br/>
        5、清洗单位时间内产量过高或过低的数据， 如：工作了200秒，生产了130件。<br/>
    </div>
    <div  class='selecting'  style="padding: 50px;">
        <div><span class="seltitle" style="margin-right:20px;">年份：</span> <span style="margin-right:20px; cursor: pointer; color: blue;">2017</span></div>
        <div><span class="seltitle" style="margin-right:20px;">月份：</span> <span style="margin-right:20px; cursor: pointer;">8</span><span style="margin-right:20px; cursor: pointer; color: blue">9</span></div>
    </div>
    <?php if($r == 1){ ?>
        <span>数据清洗成功！</span>
    <?php } ?>
    <a href="/data/clean?doit=1"><div class="data-frame"><div class="data" style="cursor: pointer;">一键清洗数据</div></div></a>
    

</div>
