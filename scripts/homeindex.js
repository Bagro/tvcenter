var searchTextDefault = '';

$(document).ready(function(){
   $('#favorites_list li h3').click(function(){
       $(this).parent().children('ul').toggle("normal");
   }) ;

	$('#series_list li h3').click(function(){
       $(this).parent().children('ul').toggle("normal");
   }) ;

   //Close Popups and Fade Layer
   $('.close_btn, #popup_background').live('click', function() { //When clicking on the close or fade layer...
       $('#popup_background , #popup_window').fadeOut();
       return false;
   });
	
	searchTextDefault = $('#searchtext').val();
	
	$('#searchtext').focus(function(){
		if(searchTextDefault == $('#searchtext').val())
			$('#searchtext').val('');
	});
	$('#searchtext').blur(function(){
		if($('#searchtext').val().length == 0)
			$('#searchtext').val(searchTextDefault);
	});
});

function ToggleSeenStatus(id)
{
    $.post(base_url + "/home/toggleseenstatus", {"episodeid": + id},
       function(data){
           if(data.status == 'seen'){
				$('#toggleSeen'+ id).removeClass('unSeenButton')
               	$('#toggleSeen'+ id).addClass('seenButton');
				$('#ptoggleSeen'+ id).removeClass('unSeenButton')
               	$('#ptoggleSeen'+ id).addClass('seenButton');
			}
			else if(data.status == 'unseen'){
				$('#toggleSeen' + id).removeClass('seenButton');
				$('#toggleSeen' + id).addClass('unSeenButton');
				$('#ptoggleSeen' + id).removeClass('seenButton');
				$('#ptoggleSeen' + id).addClass('unSeenButton');
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

function ToggleFavorite(id)
{
    $.post(base_url + "/series/togglefavorite", {"favoriteid": + id},
       function(data){
           if(data.status == 'favorite'){
				$('#togglefavorite'+ id).removeClass('notFavoriteButton')
               	$('#togglefavorite'+ id).addClass('favoriteButton');
			}
			else if(data.status == 'notfavorite'){
				$('#togglefavorite' + id).removeClass('favoriteButton');
				$('#togglefavorite' + id).addClass('notFavoriteButton');
			}
       },"json");
}