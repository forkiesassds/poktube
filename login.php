<?php
include("header.php");
// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script>history.go(-1)</script>";
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["loginsubmit"])){
	
	$onlinenow = date('h');
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim(htmlspecialchars($_POST["username"]));
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
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
							
                            // Redirect user to welcome page
                            echo "<script>window.location.replace('index.php');</script>";
                        } else{
                            // Display an error message if password is not valid
                            echo "The password you entered was not valid.";
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





<div style="padding: 0px 5px 0px 5px;">

<div class="ui container">
	<h1 class="header">Log In</h1>
		<div class="ui grid">
			<div class="ui ten wide column">
				<div class="ui conainer">
					<span class="highlight">What is PokTube?</span>

					PokTube is a way to get your videos to the people who matter to you. With PokTube you can:
					
					<ul>
					<li> Show off your favorite videos to the world
					</li><li> Blog the videos you take with your digital camera or cell phone
					</li><li> Securely and privately show videos to your friends and family around the world
					</li><li> ... and much, much more!
					</li></ul>

					<br><span class="highlight"><a href="signup.php">Sign up now</a> and open a free account.</span>
					<br><br><br>
					
					To learn more about our service, please see our <a href="help.php">Help</a> section.<br><br><br>
				</div>
			</div>
			<div class="ui four wide right floated column">
				<div class="ui conainer">
					<form method="post" name="loginForm" id="loginForm" action="login.php">
					<input type="hidden" name="field_command" value="login_submit">
						<div class="ui labeled input" width="300px" style="width: 100%;">
						  <div class="ui label">
							Username
						  </div>
						  <input tabindex="1" type="text" size="20" name="username" value="">
						</div>
						<div class="ui labeled input" width="300px" style="width: 100%;">
						  <div class="ui label">
							Password
						  </div>
						  <input tabindex="2" type="password" size="20" name="password">
						</div>
						<input class="ui primary button" type="submit" value="Log In" name="loginsubmit">
						<td align="center" colspan="2"><a href="forgot.php">Forgot your password?</a><br><br></td>
					</form>
					<script language="javascript">
						onLoadFunctionList.push(function(){ document.loginForm.field_login_username.focus(); });
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>