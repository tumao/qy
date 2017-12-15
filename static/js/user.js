$(document).ready(function(){
	$('#onload').click(function(){
		username = $("#username").val();
		password = $('#password').val();
		data = {username:username, password:password};
		$.ajax({
			type 	: 'post',
			url		: "/load",
			dataType: 'json',
			data 	: data,
			success	: function(r){
				if(r.code == 1){
					window.location.href = '/';
				}else{
					$('.inputbox').prepend("<div id='error_box'><span style='color:red;'>用户名或密码不正确</span></div>");
				}
			}
		});
	});

});