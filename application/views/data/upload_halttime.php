
<link href="/static/css/data.css" rel="stylesheet" type="text/css"/>
<script src="/static/js/data.js"></script>
<div class="container">
     <div>
        <div style="font-size:20px;">关于上传halttime数据的格式说明（从第一列到最后一列）请按照如下格式上传excel(xls)表格：</div>
        <div style="padding:20px; font-size:18px;">
            第一列 日期， 如：2017-09-01<br/>
            第二列 机组， 如：1#<br/>
            第三列 部门， 如：制造一部<br/>
            第四列 班次， 如：早班，午班，晚班，夜班<br/>
            第五列 班组， 如：一工班<br/>
            第六列 停机时长（单位：秒）<br/>
        </div>
    </div>
    <?php echo form_open_multipart('http://qy.com/data/upload_halttime');?>
        <input type="file" name="haltfile" size="20" />

        <br /><br />

        <input type="submit" value="upload" />
    </form>
</div>
