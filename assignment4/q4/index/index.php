<?php
include ("../head_and_foot/head.php");
?>
    <h2>What are you looking for?</h2>
    <form method="post" action="../search/search.php">
        <fieldset class="f_top">
            <legend class="l_top">Renter Info:</legend>
            <label>How many people will live in the apartment?</label>
            <input type="number" name="nb_renters">
            <br>
            <br>
            <label>Smoker?</label>
            <input type="radio" name="smoker" value="Yes"> Yes 
            <input type="radio" name="smoker" value="No" checked> No<br>
            <br>
            <label>Any pets?</label><br>
            <input type="checkbox" name="pet[]" value="cat"> Cat(s)<br>
            <input type="checkbox" name="pet[]" value="dog"> Dog(s)<br>
            <input type="checkbox" name="pet[]" value="other"> Other; Specify: 
            <input type="text" name="other_specify"><br>
            <input type="checkbox" name="pet[]" value="none"> No Pets<br>
        </fieldset>
        <fieldset class="f_bottom">
            <legend class="l_bottom">What are you looking for?</legend>
            <label>Size of apartment</label><br>
            <input type="checkbox" name="size[]" value="Studio">Studio 
            <input type="checkbox" name="size[]" value="3 1/2">3&frac12;
            <input type="checkbox" name="size[]" value="4 1/2">4&frac12;
            <input type="checkbox" name="size[]" value="5 1/2">5&frac12;
            <input type="checkbox" name="size[]" value="bigger">Bigger than 5&frac12;
            <br>
            <br>
            <label>Locations to search:</label><br>
            <input type="checkbox" name="location[]" value="West Island">West Island 
            <input type="checkbox" name="location[]" value="Downtown">Downtown 
            <input type="checkbox" name="location[]" value="NDG">NDG
            <input type="checkbox" name="location[]" value="Laval">Laval
            <input type="checkbox" name="location[]" value="East">East End
            <input type="checkbox" name="location[]" value="South">South Shore
            <br>
            <br>
            <label>Price/month:</label><br>
            <select name="price">
                <option value="less1000">&lt;$1000</option>
                <option value="1000to2000">$1000 - $2000</option>
                <option value="greater2000">&gt;$2000</option>
            </select>
            <br>
            <br>
            <label>Extras:</label><br>
            <input type="checkbox" name="extras[]" value="indoor parking">Indoor Parking 
            <input type="checkbox" name="extras[]" value="outdoor parking">Outdoor Parking 
            <input type="checkbox" name="extras[]" value="balcony">Balcony
            <input type="checkbox" name="extras[]" value="pool">Pool
            <br>
            <br>
        </fieldset>
        <fieldset class="f_expert" id="f_expert">
            <legend class="l_expert">Expert suggestions:</legend>
            <div id="suggestion"></div>
        </fieldset>
        Let's see what we can find...<br>
        <input type="submit" class="buttons" value="Search" id="search">
        <input type="reset" class="buttons" value="Start Over" id="reset">
    </form>
    <script src="ApartmentSearch.js"></script>
<?php
include ("../head_and_foot/foot.php");
?>