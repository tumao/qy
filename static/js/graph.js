$(document).ready(function(){
	$('.form_date').datetimepicker({
	    language:  'zh-CN',
	    format:'yyyy-mm',
	    weekStart: 1,
	    todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 3,
		minView: 3,
		forceParse: 0
	}).on('changeDate', function(ev){
		console.log(ev);
		$.ajax({
			url : '/data/chartmain',
			data : {timestamp:ev.date},
			dataType:'json',
			method: 'GET',
			success : function(data){
				newsetchart('part1','制造一部', data['evepart'][0]);
				newsetchart('part2','制造二部', data['evepart'][1]);
				newsetchart('centercontent', '部门综合', data['partscr']);
			}
		});
	});

	$.ajax({
		url :'/data/chartmain',
		dataType : 'json',
		method : 'GET',
		success: function(data){
			newsetchart('part1','制造一部', data['evepart'][0]);
			newsetchart('part2','制造二部', data['evepart'][1]);
			newsetchart('centercontent', '部门综合', data['partscr']);
		}
	});

	function newsetchart(tag, chartname, list)
	{
		var myChart = echarts.init(document.getElementById(tag));
		var seriesdata = new Array();
		var keys = new Array();
		var len = 0;
		var dateline = Array();
		for (x in list){
			if(x == '1'){
				keys.push("制造一部");
				name = "制造一部";
			}
			else if (x=='2'){
				keys.push("制造二部");
				name = "制造二部";
			}else{
				keys.push(x);
				name = x;
			}

			var tmpdata = list[x];
			
			if(tmpdata){
				var line = tmpdata.map(function(item){
					return item[1];
				});
				if(tmpdata.length > len){
					len = tmpdata.length;
					var dateline = tmpdata.map(function(item){
						return item[0];
					});																																																											
				}
				seriesdata.push({type: 'line', data: line, name:name, stack:name});
				
			}
		}
		option = setchartOption(chartname, dateline, seriesdata, keys);
		myChart.setOption(option);
	}


	function setchart(tag, classes, list)	
	{

		var myChart = echarts.init(document.getElementById(tag));
		var seriesdata = new Array();
		var classes;
		var dateList;

		for (cla in classes){
			var tmp = classes[cla].class;
			var tmpdata = new Array();
			classes.push(tmp);		// save class and sort
			tmpdata=list[tag][tmp];

			if(tmpdata){
				var line = tmpdata.map( function (item) {
					return item[1];
				});
				var dateline = tmpdata.map(function(item){
					return item[0];
				});
				dateList = dateline;
				seriesdata.push({type: 'line', data: line, name:tmp, stack:tmp});

			}
		}

		option = setchartOption(tag, dateList, seriesdata, classes);
		myChart.setOption(option);
	}

	function setchartOption(chartName, dateList, seriesdata, namelist){
		 // 指定图表的配置项和数据
	 
	    // 使用刚指定的配置项和数据显示图表。
	    var option = {
		    title: {
		        text: chartName
		    },
		    tooltip: {
		        trigger: 'axis'
		    },
		    legend: {
		        data:namelist
		    },
		    grid: {
		        left: '3%',
		        right: '4%',
		        bottom: '3%',
		        containLabel: true
		    },
		    toolbox: {
		        feature: {
		            saveAsImage: {}
		        }
		    },
		    xAxis: {
		        type: 'category',
		        boundaryGap: false,
		        data: dateList
		    },
		    yAxis: {
		        type: 'value',
		        min: 60,
		        max:100
		    },
		    series: seriesdata
		};

	    return option;
	}


	function test(){
		alert(123123213);
	}
});
