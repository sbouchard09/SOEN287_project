<?php
include ("../head_and_foot/head.php");
?>
<div>
    <?php
        $fileName = "availableApartments.txt";
        $file = fopen($fileName, "r");
        $contents = array();
        $nbRenters;
        $pets;
        $size;
        $location;
        $price;
        $extras;
        $nbProperties = 0;
        
        // open the file of available apartments and store in $contents
        if($file) {
           while(($line = fgets($file)) !== false) {
               if(empty($line)) {
                   continue;
               }
               
               if(empty($contents)) {
                   $contents = array($line);
               } else {
                   array_push($contents, $line);
               }
           }
            setSearch();
        } else {
            header("Location: /assignment4/q4/login/login.php?message=fileunavailable");
            exit();
        }
    
        echo "<table class=\"listings\">";
        echo "<tr class=\"listings\">";
        echo "<th class=\"listings\">Location</th><th class=\"listings\">Address</th><th class=\"listings\">Size</th><th class=\"listings\">Extras</th><th class=\"listings\">Pets</th><th class=\"listings\">Price</th>";
        echo "</tr>";
        
        // if the user is logged in, they will see complete listings, vs incomplete for a guest
        if(isset($_SESSION['user'])) {
            for($i = 0; $i < count($contents); $i++) {
                $apartmentInfo = explode(";", $contents[$i]);
                
                // check for all the requested characteristics and build a table with the results
                if(checkLocation($apartmentInfo) && 
                   checkPrice($apartmentInfo) &&
                   checkSize($apartmentInfo) &&
                   checkPets($apartmentInfo) &&
                   checkExtras($apartmentInfo)) {
                    $allExtras = explode(",", $apartmentInfo[3]);
                    $allPets = explode(",", $apartmentInfo[4]);
                    echo "<tr class=\"listings\">";
                    echo "<td class=\"listings\">".$apartmentInfo[0]."</td>";
                    echo "<td class=\"listings\">".$apartmentInfo[1]."</td>";
                    echo "<td class=\"listings\">".$apartmentInfo[2]."</td>";
                    echo "<td class=\"listings\"><ul>";
                    for($j = 0; $j < count($allExtras); $j++) echo "<li>".$allExtras[$j]."</li>";
                    echo "</ul></td>";
                    echo "<td class=\"listings\"><ul>";
                    for($k = 0; $k < count($allPets); $k++) echo "<li>".$allPets[$k]."</li>";
                    echo "</ul></td>";
                    echo "<td class=\"listings\">$".$apartmentInfo[5]."/month</td>";
                    echo "</tr>";
                    $nbProperties++;                    
                }
            }
        } else {
            for($i = 0; $i < count($contents); $i++) {
                $apartmentInfo = explode(";", $contents[$i]);
                
                if(checkLocation($apartmentInfo)) {
                    echo "<tr class=\"listings\">";
                    echo "<td class=\"listings\">Apartment found in ".$apartmentInfo[0]."</td>";
                    ?>
                    <td class="listings" colspan="5">
                         <input type="button" class="buttons" value="Please sign in to view more info" onclick="window.location.href='/assignment4/q4/index/index.php'" ></td>
                    <?php
                    echo "</tr>";
                    $nbProperties++;
                }
            }
        }
        // if no properties match the user's search, let them know
        if($nbProperties === 0) {
            echo "<tr class=\"listings\">";
            echo "<td class=\"listings\" colspan=\"6\">Your search returned no results. Please enter a different search and try again";
            echo "</tr>";
        }
        echo "</table>";
        
        // returns true if the user is searching for the location in the apartment listing
        function checkLocation($apartmentInfo) {
            global $location;
            
            if(!isset($_POST['location'])) return true;
            
            for($i = 0; $i < count($location); $i++) {
                if($location[$i] === $apartmentInfo[0])
                    return true;
            }
            return false;
        }
        // returns true if the user's search matches the pet restrictions
        function checkPets($apartmentInfo) {
            global $pets;
            
            if(!isset($_POST['pet'])) return true;
            
            for($i = 0; $i < count($pets); $i++) {
                if($pets[$i] === $apartmentInfo[4])
                    return true;
            }
            return false;
        }
        // returns true if the user's search matches the property size
        function checkSize($apartmentsInfo) {
            global $pets;
            
            if(!isset($_POST['size'])) return true;
            
            for($i = 0; $i < count($size); $i++) {
                if($size[$i] === $apartmentsInfo[2])
                    return true;
            }
            return false;
        }
        // returns true if the price per month is what the user is searching for
        function checkPrice($apartmentsInfo) {
            global $price;
            
            if(!isset($_POST['price'])) return true;
            
            if($price === "less1000") {
                if($apartmentsInfo[5] < 1000)
                    return true;
            } elseif($price === "1000to2000") {
                if($apartmentsInfo[5] >= 1000 && $apartmentsInfo[5] < 2000) {
                    return true;
                }
            } else {
                if($apartmentsInfo[5] >= 2000)
                    return true;
            }
            
            return false;
        }
        // returns true if the extras selected by the user are present in the building
        function checkExtras($apartmentsInfo) {
            global $extras;
            
            if(!isset($_POST['extras'])) return true;
            
            for($i = 0; $i < count($extras); $i++) {
                if($extras[$i] === $apartmentsInfo[3])
                    return true;
            }
            return false;
        }
        
        function setSearch() {
            global $nbRenters, $pets, $size, $location, $price, $extras;
            
            if(isset($_POST['nb_renters'])) $nbRenters = $_POST['nb_renters'];
            if(isset($_POST['pet'])) $pets = $_POST['pet'];
            if(isset($_POST['size'])) $size = $_POST['size'];
            if(isset($_POST['location'])) $location = $_POST['location'];
            if(isset($_POST['price'])) $price = $_POST['price'];
            if(isset($_POST['extras'])) $extras = $_POST['extras'];
        }
    ?>
</div>
<?php
include ("../head_and_foot/foot.php");
?>