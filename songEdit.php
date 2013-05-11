<?php
    include('helperFunctions.php');
    //if submit is clicked
    startMysql();
        
    $songid= $_GET['songid'];
    
    //if submit
    if(isset($_POST['submitNew'])){
        
        if(!empty($_POST['deleteSong'])){
            $mysqli->query('DELETE FROM songs WHERE songid="'.$songid.'"');
            $mysqli->query('DELETE FROM concertLink WHERE songid="'.$songid.'"');
            $mysqli->query('DELETE FROM artistLink WHERE songid="'.$songid.'"');
            $mysqli->query('DELETE FROM albumLink WHERE songid="'.$songid.'"');
            header( 'Location: index.php' ) ;
        }
        else {
        
            $songData= $mysqli->query('SELECT * FROM songs NATURAL JOIN artists NATURAL JOIN artistLink
                                  WHERE songid="'.$songid.'"');
            $row= $songData->fetch_assoc();
        
            if(isset($_POST['songNameNew']) && $_POST['songNameNew']!='' && $_POST['songNameNew']!=$row['songName']) {
                if(checkName($_POST['songNameNew'])) {
                    $mysqli->query('UPDATE songs SET songName="'.$_POST['songNameNew'].'"
                                       WHERE songid="'.$songid.'"');
                }
                else {
                    print('<p style="color:red"> New Song Name is not valid </p>');
                }
            }
            if((isset($_POST['artistNameNew']) && $_POST['artistNameNew']!='' && $_POST['artistNameNew']!=$row['artistName']) || $_POST['releaseYearNew']!=$row['releaseYear']){
                if(checkName($_POST['artistNameNew'])){
                    $artistQuery= $mysqli->query('SELECT artistid FROM artists WHERE artistName="'.$_POST['artistNameNew'].'"');
                    if($artistQuery->num_rows<1){ //artist not yet in DB
                        $mysqli->query('DELETE FROM artistLink  WHERE songid="'.$songid.'" AND
                                       artistid="'.$row['artistid'].'" AND releaseYear="'.$row['releaseYear'].'"');
                        $mysqli->query('INSERT INTO artists(artistName) VALUES("'.$_POST['artistNameNew'].'")');
                        $artistidquery= $mysqli->query('SELECT max(artistid) FROM artists');
                        $artistidarray= $artistidquery->fetch_row();
                        $artistid= $artistidarray[0];
                        $mysqli->query('INSERT INTO artistLink(songid, artistid, releaseYear)
                                      VALUES("'.$songid.'", "'.$artistid.'", "'.$_POST['releaseYearNew'].'")');
                    }
                    else { //artist already in DB
                        $artistArray= $artistQuery->fetch_row();
                        $artistid= $artistArray[0];
                        $mysqli->query('DELETE FROM artistLink  WHERE songid="'.$songid.'" AND artistid="'.$row['artistid'].'" AND releaseYear="'.$row['releaseYear'].'"');
                        $mysqli->query('INSERT INTO artistLink(songid, artistid, releaseYear)
                                      VALUES("'.$songid.'", "'.$artistid.'", "'.$_POST['releaseYearNew'].'")');
                    }
                }
                else{
                    print('<p style="color:red"> Artist Name is not valid </p>');
                }
            }
            
            if(isset($_POST['arrangerNew']) && $_POST['arrangerNew']!='' && $_POST['arrangerNew']!=$row['arranger']){
                if(checkName($_POST['arrangerNew'])){
                    $mysqli->query('UPDATE songs SET arranger="'.$_POST['arrangerNew'].'"
                               WHERE songid="'.$songid.'"');
                }
                else{
                    print('<p style="color:red"> Arranger(s) is not valid </p>');
                }
            }
            
            if($_POST['genreNew']!='null' && $_POST['genreNew']!=$row['genre']) {
                $mysqli->query('UPDATE songs SET genre="'.$_POST['genreNew'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['genreNew']=='null' && $row['genre']!=''){
                $mysqli->query('UPDATE songs SET genre=null
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['qualityNew']!='null' && $_POST['qualityNew']!=$row['quality']) {
                $mysqli->query('UPDATE songs SET quality="'.$_POST['qualityNew'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['qualityNew']=='null' && $row['quality']!=''){
                $mysqli->query('UPDATE songs SET quality=null
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['activeNew']!=$row['active']){
                $mysqli->query('UPDATE songs SET active="'.$_POST['activeNew'].'"
                                   WHERE songid="'.$songid.'"');
            }
            
            if($_POST['structureNew']!='null' && $_POST['structureNew']!=$row['structure']) {
                $mysqli->query('UPDATE songs SET structure="'.$_POST['structureNew'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['structureNew']=='null' && $row['structure']!=''){
                $mysqli->query('UPDATE songs SET structure=null
                               WHERE songid="'.$songid.'"');
            }
            
            if(isset($_POST['syllablesNew']) && $_POST['syllablesNew']!=$row['syllables']) {
                $mysqli->query('UPDATE songs SET syllables="'.$_POST['syllablesNew'].'"
                               WHERE songid="'.$songid.'"');
            }
    
            if(file_exists($_FILES['mp3New']['tmp_name'])){
                if(checkmp3($_FILES['mp3New']['name'])){
                    if($row['mp3']=='yes'){unlink("mp3/".$songid);}
                    else {
                        $mysqli->query('UPDATE songs SET mp3="yes"
                                   WHERE songid="'.$songid.'"');
                    }
                    move_uploaded_file($_FILES['mp3New']['tmp_name'],"mp3/".$songid);
                }
                else {
                    print('<p style="color:red"> Mp3 is not the correct file type </p>');
                }
            }
            
            if(isset($_POST['deleteMp3'])){
                unlink("mp3/".$songid);;
                $mysqli->query('UPDATE songs SET mp3="no"
                               WHERE songid="'.$songid.'"');
            }
            
            if(file_exists($_FILES['pdfNew']['tmp_name'])){
                if(checkpdf($_FILES['pdfNew']['name'])){
                    if($row['pdf']=='yes'){unlink("pdf/".$songid);}
                    else {
                        $mysqli->query('UPDATE songs SET pdf="yes"
                                   WHERE songid="'.$songid.'"');
                    }
                    move_uploaded_file($_FILES['pdfNew']['tmp_name'],"pdf/".$songid);
                }
                else{
                    print('<p style="color:red"> Pdf is not the correct file type </p>');
                }
            }
            
            if(isset($_POST['deletePdf'])){
                unlink("pdf/".$songid);;
                $mysqli->query('UPDATE songs SET pdf="no"
                               WHERE songid="'.$songid.'"');
            }
            
            if(isset($_POST['youtubeNew']) && $_POST['youtubeNew']!='' && $_POST['youtubeNew']!=$row['youtube']){
                if(checkYoutube($_POST['youtubeNew'])) {
                    $mysqli->query('UPDATE songs SET youtube="'.$_POST['youtubeNew'].'"
                                   WHERE songid="'.$songid.'"');
                }
                else {
                    print('<p style="color:red"> Youtube link is not valid </p>');
                }
            }
            
            if($_POST['keyNew']!='null' && $_POST['key2New']!='null' &&
               ($_POST['keyNew'].' '.$_POST['key2New'])!=$row['keykey']) {
                $mysqli->query('UPDATE songs SET keykey="'.$_POST['keyNew'].' '.$_POST['key2New'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['keyNew']=='null' || $_POST['key2New']=='null' && $row['keykey']!=''){
                $mysqli->query('UPDATE songs SET keykey=null
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['soloRangeNew']!='null' && $_POST['soloRange2New']!='null' &&
               ($_POST['soloRangeNew'].' '.$_POST['soloRange2New'])!=$row['soloRange']) {
                $mysqli->query('UPDATE songs SET soloRange="'.$_POST['soloRangeNew'].'-'.$_POST['soloRange2New'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['soloRangeNew']=='null' || $_POST['soloRange2New']=='null' && $row['soloRange']!=''){
                $mysqli->query('UPDATE songs SET soloRange=null
                               WHERE songid="'.$songid.'"');
            }
        }
    }
    $songData= $mysqli->query('SELECT * FROM songs NATURAL JOIN artists NATURAL JOIN artistLink
                              WHERE songid="'.$songid.'"');
    $row= $songData->fetch_assoc();
    
    mysqli_close($mysqli);

    print('<form id="songEdit" method="post" enctype="multipart/form-data">');
     //text box for song title 
    print('Edit Song Title: <input type="text" name="songNameNew" value="'.$row['songName'].'" ?></br>');
     //text box for artist 
    print('Edit Artist: <input type="text" name="artistNameNew" value="'.$row['artistName'].'"></br>');
    //text box for arrangers 
    print('Edit Arranger(s): <input type="text" name="arrangerNew" value="'.$row['arranger'].'"> (separate multiple names by commas)</br>');
    //dropdowm box for genre
    $al=''; $co=''; $hi=''; $po=''; $pu=''; $ra=''; $ro=''; $ot='';
    if($row['genre']=='Alternative'){$al= 'selected';}
    elseif($row['genre']=='Country'){$co= 'selected';}
    elseif($row['genre']=='Hip-Hop'){$hi= 'selected';}
    elseif($row['genre']=='Pop'){$po= 'selected';}
    elseif($row['genre']=='Punk'){$pu= 'selected';}
    elseif($row['genre']=='Rap'){$ra= 'selected';}
    elseif($row['genre']=='Rock'){$ro= 'selected';}
    elseif($row['genre']=='Other'){$ot= 'selected';}
    print('Edit Genre: <select name="genreNew">
        <option value="null"></option>
        <option value="Alternative" '.$al.'>Alternative</option>
        <option value="Country" '.$co.'>Country</option>
        <option value="Hip-Hop" '.$hi.'>Hip-Hop</option>
        <option value="Pop" '.$po.'>Pop</option>
        <option value="Punk" '.$pu.'>Punk</option>
        <option value="Rap" '.$ra.'>Rap</option>
        <option value="Rock" '.$ro.'>Rock</option>
        <option value="Other" '.$ot.'>Other</option>
    </select></br>');
    //dropdown box for release year 
    print('Edit Release Year: <select name="releaseYearNew">');
        $year= date('Y');
        for($j=$year;$j>=1960;$j--){
            if($row['releaseYear']==$j){print("<option value=\"$j\" selected> $j</option>");}
            print("<option value=\"$j\"> $j</option>");
        }
    print('</select></br>');
    //dropdown box for quality
    $u=''; $n=''; $b='';
    if($row['quality']=='Usable'){$u= 'selected';}
    elseif($row['quality']=='Needs Work'){$n= 'selected';}
    elseif($row['quality']=='Bad'){$b= 'selected';}
    print('Edit Quality: <select name="qualityNew">
        <option value="null"></option>
        <option value="Usable" '.$u.'>Usable</option>
        <option value="Needs Work" '.$n.'>Needs Work</option>
        <option value="Bad" '.$b.'>Bad</option>
    </select></br>');
    //radio buttons for active
    $no=''; $y='';
    if($row['active']=='yes'){$y= 'checked';}
    elseif($row['active']=='no'){$no= 'checked';}
    print('Edit Active: <input type="radio" name="activeNew" value="yes" '.$y.'>Yes</br>
    <input type="radio" name="activeNew" value="no" '.$no.'>No</br>');
    //pdf
    print('Replace PDF: <input type="file" name="pdfNew">');
    print('Delete Current PDF: <input type="checkbox" name="deletePdf">');
    //dropdown box for arrangement structure
    $p=''; $g=''; $m=''; $c='';
    if($row['structure']=='Glee/Choral'){$c= 'selected';}
    elseif($row['structure']=='4-Part'){$p= 'selected';}
    elseif($row['structure']=='Group'){$g= 'selected';}
    elseif($row['structure']=='Modern'){$m= 'selected';}
    print('Edit Arrangement Structure: <select name="structureNew">
        <option value="null"></option>
        <option value="4-Part" '.$p.'>4-Part</option>
        <option value="Group" '.$g.'>Group</option>
        <option value="Modern" '.$m.'>Modern</option>
        <option value="Glee/Choral" '.$c.'>Glee/Choral</option>
    </select>');
    //radio buttons for syllables for syllables
    $n0=''; $yes='';
    if($row['syllables']=='yes'){$yes= 'checked';}
    elseif($row['syllables']=='no'){$n0= 'checked';}
    print('Edit Syllables: <input type="radio" name="syllablesNew" value="yes" '.$yes.'>Yes
    <input type="radio" name="syllablesNew" value="no" '.$n0.'>No</br>');
    //file input for mp3
    print('Replace MP3: <input type="file" name="mp3New">');
    print('Delete Current MP3: <input type="checkbox" name="deleteMp3">');
    //text box for youtube link
    print('Edit Youtube Link: <input type="text" name="youtubeNew" value="'.$row['youtube'].'">');
    //dropdown box for key
    $A=''; $AA=''; $Bb=''; $B=''; $C=''; $CC=''; $Dd=''; $D=''; $E=''; $EE=''; $Ff=''; $F='';
    $G=''; $GG='';
    if($row['keykey']!=''){
        if($row['keykey'][0]=='A'){
            if($row['keykey'][1]=='#'){$AA= 'selected';}
            else{{$A= 'selected';}}
        }
        elseif($row['keykey'][0]=='B'){
            if($row['keykey'][1]=='b'){$Bb= 'selected';}
            else{{$B= 'selected';}}
        }
        elseif($row['keykey'][0]=='C'){
            if($row['keykey'][1]=='#'){$Cc= 'selected';}
            else{{$C= 'selected';}}
        }
        elseif($row['keykey'][0]=='D'){
            if($row['keykey'][1]=='d'){$Dd= 'selected';}
            else{{$D= 'selected';}}
        }
        elseif($row['keykey'][0]=='E'){
            if($row['keykey'][1]=='#'){$EE= 'selected';}
            else{{$E= 'selected';}}
        }
        elseif($row['keykey'][0]=='F'){
            if($row['keykey'][1]=='f'){$Ff= 'selected';}
            else{{$F= 'selected';}}
        }
        elseif($row['keykey'][0]=='G'){
            if($row['keykey'][1]=='#'){$Gg= 'selected';}
            else{{$G= 'selected';}}
        }
    }
    print('Edit Key: <select name="keyNew">
        <option value="null"></option>
        <option value="A" '.$A.'>A</option>
        <option value="A#" '.$AA.'>A#</option>
        <option value="Bb" '.$Bb.'>Bb</option>
        <option value="B" '.$B.'>B</option>
        <option value="C" '.$C.'>C</option>
        <option value="C#" '.$CC.'>C#</option>
        <option value="Db" '.$Dd.'>Db</option>
        <option value="D" '.$D.'>D</option>
        <option value="E" '.$E.'>E</option>
        <option value="E#" '.$EE.'>E#</option>
        <option value="Ff" '.$Ff.'>Ff</option>
        <option value="F" '.$F.'>F</option>
        <option value="G" '.$G.'>G</option>
        <option value="G#" '.$GG.'>G#</option>
    </select>');
    $major=''; $minor='';
    if(strpos($row['keykey'],'Major')){$major= 'selected';}
    elseif(strpos($row['keykey'],'Minor')){$minor= 'selected';}
    print('<select name="key2New">
          <option value="null"></option>
        <option value="Major" '.$major.'>Major</option>
        <option value="Minor" '.$minor.'>Minor</option>
        </select>');
    //dropdown box for solo range
    $sA=''; $sB=''; $sC=''; $sD=''; $sE=''; $sF=''; $sG='';
    if($row['soloRange']!=''){
        if($row['soloRange'][0]=='A'){$sA= 'selected';}
        elseif($row['soloRange'][0]=='B'){$sB= 'selected';}
        elseif($row['soloRange'][0]=='C'){$sC= 'selected';}
        elseif($row['soloRange'][0]=='D'){$sD= 'selected';}
        elseif($row['soloRange'][0]=='E'){$sE= 'selected';}
        elseif($row['soloRange'][0]=='F'){$sF= 'selected';}
        elseif($row['soloRange'][0]=='G'){$sG= 'selected';}
    }
    print('Edit Solo Range: <select name="soloRangeNew">
        <option value="null"></option>
        <option value="A" '.$sA.'>A</option>
        <option value="B" '.$sB.'>B</option>
        <option value="C" '.$sC.'>C</option>
        <option value="D" '.$sD.'>D</option>
        <option value="E" '.$sE.'>E</option>
        <option value="F" '.$sF.'>F</option>
        <option value="G" '.$sG.'>G</option>
    </select>');
    $sA2=''; $sB2=''; $sC2=''; $sD2=''; $sE2=''; $sF2=''; $sG2='';
    if($row['soloRange']!=''){
        if($row['soloRange'][2]=='A'){$sA2= 'selected';}
        elseif($row['soloRange'][2]=='B'){$sB2= 'selected';}
        elseif($row['soloRange'][2]=='C'){$sC2= 'selected';}
        elseif($row['soloRange'][2]=='D'){$sD2= 'selected';}
        elseif($row['soloRange'][2]=='E'){$sE2= 'selected';}
        elseif($row['soloRange'][2]=='F'){$sF2= 'selected';}
        elseif($row['soloRange'][2]=='G'){$sG2= 'selected';}
    }
    print('to
          <select name="soloRange2New">
          <option value="null"></option>
        <option value="A" '.$sA2.'>A</option>
        <option value="B" '.$sB2.'>B</option>
        <option value="C" '.$sC2.'>C</option>
        <option value="D" '.$sD2.'>D</option>
        <option value="E" '.$sE2.'>E</option>
        <option value="F" '.$sF2.'>F</option>
        <option value="G" '.$sG2.'>G</option>
    </select>');
    //submit button 
?>
Delete Song: <input type="checkbox" value="" id="deleteSong" name="deleteSong[]">
    <input type="submit" name="submitNew">
</form>