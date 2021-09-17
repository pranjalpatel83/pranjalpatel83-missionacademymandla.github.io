<?php
// Include config file
require_once "adminconfig.php";
 
// Define variables and initialize with empty values
$username = $name = $surname = $emailid = $mobileno = $gender = $password = $confirm_password = "";
$username_err =$name_err = $surname_err = $emailid_err = $mobileno_err = $gender_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            mysqli_stmt_bind_param($stmt, "s", $param_surname);
            mysqli_stmt_bind_param($stmt, "s", $param_emailid);
            mysqli_stmt_bind_param($stmt, "s", $param_mobileno);
            mysqli_stmt_bind_param($stmt, "s", $param_gender);
            
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            $param_name = trim($_POST["NAME"]);
            $param_surname = trim($_POST["SURNAME"]);
            $param_emailid = trim($_POST["emailid"]);
            $param_mobileno = trim($_POST["mobile_no"]);
            $param_gender = trim($_POST["GENDER"]);
            
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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO admin (username,name,surname,emai_id,mobile_no, password,gender) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,'s', $param_username,$param_name,$param_surname,$param_emailid,$param_mobileno,$param_gender, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_name = $name;
            $param_surname = $sername;
            $param_emailid = $emailid;
            $param_mobileno = $mobileno;
            $param_gender = $gender;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px;text-align: center;border:5px solid green; }
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
                <label>NAME</label>
                <input type="text" name="NAME" class="form-control ">
                <span class="invalid-feedback">></span>
            </div>   
            <div class="form-group">
                <label>SURNAME</label>
                <input type="text" name="SURNAME" class="form-control ">
                <span class="invalid-feedback">></span>
            </div>
            <div class="form-group">
                <label>emailid</label>
                <input type="text" name="emailid" class="form-control ">
                <span class="invalid-feedback">></span>
            </div>
            
            <div class="form-group">
                <label>mobile no</label>
                <input type="text" name="mobile_no" class="form-control ">
                <span class="invalid-feedback">></span>
            </div>

            <div class="form-group">
                <label>GENDER</label>
                <select name="GENDER" >
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                    <option value="TRANSGENDER">TRANSGENDER</option>
                </select> <span>*</span><br><br>
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



<html>
<head>
    <title>signup</title>
    <link rel="stylesheet" href="css/insert.css" />
</head>
<body>
    <div class="maindiv">
    <!--HTML form -->
        <div class="form_div">
            <div class="title"><h2>Insert Data In Database Using PHP.</h2>      </div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    <!-- method can be set POST for hiding values in URL-->
                <h2>Form</h2>

                <label>Name:</label>
                <br />
                <input class="input" type="text" name="name" value=""  />
                <br />
                <label>Email:</label><br />        
                <input class="input" type="text" name="mail"  value=""  />
                <br />

                <label>Phone:</label><br />        
                <input class="input" type="text" name="phone"  value=""  />
                <br />
                <label>Password:</label><br />        
                <input class="input" type="text" name="pass"  value=""  />
                <br />

                <label>Address:</label><br />
                <textarea rows="5" cols="25" name="add"></textarea>
                <br />

                <input class="submit" type="submit" name="submit"    value="Insert" />  

<?php
//Establishing Connection with Server
$connection = mysql_connect("localhost", "root", "buet2010");

//Selecting Database from Server
$db = mysql_select_db("tanni", $connection);
if(isset($_POST['submit'])){

//Fetching variables of the form which travels in URL

$name = $_POST['name'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$add = $_POST['add'];
if($name !=''||$email !=''){
//Insert Query of SQL
$query = mysql_query($db, "INSERT INTO user (name, mail, phone, pass, add)VALUES('$name', '$mail', '$phone', '$pass', '$add')",$connection);
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";   
}

}
//Closing Connection with Server
mysql_close($connection);
?>                  
            </form>
        </div>

    </div>
</body>
