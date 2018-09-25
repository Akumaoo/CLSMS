<?php

    include"php_codes/db.php"
    
    

if (isset($_POST['save'])){
    $query = "SELECT * FROM dbo.User WHERE username=? AND pass1=?";
    $parameters = [$_POST["FN"], $_POST["LN"], $_POST["username"], $_POST["pass1"], $_POST["pass2"]];
    $result = sqlsrv_query($conn, $query, $parameters);
    {
        if(empty($FN)){
            array_push($errors, "Fill up First name");
        }
        if(empty($LN)){
            array_push($errors, "Fill up Last name");
        }
        if(empty($username)){
            array_push($errors, "Fill up Username");
        }
        if(empty($pass1)){
            array_push($errors, "Fill up Password");
        }
        if(empty($pass2)){
            array_push($errors, "Confirm Password");
        }
        
        //if no errors
        if(count($errors) == 0){
            $password = md5($pass1);
            $sql = "INSERT INTO dbo.Users(username, password) VALUES('$username', '$password')";
            mysqlsvr_query($db, $sql);
        }
    }
}


    
?>

