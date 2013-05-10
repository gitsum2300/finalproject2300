$(document).ready( function(){
    $("#addUploadAlbumRow").click(getSongsAlbumUpload);
    //$("#buttonNext").after('<td><input type="button" id="addEditAlbumRow" name="addEditAlbumRow" value="add another song"></td>');
});

function getSongsAlbumUpload(){
    request = $.ajax({
        url: "getSongs.php",
        type: "get"        
    });
    
    request.done(albumAddSongsUpload);
}

function albumAddSongsUpload(result) {
    var array= result.split("*");
    
    var current= '<tr><td>Add Song: </td><td><select id="albumSong" name="albumSong[]"><option value="null"></option>';
    
    for(var i=1;i<array.length;i=i+3){
        var newSong= '<option value="'+array[i]+'"> '+array[i+1]+' -- '+array[i+2]+'</option>';
        current= current + newSong;
    }
    current= current + '</select></td></tr>';
    
    $('#albumUploadTable tr:last').after(current);
}