<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script src="/static/js/data.js"></script>
<style type="text/css">
    #partment .cur{
         color: blue;
    }
    #year .cur{
        color:blue;
    }
    #month .cur{
        color: blue;
    }
</style>
<div class="container">
    <div  class='selecting'  style="padding: 50px;">
        <div id='partment'>
            <span class="seltitle" style="margin-right:20px;">部门:</span> 
                <span class='cur' style="margin-right:20px; cursor: pointer;" value='1'>制造一部</span>
                <span class='' style="margin-right:20px; cursor: pointer;" value='2'>制造二部</span>
        </div>
        <div id='year'>
            <span class="seltitle" style="margin-right:20px;">年份：</span> <span class='cur' style="margin-right:20px; cursor: pointer;">2017</span>
        </div>
        <div id='month'>
            <span class="seltitle" style="margin-right:20px;">月份：</span> <span class='cur' style="margin-right:20px; cursor: pointer;">8</span><span style="margin-right:20px; cursor: pointer;">9</span>
        </div>
    </div>
    <!-- <a href="/data/classmerscore"> -->
        <div class="data classmerscore">
             导出班组机型的得分
        </div>
    <!-- </a> -->
    <!-- <a href="/data/merscore"> -->
        <div class="data merscore">
             导出不同机型的得分
         </div>
    <!-- </a> -->
 <!--    <a href="/file/各个机型每天打分.xlsx">
        <div class="data">
             导出不同部门的得分
         </div>
    </a> -->
</div>
