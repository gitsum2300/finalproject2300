//Document handles real-time user search feedback
$(document).ready(function(){
    $('#search').keyup(searchTable);

});


function searchTable(){
    $input = $('#search').val();
	var table = $('#searchTable');
	table.find('tr').each(function(index, row)
	{
	    var allCells = $(row).find('td');
	    if(allCells.length > 0)
	    {
		var found = false;
		allCells.each(function(index, td)
		{
		    var regExp = new RegExp($input, 'i');
		    if(regExp.test($(td).text()))
		    {
			found = true;
		    }
		});
                if(found == true)$(row).show();else $(row).hide();
	    }
	});
}




/*
function printSuggest(json){
    //Delete the current table
    for(var i = $("#searchtable").length - 1; i > 0; i--)
    {
        $("#searchtable").deleteRow(i);
    }
    
    //add the json results to the table
    for(var i=0; i<json.length; i++){
        for(var j=0; j<json[0].length; j++){
            $("#searchtable")
                .append($('<tr>')
                    .append($('<td>') + json[i][j] + $('</td>'))
                .append($('</tr>')));                  
        }
    } 
}
*/

