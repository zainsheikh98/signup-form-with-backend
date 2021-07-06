<?php 
    $HOST  = "localhost";
    $DB  = "signup";
    $USER  = "root";
    $PASSWORD  = "";
    $DB_CONNECTION = mysqli_connect($HOST, $USER, $PASSWORD, $DB);

    $QUERY = "INSERT INTO user (firstName, lastName, email, pass) VALUES (?, ?, ?, ?)";

    if($DB_CONNECTION === false){
        die("Database Not CONNECTED" . mysqli_connect_error());
    }else{

        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPasword = $_POST["confirmPassword"];
        if(isset($firstName) || isset($lastName) || isset($email) || isset($password) || isset($confirmPasword)){
            // check if name only contains letters and whitespace
            if (preg_match("/^[a-zA-Z-' ]*$/", $firstName) && preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($password)>=6){
                        if($password === $confirmPasword){
                            if($stmt = mysqli_prepare($DB_CONNECTION, $QUERY)){
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "ssss", $param_firstName, $param_lastName, $param_email, $param_password);
                                 // Set parameters
                                $param_firstName = $firstName;
                                $param_lastName = $lastName;
                                $param_email = $email;
                                $param_password = $password;
                                
                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt)){
                                    // Records created successfully. Redirect to landing page
                                    echo("User Saved Successfully!");
                                    exit();
                                }else{
                                    echo "ERROR: Could not able to execute $QUERY. " . mysqli_error($DB_CONNECTION);
                                }
                            }
                            mysqli_stmt_close($stmt);
                        }else{
                            echo("Two Password Fields Don't Match");
                        }
                        mysqli_close($DB_CONNECTION);
                    }else{
                        echo("Password Must Have Atleast 6 Characters");
                    }
                }else{
                    echo("Invalid email format");
                }
            }else{
            echo("Name Can Only Contain Letters And WhiteSpaces");
            }
        }else{
            echo("Please Fill All the Fields, As All The Fields Are Required");
        }
    }
?>