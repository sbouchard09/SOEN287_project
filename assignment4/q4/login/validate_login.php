<?php session_start();
    // get login info file
    // 
    $users = array(); // holds the user account names
    $passwords = array(); // holds the user passwords
    $currentUser = $_POST['user_name'];
    $currentPassword = $_POST['password'];
    $nbAccounts = 0;
    $fileName = "login.txt";
    $usersFile = fopen($fileName, "r+");

    // if username is empty, return to login page
    if(!$_POST['user_name']) {
        header("Location: /assignment4/q4/login/login.php?message=userempty");
        exit();
    }
    // if password is empty, return to login page
    if(!$_POST['password']) {
        header("Location: /assignment4/q4/login/login.php?message=passwordempty");
        exit();
    }

    // if there's nothing in the file, create account
    // else check if the account exists, if not, create account
    // else check password. if password valid, reload index.html
    if(filesize($fileName) === 0) {
        createAccount();
    } else {
        // put entries in the file into the $users array
        // check if user is in the array
        // check if user and pass correspond
        if($usersFile) {
            while(($line = fgets($usersFile)) !== false) {
                $line = trim($line);
                if(empty($line)) {
                    
                } else {
                    $lineArr = explode(":", $line);
                    if(empty($users)) {
                        $users = array($lineArr[0]);
                        $passwords = array($lineArr[1]);
                    } else {
                        array_push($users, $lineArr[0]);
                        array_push($passwords, $lineArr[1]);
                    }
                    $nbAccounts++;
                }
            }
        } else {
            header("Location: /assignment4/q4/login/login.php?message=fileunavailable");
            exit();
        }
        
        chkUsername();
    }

    // check if username exists, if it does, make sure that the entered password corresponds
    // if it doesn't exist, create user
    function chkUsername() {
        global $users, $passwords, $currentUser, $currentPassword;
        
        for($i = 0; $i < count($users); $i++) {
            if($users[$i] === $currentUser) {
                if($passwords[$i] === $currentPassword) {
                    $_SESSION['user'] = $currentUser;
                    header("Location: /assignment4/q4/index/index.php");
                    exit();
                } else {
                    header("Location: /assignment4/q4/login/login.php?message=wrongpassword");
                    exit();
                }
            }
        }
        createAccount();
    }

    function createAccount($fileName = "login.txt") {
        // create account
        // check if username is valid
        global $currentUser, $currentPassword;
        
        if(!ctype_alnum($currentUser)) {
            header("Location: /assignment4/q4/login/login.php?message=invaliduser");
            exit();
        } elseif(!ctype_alnum($currentPassword) || strlen($currentPassword) < 4 || !passValid()) {
            header("Location: /assignment4/q4/login/login.php?message=invalidpass");
            exit();
        }
        // add user:login to the $users array
        // clear file
        // write contents of array to file -- concatenate user:password in array then fwrite($usersFile)
        if(empty($users)) {
            $users[0] = $currentUser;
            $passwords[0] = $currentPassword;
        } else {
            array_push($users, $currentUser);
            array_push($passwords, $currentPassword);
        }
        
        file_put_contents($fileName, $currentUser.':'.$currentPassword."\r\n", FILE_APPEND);
        fclose($fileName);
        
        $_SESSION['user'] = $currentUser;
        header("Location: /assignment4/q4/index/index.php");
        exit();
    }

    // makes sure that the password contains at least one letter and one digit
    function passValid() {
        global $currentPassword;
        $digCount = 0;
        $alphCount = 0;
        
        for($i = 0; $i < strlen($currentPassword); $i++) {
            $charAt = substr($currentPassword, $i, 1);
            
            if(ctype_alpha($charAt))
                $alphCount++;
            if(ctype_digit($charAt))
                $digCount++;
            
            if($digCount > 1 && $alphCount > 1)
                return true;
        }
        
        return false;
    }
?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>
</body>
</html>