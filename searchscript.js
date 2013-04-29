//Document handles real-time user search feedback
$(document).ready( function(){
    ("#search").keyup(getSearchSuggest);
    
    function getSearchSuggest(){
        var search = $("#search").val();
        var mydata = {searchterm : search};
        
        request = $.ajax({
                url: "findMatch.php",
                type: "get",
                data: mydata,
                dataType: "json"
        });
        
        request.done(printSuggest);
    }
    
    //Takes the search results from findMatch and prints them out into a table
    function printSuggest(){}
});

