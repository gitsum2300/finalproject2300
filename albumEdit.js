//Document handles real-time user album edit feedback
$(document).ready( function(){
    $("#albumNew").change(changeAlbumFields);
    $("#buttonNextAlbumEdit").after('<td><input type="button" id="addEditAlbumRow" name="addEditAlbumRow" value="add another song"></td>');
    $("#addEditAlbumRow").on("click", function() {
        getSongsAlbumEdit();
    });
});

   
function changeAlbumFields(){ //Takes the album selected and fills in the rest of the fields with this info
    
    
    var albumid = $("#albumNew").val();
    var mydata = {id : albumid};
        
    request = $.ajax({
        url: "albumEditHelp.php",
        type: "get",
        data: mydata        
    });
    
    request.done(fillAlbumForm);
}

function fillAlbumForm(result){
    
    var array= result.split("*");
    $("#albumNameNew").val(array[0].trim());
    $("#hangoverYearNew").val(array[1]);
    if(array.length>2){
        $("#deleteCodeAlbum").html('<tr><td>Delete Songs</td><td><td></tr></br>');
        for(var i=2;i<array.length;i=i+3) {
            var line= $("#deleteCodeAlbum").html();
            $("#deleteCodeAlbum").html(line+'<tr><td>'+array[i]+'--'+array[i+1]+' </td><td><input type="checkbox" value="'+array[i+2]+'" name="deleteFromAlbum[]"></td></tr>');
        }
    }
    $("#deleteAlbum").attr("value",albumid);
}

function getSongsAlbumEdit(){
        
    request = $.ajax({
        url: "getSongs.php",
        type: "get"        
    });
    
    request.done(albumAddSongs);
}

function albumAddSongs(result) {
    var array= result.split("*");
    
    var current= '<tr><td>Add Song: </td><td><select id="albumSongNew" name="albumSongNew[]"><option value="null"></option>';
    
    for(var i=1;i<array.length;i=i+3){
        var newSong= '<option value="'+array[i]+'"> '+array[i+1]+' -- '+array[i+2]+'</option>';
        current= current + newSong;
    }
    current= current + '</select></td></tr>';
    
    $('#albumEditTable tr:last').before(current);
}