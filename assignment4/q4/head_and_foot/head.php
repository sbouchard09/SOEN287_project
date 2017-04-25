<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Apartment Search</title>
    <link rel="stylesheet"
          type="text/css"
          href="../styles/ApartmentSearch.css" />
</head>
<body>
    <table>
        <tr>
            <th>
                <a href="../index/index.php">
                <img src="http://www.aptassoc.com/cms/content/widgets/custom/real-estate/images/for-rent.png" alt="For Rent" height=80 width=80>
                </a>
            </th>
            <th>
                <h1>Scott's Apartment Search</h1>
            </th>
            <th></th>
            <th>
                <h3>It is currently <?php echo date('D, F d, Y'); ?> at <span id='time'></span></h3>
            </th>
            <th></th>
            <th>
                <?php if(isset($_SESSION['user'])) echo "Welcome ".$_SESSION['user'].
                                                        "<th>".
                                                        " <form method=\"post\" action=\"../login/logout.php\">".
                                                        "<input type=\"submit\" class=\"buttons\" value=\"Sign out\"/> </form>".
                                                        "</th>";
                      else echo "<a href=\"../login/login.php\">Sign in</a>"; ?>
            </th>
        </tr>
    </table>
    <script>
        function time() {
            var current = new Date();
            var hours = current.getHours();
            var minutes = current.getMinutes();
            var seconds = current.getSeconds();
            
            if(hours < 10) hours = "0" + hours;
            if(minutes < 10) minutes = "0" + minutes;
            if(seconds < 10) seconds = "0" + seconds;
            
            document.getElementById("time").innerHTML = hours + ":" + minutes + ":" + seconds;
        }
        setInterval(time,1000);
    </script>