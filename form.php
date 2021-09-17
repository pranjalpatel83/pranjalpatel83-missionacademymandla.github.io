<?php
// Include config file
require_once "pconfig.php";
 
// Define variables and initialize with empty values
$name = $surname = $gender = $emailid = $mobileno = $course = "";
$name_err = $surname_err = $gender_er = $emailid_err = $mobileno_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
        $name_err = "name can only contain letters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["name"]);
            
             //Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                /* store result */
                 mysqli_stmt_store_result($stmt);
                 
                if(mysqli_stmt_num_rows($stmt) == 1){
                   $name_err = "This username is already taken.";
                } else{
                    $name = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate surname
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Please enter a surname.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["surname"]))){
        $surrname_err = "surname can only contain letters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE surname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_surname);
            
            // Set parameters
            $param_surname = trim($_POST["surname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $surname_err = "This username is already taken.";
                } else{
                    $surname = trim($_POST["surname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate gender
    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please enter a gender.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["gender"]))){
        $gender_err = "gender can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE gender = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_gender);
            
            // Set parameters
            $param_gender = trim($_POST["gender"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $gender_err = "This gender is already taken.";
                } else{
                    $gender = trim($_POST["gender"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate emailid
    if(empty(trim($_POST["emailid"]))){
        $emailid_err = "Please enter a emailid.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["emailid"]))){
        $emailid_err = "emailid can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE emailid = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_emailid);
            
            // Set parameters
            $param_emailid = trim($_POST["emailid"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $emailid_err = "This emailid is already taken.";
                } else{
                    $emailid = trim($_POST["emailid"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    
    // Validate mobileno
    if(empty(trim($_POST["mobileno"]))){
        $mobileno_err = "Please enter a mobileno.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["mobileno"]))){
        $mobileno_err = "mobileno can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM pusers WHERE mobileno = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobileno);
            
            // Set parameters
            $param_mobileno = trim($_POST["mobileno"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $mobileno_err = "This mobileno is already taken.";
                } else{
                    $mobileno = trim($_POST["mobileno"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($name_err) && empty($surname_err) && empty($gender_err) && empty($emailid_err) && empty($mobileno_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO pusers (username, name, surname, gender, emailid, mobileno, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $param_name, $param_surname, $param_gender, $param_emailid, $param_mobileno, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_name = $name;
            $param_surname = $surname;
            $param_gender = $gender;
            $param_emailid = $emailid;
            $param_mobileno = $mobileno;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: plogin.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel = "icon" href = "logo.jpeg" 
        type = "image/x-icon">
        <style>
        body{ align-items :center ; font: 14px sans-serif;}
        .wrapper{ width: 360px; padding: 20px; text-align: center;border: 5px solid green;margin: 20px; }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>    
            <div class="form-group">
                <label>surname</label>
                <input type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                <span class="invalid-feedback"><?php echo $surname_err; ?></span>
            </div>
            <div class="form-group">
                <label>gender</label>
                <input type="text" name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>">
                <span class="invalid-feedback"><?php echo $gender_err; ?></span>
            </div>
            <div class="form-group">
                <label>emailid</label>
                <input type="text" name="emailid" class="form-control <?php echo (!empty($emailid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailid; ?>">
                <span class="invalid-feedback"><?php echo $emailid_err; ?></span>
            </div>
            <div class="form-group">
                <label>mobileno</label>
                <input type="text" name="mobileno" class="form-control <?php echo (!empty($mobileno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobileno; ?>">
                <span class="invalid-feedback"><?php echo $mobileno_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>