<?php
include ("../head_and_foot/head.php");
?>
    <div>
    <h2>Sign in</h2>
    <form method="post" action="validate_login.php">
        <label>Username: <input name="user_name"/></label>
        <br>
        <label>Password:  <input name="password"/></label>
        <br>
        
            <?php if(isset($_GET['message'])) {
                    // message to be displayed if there's an error
                    $message = $_GET['message'];
                    if($message === 'userempty') echo "<div class='error'>Please enter a username</div>";
                    elseif($message === 'passwordempty') echo "<div class='error'>Please enter a password</div>";
                    elseif($message === 'invaliduser') echo "<div class='error'>The username entered is invalid, please enter a new one and try again.</div>";
                    elseif($message === 'wrongpassword') echo "<div class='error'>Incorrect password. Please re-enter your password and try again.</div>";
                    elseif($message === 'invalidpass') echo "<div class='error'>The password entered is invalid, please check the instructions below, and try again.</div>"; 
                    elseif($message === 'fileunavailable') echo "<div class='error'>User file is unavailable. Login unavailable, please try again later.</div>"; } ?>
        <input type="submit" class="buttons" value="Sign in"/>
        <input type="button" class="buttons" value="Go back" onclick="window.location.href='/assignment4/q4/index/index.php'">
    </form>
    <br>
    <fieldset class="instructions">
        <legend class="l_inst">If this is your first visit:</legend>
        Usernames must contain only letters (uppercase and lowercase) as well as digits (0 - 9)
        <br>
        <br>
        Passwords must contain 4 characters, only letters and digits. There must be at least one letter and one digit.
        <br>
        <br>
        To register your account, just click Sign in, and you will be redirected to the home page.
    </fieldset>
    </div>
<?php
include ("../head_and_foot/foot.php");
?>