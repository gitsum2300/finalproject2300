//Document handles real-time user concert edit feedback
$(document).ready( function(){
    $("#concertNew").change(changeConcertFields);
    $("#buttonNextConcertEdit").after('<td><input type="button" id="addEditConcertRow" name="addEditConcertRow" value="add another song"></td>');
    $("#addEditConcertRow").on("click", function() {
        getSongsConcertEdit();
    });
});

   
function changeConcertFields(){ //Takes the concert selected and fills in the rest of the fields with this info
    
    var concertid = $("#concertNew").val();
    var mydata = {id : concertid};
        
    request = $.ajax({
        url: "concertEditHelp.php",
        type: "get",
        data: mydata        
    });
    
    request.done(fillConcertForm);
}

function fillConcertForm(result){
    var array= result.split("*");
    $("#concertNameNew").val(array[0].trim());
    $("#concertYearNew").val(array[1]);
    if(array.length>2){
        $("#deleteCodeConcert").html('<tr><td>Delete Songs</td><td><td></tr></br>');
        for(var i=2;i<array.length;i=i+3) {
            var line= $("#deleteCodeConcert").html();
            $("#deleteCodeConcert").html(line+'<tr><td>'+array[i]+'--'+array[i+1]+' </td><td><input type="checkbox" value="'+array[i+2]+'" name="deleteFromConcert[]"></td></tr>');
        }
    }
    $("#deleteConcert").attr("value",concertid);
}

function getSongsConcertEdit(){
        
    request = $.ajax({
        url: "getSongs.php",
        type: "get"        
    });
    
    request.done(concertAddSongs);
}

function concertAddSongs(result) {
    var array= result.split("*");
    
    var current= '<tr><td>Add Song: </td><td><select id="concertSongNew" name="concertSongNew[]"><option value="null"></option>';
    
    for(var i=1;i<array.length;i=i+3){
        var newSong= '<option value="'+array[i]+'"> '+array[i+1]+' -- '+array[i+2]+'</option>';
        current= current + newSong;
    }
    current= current + '</select></td></tr>';
    
    $('#concertEditTable tr:last').before(current);
}