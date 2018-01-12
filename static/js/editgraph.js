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
		
	});


});

function editdata(action, parts){
	// window.location.href = '/data/edit_output?partment=1';
	date = $('#dtp_input2').val();
	if(!date){
		alert('请选择日期');
	}else{
		if (action == 'halttime'){
			window.location.href = '/data/edit_halttime?partment='+parts+'&date='+date;;
		}else if(action == 'output'){
			window.location.href = '/data/edit_output?partment='+parts+'&date='+date;;
		}	
	}

	
}