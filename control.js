$(function(){
	$('#myFrom').ajaxForm({
		beforeSend:function(){
			$('.progress').show();
		},
		uploadProgress:function(event,position,total,percentcomplete){
			$('.progress-bar').width(percentcomplete+"%");  
			$('#msg').text(percentcomplete+"%");
			if(percentcomplete == 100){
				alert("Complete");
			}
		},
		success:function(){
			$('.progress').hide();
		},
		complete:function(response){
			$('.show-img').html("<img src="+response.responseText+" />");
		}
	});
	$('.progress').hide();
});