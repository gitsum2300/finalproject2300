
$(document).ready(function(){
    
    $("#slideshow").before('<div class="pager"></div>'); 

    $("#slideshow").cycle(
    { 
      pause: 1,
      pager: ".pager"
    });
    
 
})