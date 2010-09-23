$(document).ready(function(){
   $('#favorites_list li h3').click(function(){
       $(this).parent().children('ul').toggle();
   }) ;

   //Close Popups and Fade Layer
   $('.close_btn, #popup_background').live('click', function() { //When clicking on the close or fade layer...
       $('#popup_background , #popup_window').fadeOut();
       return false;
   });

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

function ShowEpisode(id)
{	
	$('#popup_window').load(base_url + '/home/episode/' + id);
	
	var popTop = ($(window).height() / 2) - ($('#popup_window').height() / 2) + $(window).scrollTop();
    var popLeft = ($(window).width() / 2) - ($('#popup_window').width() / 2);
	
	$('#popup_window').css({
	    'top' : popTop,
        'left' : popLeft
    });

	$('#popup_background').fadeIn();
	$('#popup_window').fadeIn();
}

function CloseEpisodeWindow()
{
	$('#popup_window').fadeOut();
	$('#popup_background').fadeOut();
}