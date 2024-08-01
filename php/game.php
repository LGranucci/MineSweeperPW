
<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minesweeper</title>
<link rel="stylesheet" href="../css/game.css">
<link rel="stylesheet" href="../css/header.css">
<script>
    
    
</script>
<script src= "../js/game.js"></script>
<script src = "../js/headerButtons.js"></script>
<link rel="stylesheet" href="../css/footer.css">
<style>
        
   
</style>
</head>

<body onload = "initGame()">
    <header>
        <div id = "right">
        <h1><span class = "verde">Campo</span><span class = "rosso"> Minato </span></h1>
        <a href="index.php" id = "home">Home</a>
            <a href="difficulty.php" id = "game" class = "current">Game</a>
            <a id = "classifiche" href = "classifiche.php">Classifiche</a>
            </div>
        <div id = "logButtons">
        <?php
       
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            echo'<button id = "logOut" onclick = "logOutClick()">Log Out</button>';  }
        else{
            echo ' <button id = "login" onclick = "loginClick()">Login</button>
            <button id = "signUp" onclick = "signupClick()">Sign Up</button>';
        }
        ?>
    </div>
    </header>

<div id = "statusBar">
    <span id="timer">Tempo: 0</span>
    <span id = "bandiere">Mine Rimaste:</span>
    <span id = "indiziRimasti">Indizi Rimasti:</span>
</div>
<p id ="messaggio"></p>
<div id="board"></div>
<div id = "bottone">
    <button id = "avvia" onclick = "iniziaGioco()">Avvia</button>
    <button id = "riavvia" onclick = "riavvia()" >Riavvia</button><br><br>
    <a href="difficulty.php"><button id = "diffChang" onclick = "indizio()"> Cambia Difficoltà </button></a>
    <button id = "hint" onclick = "indizio()">Indizio</button>
</div>

<footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>
