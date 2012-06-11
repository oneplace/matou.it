$(function(){
	$('#btn_remote_logo').click(function(){
		var logo_url = $('#logo_url').val();
		if(!logo_url) return false;
		$.get(baseUrl+'/project/remotelogo',{logo:logo_url},function(data){
			$("#logo-container").html(data);
		});
		return false;
	});
});