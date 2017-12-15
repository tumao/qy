<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script src="/static/js/data.js"></script>
<div class="container">
    <div>
        <div style="font-size:20px;">关于上传交接班数据的格式说明（从第一列到最后一列）请按照如下格式上传excel(xml)表格：</div>
        <div style="padding:20px; font-size:18px;">
            第一列 日期， 如：2017-09-01<br/>
            第二列 班组， 如：一工班<br/>
            第三列 品牌， 如：云烟（红）<br/>
            第四列 机组， 如：1#<br/>
            第五列 产量（单位：件）<br/>
            第六列 部门， 如：制造一部<br/>
        </div>
    </div>
    <!-- <form action="/index.php?data/test" id="form" method="post" enctype="multipart/form-data">    
        <input type="submit" value="提交"><input type="file" style="width:20%; float:left;" size="20" name="uploadfile">
    </form> -->
    <?php echo form_open_multipart('http://qy.com/data/upload_output');?>

        <input type="file" name="userfile" size="20" />

        <br /><br />

        <input type="submit" value="upload" />

        </form>
</div>
