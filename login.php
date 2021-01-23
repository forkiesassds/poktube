<?php

include "header2.php";
error_reporting(1); //fixing the query issue breaks comment sections.

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="styles_alt.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="page_title">Log In</div>
<div style="width:80%;margin:0 auto;overflow:hidden">
    <div style="float:left;width:47%">
        <span class="highlight">What is BitView?</span>
        <br><br>
        PokTube is a way to get your videos to the people who matter to you. With PokTube you can:
        <ul>
            <li> Show off your favorite videos to the world
            </li><li> Blog the videos you take with your digital camera or cell phone
            </li><li> Securely and privately show videos to your friends and family around the world
            </li><li> ... and much, much more!
            </li></ul>
        <br><span class="highlight"><a href="/web/20171203211127/http://www.bitview.net/signup.php">Sign up now</a> and open a free account.</span>
        <br><br><br>
        To learn more about our service, please see our <a href="help.php">Help</a> section.<br><br><br>
    </div>
    <div style="float:right">
        <div class="login_box">
            <div style="margin: 5px 0 9px;font-weight:bold;color: #003366;font-size:14px;text-align:center">
                BitView Log In
            </div>
                <table width="100%" cellspacing="0" cellpadding="5" border="0">
                    <tbody><tr>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <span style="font-weight:bold">User Name:</span>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <span style="font-weight:bold">Password:</span>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
                </tbody></table>
            </form>
            <div style="text-align:center;margin: 5px 0 3px"><a href="javascript:void(0)">Forgot your password?</a></div>
        </div>
    </div>
</div>
</body>
</html>