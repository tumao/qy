$(document).ready(function(){

	$.ajax({
		url :'/data/graphres',
		dataType : 'json',
		method :'GET',
		success: function(data){
			var mers = data.mvers;
			var classes = data.classes;
			var list = data.result;
			for(x in mers){
				// mers[x].mver;   		// merchine version
				setchart(mers[x].mver, classes, list);	
			}

			setmerchart('merchart', mers, data.merscore);
		}
	});

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


	function setmerchart(tag, mvers, list){
		var myChart = echarts.init(document.getElementById(tag));
		var seriesdata = new Array();
		var dateList;
		var mverlist = new Array();
		for (idx in mvers){
			var tmpdata = new Array();
			var tmp = mvers[idx].mver;
			mverlist.push(tmp);
			tmpdata = list[tmp];
			if(tmpdata){
				var line = tmpdata.map(function(item){
					console.log(item[0	]);
					return item[1];
				});

				var dateline = tmpdata.map(function(item){
					return item[0];
				});
				dateList = dateline;
				// name stack type data
				seriesdata.push({type: 'line',data: line, name:tmp, stack:tmp});

			}
		}
		// console.log(seriesdata);
		option = setchartOption('机型得分', dateList, seriesdata, mverlist);
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
});
