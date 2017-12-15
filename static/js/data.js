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

	$('#partment span').click(function(){
		$("#partment span").removeClass('cur');
		$(this).addClass('cur');
		// alert($(this).val());
	});

	$('#year span').click(function(){
		$("#year span").removeClass('cur');
		$(this).addClass('cur');
		// alert($(this).val());
	});

	$('#month span').click(function(){
		$("#month span").removeClass('cur');
		$(this).addClass('cur');
		// alert($(this).val());
	});

	$(".data.classmerscore").click(function(){
		partment = $('#partment .cur').attr('value');
		year = $("#year .cur").text();
		month = $('#month .cur').text();


		if(!partment)
		{
			alert('Please select partment tag');
		}
		if(!year)
		{
			alert('Please select year tag');
		}
		if(!month)
		{
			alert('Please select month tag');
		}
		window.location.href="/data/classmerscore?partment="+partment+"&year="+year+"&month="+month;

	});

	$(".data.merscore").click(function(){
		partment = $('#partment .cur').attr('value');
		year = $("#year .cur").text();
		month = $('#month .cur').text();


		if(!partment)
		{
			alert('Please select partment tag');
		}
		if(!year)
		{
			alert('Please select year tag');
		}
		if(!month)
		{
			alert('Please select month tag');
		}
		window.location.href="/data/merscore?partment="+partment+"&year="+year+"&month="+month;
	});

	$("#cleandata").click(function(){
		partment = $('#partment .cur').attr('value');
		year = $("#year .cur").text();
		month = $('#month .cur').text();
		console.log(partment);
		console.log(year);
		console.log(month);
		if(!partment)
		{
			alert('Please select partment tag');
		}
		if(!year)
		{
			alert('Please select year tag');
		}
		if(!month)
		{
			alert('Please select month tag');
		}
		window.location.href="/data/clean?doit=1&partment="+partment+"&year="+year+"&month="+month;
	});
});
