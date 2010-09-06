/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $('#favorites_list li h3').click(function(){
       $(this).parent().children('ul').toggle();
   }) ;
});

function ToggleSeenStatus(id)
{
    $.post(base_url + "/home/toggleseenstatus", {"episodeid": + id},
       function(data){
           if(data.status == 'seen')
               $('#toggleSeen'+ id).addClass('seenButton');
       },"json");
}