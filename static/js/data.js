$(document).ready(function(){
	$("#delbutton").click(function(){
		// val = $("#partment").value();
		// alert(val);
		partment = $("input[name='partment']").val();
		year = $("input[name='year']").val();
		month = $("input[name='month']").val();

		if(confirm('是否定删除当前信息？')){
			$.get('/data/deloutput', {year:year, month: month, partment:partment}, function(){
				alert(partment+'部门'+year+'/'+month+"数据删除成功！");
			});
		}
	});
});
