/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $('#favorites_list li h3').click(function(){
       $(this).parent().children('ul').toggle();
   }) ;
});

