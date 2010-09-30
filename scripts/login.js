var usrDefault = '';
var pswDefault = '';

$(document).ready(function(){
	usrDefault = $('#username').val();
	pswDefault = $('#password').val();
	$('#username').focus(function(){
		if(usrDefault == $('#username').val())
			$('#username').val('');
	});
	$('#username').blur(function(){
		if($('#username').val().length == 0)
			$('#username').val(usrDefault);
	});
	$('#password').focus(function(){
		if(pswDefault == $('#password').val())
			$('#password').val('');
	});
	$('#password').blur(function(){
		if($('#password').val().length == 0)
			$('#password').val(pswDefault);
	});

});