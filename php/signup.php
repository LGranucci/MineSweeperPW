<?php
   //lo username deve avere tra 4 e 10 caratteri, e contenere solo caratteri alfanumerici
    $regexusr = "/[A-Za-z0-9_]{4,10}/";
    //la password deve avere tra 4 e 16 caratteri, e parmette alcuni caratteri speciali 
    $regexppw = "/[A-Za-z0-9'$'+'@]{4,16}/";

    $erroreName = false;
    $erroreEsistente = false;
    $errorePass = false;
    $erroreRPass = false;
    //verifico che sia stata sottomessa una richiesta di registrazione
    if(isset($_POST['register'])&&isset($_POST['username'])&&isset($_POST['password']) && isset($_POST['rpassword'])){
        //verifico i dati lato server
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
      
        if(preg_match($regexusr, $username)&&preg_match($regexppw, $password)&&($rpassword == $password)){
            
            // mi connetto al db
             require_once "dbaccess.php";
             $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
             if(mysqli_connect_errno())
                 die(mysqli_connect_error());
 
             
 
             //preparo lo statement e accedo al db
 
             $query = "select * from utente where Username=?;";
             if($statement = mysqli_prepare($connection, $query)){
                 mysqli_stmt_bind_param($statement, 's', $username);
         
                 mysqli_stmt_execute($statement);
                 $result = mysqli_stmt_get_result($statement);
                 if(mysqli_num_rows($result)!==0){
                    $erroreEsistente = true;
                    //se esiste già un utente con quel nome, si verifica un errore
                 }
                     
                 else{
                    //creo l'utente e reindirizzo al login
                    $query = "insert into utente (Username, Password) values (?, ?)";
                    if($statement = mysqli_prepare($connection, $query)){
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        mysqli_stmt_bind_param($statement, 'ss',$username, $password);
                
                        mysqli_stmt_execute($statement);
                        header("location: login.php");
                    }
                 
                }
             
            }
        else {
           
            die(mysqli_connect_error());
        }
            
    }
    else{
        if(!preg_match($regexusr, $username)){
            $erroreName = true;
        }
        if(!preg_match($regexppw, $password)){
            $errorePass = true;
        }
        if($password != $rpassword){
            $erroreRPass = true;
        }
        //echo "<script>window.alert('La richiesta è in un formato non corretto')</script>";
    }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel= "stylesheet" href = "../css/header.css">
    
    <link rel="stylesheet" href="../css/footer.css">
    <script src = "../js/headerButtons.js"></script>


</head>
<body>
<header>
        <div id = "right">
        <h1><span class = "verde">Campo</span><span class = "rosso"> Minato </span></h1>
        <a href="index.php" id = "home">Home</a>
            <a href="difficulty.php" id = "game">Game</a>
            <a href = "classifiche.php" id = "classifiche">Classifiche</a>
            </div>
            <div id = "logButtons">
        <?php
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            echo'<button id = "logOut" onclick = "logOutClick()">Log Out</button>';  }
        else{
            echo ' <button id = "login" onclick = "loginClick()">Login</button>';
        }
        ?>
        </div>
    </header>
    <form action="signup.php" method="post">
        <h2><span class = "rosso">Campo</span> <span class = "verde">Minato</span></h2>
        
        <input type="text" name="username" placeholder="Username" required ><br>
        <ul class = "requisiti">
            <li>lo username deve avere tra 4 e 10 caratteri</li> 
            <li>deve contenere solo caratteri alfanumerici</li>
        </ul>
        <?php
        if($erroreName){
            echo "<span id = \"erroreReg\"> username sbagliato!</span>";
        }?>

        <input type="password" name="password" placeholder="Password" required><br>
        <ul class = "requisiti">
            <li>La password deve avere da 4 a 16 caratteri</li>
            <li>Può contenere caratteri alfanumerici, e + @ $</li>
        </ul>
        <?php
        if($errorePass){
            echo "<span id = \"erroreReg\"> Pass sbagliato!</span>";
        }?>
        
        <input type="password" name= "rpassword" placeholder = "Ripeti Password" required> <br>
        
        <?php
        if($erroreRPass){
            echo "<span id = \"erroreReg\"> le pass non coincidono!</span>";
        }?>
        
        <input type="submit" value="Sign Up" name = "register">
        
        <?php
        if($erroreEsistente){
            echo "<span id = \"erroreReg\"> Esiste già un utente</span>";
        }?>
        <div id = "linkBox">
            <a href="login.php">Hai già un account?</a>
         </a>

        </div>
    </form>
    <footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>