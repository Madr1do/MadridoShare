<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home/home");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$user_err = "El. paštas";
$pass_err = "Slaptažodis";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $user_err = "Įveskite el. paštą!";
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
        $pass_err = "Įveskite slaptažodį!";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM accounts WHERE email = ?";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $email;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            header("location: home/home");
                        }
                        if(empty(trim($_POST["password"]))){
                            $pass_err = "Įveskite slaptažodį!";
                        }
                        else{
                            // Password is not valid, display a generic error message
                            $pass_err = "Klaidingas slaptažodis";
                        }
                    }
                }
                if(empty(trim($_POST["email"]))){
                    $user_err = "Įveskite el. paštą!";
                }
                else{
                    // Username doesn't exist, display a generic error message
                    $user_err = "Klaida";
                }
            } else{
                echo "Klaida";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($con);
}
?>

<style>

body {
  background: linear-gradient(to top, #86A8E7, #658feb);
  font-family: 'Roboto', sans-serif;

}

input {
  padding: 16px;
  border-radius:7px;
  border:0px;
  background: rgba(255,255,255,.2);
  display: block;
  margin-bottom: 15px;
  width: 40%;
  color:white;
  font-size:18px;
  height: 54px;
}

input:focus {
  outline-color: rgba(0,0,0,0);
  background: rgba(255,255,255,.95);
  color: black;
}

button {
  border: 2px solid #e74c3c;
  background: #e74c3c;
  border-radius:7px;
  padding: 10px;
  color: white;
  font-size: 22px;
  cursor: pointer;
}

button:hover {

  border: 2px solid #e74c3c;
  background: #e74c3c90;
  border-radius:7px;
  padding: 10px;
  color: white;
  font-size: 22px;
  cursor: pointer;
}

input::-webkit-input-placeholder {
  color: white;
}

input:focus::-webkit-input-placeholder {
  color: black;
}

.kont{
  top: 30%;
  position: relative;
  margin-left: 35%;
}

.plotis{
  width: 45%;
}

@media only screen and (max-width: 800px){
  .kont{
    top: 30%;
    position: relative;
    margin-left: 5%;
  }
  .plotis{
    width: 94%;
  }
}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/images/logo.png">
    <title>MadridoShare</title>
</head>
<div class='kont'>
    <form method="POST">
      <h2 style='color: white'>Prisijungimas</h2>

      <input class='plotis' name="email" autocomplete="off" placeholder='<?php echo $user_err?>' type="text" class="user">

      <input class='plotis' name="password" autocomplete="off" placeholder='<?php echo $pass_err?>' type="password" class="pass">

      <button class='plotis' style='font-size: 18px' class="submit">Prisijungti</button>

    </form>
</div>
