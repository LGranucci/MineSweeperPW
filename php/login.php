<?php

$erroreNonEsiste = false;
$passwordErr = false;

if(isset($_POST['login'])&&isset($_POST['username'])&&isset($_POST['password'])){
    
    $username = $_POST["username"];
    $password = $_POST["password"];


    require "dbaccess.php";
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
             

    if(mysqli_connect_errno())
        die(mysqli_connect_error());
 
    // Prepared Statement
    $query = "select * from utente where Username=?;";
    if($statement = mysqli_prepare($connection, $query)){
        mysqli_stmt_bind_param($statement, 's', $username);

        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        if(mysqli_num_rows($result)==0){
           $erroreNonEsiste= true;
          
        }
           
        
        else {
            $row = mysqli_fetch_assoc($result); 
            $hashedPassword = $row["Password"];

           
            if (password_verify($password, $hashedPassword)) {
                // se la pass è corretta, redirect alla home page
                session_start();
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $username;
                header("Location: index.php");
           
            } else {
                // se la pass è sbagliata, error message
                $passwordErr = true;
            }
        }
      
    }
    else{
        // Close the database connection
            die(mysqli_connect_error());
        }
}
?>


<!DOCTYPE html>

<head>
<html lang="it">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "stylesheet" href = "../css/login.css">
    <link rel = "stylesheet" href = "../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src = "../js/headerButtons.js"></script>
    
</head>
<body>
<header>
        <div id = "right">
        <h1><span class = "verde">Campo</span><span class = "rosso"> Minato </span></h1>
        <a href="index.php" id = "home">Home</a>
            <a href="difficulty.php" id = "game">Game</a>
            <a id = "classifiche" href = "classifiche.php">Classifiche</a>
            </div>
        <div id = "logButtons">
        <?php
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            echo'<button id = "logOut" onclick = "logOutClick()">Log Out</button>';  }
        else{
            echo '<button id = "signUp" onclick = "signupClick()">Sign Up</button>';
        }
        ?>
        </div>
</header>
<form action="login.php" method="post">
    <h2><span class = "rosso">Campo</span> <span class = "verde">Minato</span></h2>
    <input type="text" name="username" placeholder="Username" required><br>
    
    <?php
    if($erroreNonEsiste){
        echo"<span class = \"errore\">Utente non esistente.</span>";
    } ?>
    <input type="password" name="password" placeholder="Password" required><br>
    <?php
        if($passwordErr){
            echo "<span class = \"errore\">Password Sbagliata.</span>";
        }
    ?>
   
    <input type="submit" value="Login" name = "login">
    
    <div id = "linkBox">

    <a href="signup.php">create account</a>
</div>
</form>
<footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>
