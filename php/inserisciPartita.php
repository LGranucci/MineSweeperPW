<?php
session_start();

if(isset($_SESSION['logged'])&&isset($_POST['time'])&&isset($_POST['difficolta'])){
   
    require_once "dbaccess.php";
    
    $username = $_SESSION["username"];
    $time = $_POST["time"];
    $difficolta = $_POST["difficolta"];
    $vittoria = $_POST["vittoria"];
    if($vittoria == "true"){
        $vittoria = 1;
    }
    else{
        $vittoria = 0;
    }

    $indiziUsati = $_POST["indiziUsati"];
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Create a connection
    if(mysqli_connect_errno())
        die(mysqli_connect_error());
    // Check connection
 
    $query = "insert into partita (Username, Tempo, Difficolta, Vittoria, IndiziUsati) values (?, ?, ?, ?, ?)";
    if($statement = mysqli_prepare($connection, $query)){
        mysqli_stmt_bind_param($statement, 'siiii', $username, $time, $difficolta, $vittoria, $indiziUsati);
        mysqli_stmt_execute($statement);
    }
    else{
        die(mysqli_connect_error());
    }
}
else{
    echo "Errore";
}
?>