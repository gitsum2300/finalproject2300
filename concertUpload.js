$(document).ready( function(){
    $("#buttonNextConcertUpload").after('<td><input type="button" id="addUploadConcertRow" name="addUploadConcertRow" value="add another song"></td>');
    $("#addUploadConcertRow").on("click", function() {
        getSongsConcertUpload();
    });
});

function getSongsConcertUpload(){
    request = $.ajax({
        url: "getSongs.php",
        type: "get"        
    });
    
    request.done(concertAddSongsUpload);
}

function concertAddSongsUpload(result) {
    var array= result.split("*");
    
    var current= '<tr><td>Add Song: </td><td><select id="concertSong" name="concertSong[]"><option value="null"></option>';
    
    for(var i=1;i<array.length;i=i+3){
        var newSong= '<option value="'+array[i]+'"> '+array[i+1]+' -- '+array[i+2]+'</option>';
        current= current + newSong;
    }
    current= current + '</select></td></tr>';
    
    $('#concertUploadTable tr:last').after(current);
}