$(document).ready(function(){
   $('#favorites_list li h3').click(function(){
       $(this).parent().children('ul').toggle();
   }) ;
});

function ToggleSeenStatus(id)
{
    $.post(base_url + "/home/toggleseenstatus", {"episodeid": + id},
       function(data){
           if(data.status == 'seen'){
				$('#toggleSeen'+ id).removeClass('unSeenButton')
               	$('#toggleSeen'+ id).addClass('seenButton');
			}
			else if(data.status == 'unseen'){
				$('#toggleSeen' + id).removeClass('seenButton');
				$('#toggleSeen' + id).addClass('unSeenButton');
			}
       },"json");
}