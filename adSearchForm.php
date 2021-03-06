<h2>Advanced Search</h2>
<form action="adSearchHandler.php" method="get">   
    <!-- Dropdown that will allow user to pick what parameter to search by -->
    <div class="adv1">
    <table>
        <tr><td><input class="advform" type="text" name="adsongTitle" placeholder="Song Title..." /></td></tr>
        <tr><td><input class="advform" type="text" name="adartist" placeholder="Artist..." /></td></tr>
        <tr><td><input class="advform" type="text" name="adarranger" placeholder="Arranger..." /></td></tr>
        <tr><td><input class="advform" type="text" name="adalbum" placeholder="Album..." /></td></tr>
        <tr><td><input class="advform" type="text" name="adconcert" placeholder="Concert..." /></td></tr>
    </table>
    </div>

    <div class="adv2">
        <table>
        <tr><td>
            <input type="checkbox" name="adactive"/>Active
        </td></tr>
        <tr><td>
            <input type="checkbox" name="adyoutube"/>Youtube Link?
        </td></tr>
        <tr><td>
            <input type="checkbox" name="admp3"/>MP3?
        </td></tr>
        <tr><td>
        Genre:<select name="adgenre">
            <option value="" />
            <option value="alternative">Alternative</option>
            <option value="country">Country</option>
            <option value="hipHop">Hip-Hop</option>
            <option value="pop">Pop</option>
            <option value="punk">Punk</option>
            <option value="rap">Rap</option>
            <option value="rock">Rock</option>
            <option value="other">Other</option>
        </select>
        </td></tr>

    <!-- Key selector --> 
        
        <tr><td>
            Key:<select name="adkey">
            <option value="null"></option>
            <option value="A">A</option>
            <option value="A#">A#</option>
            <option value="Bb">Bb</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="C#">C#</option>
            <option value="Db">Db</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="E#">E#</option>
            <option value="Ff">Ff</option>
            <option value="F">F</option>
            <option value="G">G</option>
            <option value="G#">G#</option>
        </select>
        <select name="adkey2">
            <option value="null"></option>
            <option value="major">Major</option>
            <option value="minor">Minor</option>
        </select>
        </td><tr>

        <!--Solo range selector-->
        
        <tr><td>
        Solo Range:<select name="adsoloRange">
            <option value="null"></option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select>
        to
        <select name="adsoloRange2">
            <option value="null"></option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select></td></tr>
    </table>
    </div>

    <input class="submit" type="submit" name="advSubmit" value="SEARCH!"/>
</form>