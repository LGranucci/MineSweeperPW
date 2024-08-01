
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Difficoltà</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/difficulty.css">
    <script src = "../js/headerButtons.js"></script>

    <script src = "../js/difficulty.js"></script>

</head>
<body onload = "inizializza()">
    <header>
        <div id = "right">
        <h1><span class = "verde">Campo</span><span class = "rosso"> Minato </span></h1>
        <a href="index.php" id = "home">Home</a>
            <a href="difficulty.php" id = "game" class = "current">Game</a>
            <a id = "classifiche" href = "classifiche.php">Classifiche</a>
        </div>
        <div id = "logButtons">
        <?php
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            echo'<button id = "logOut" onclick = "logOutClick()">Log Out</button>';  }
        else{
            echo ' <button id = "login" onclick = "loginClick()">Login</button>
            <button id = "signUp" onclick = "signupClick()">Sign Up</button>';
        }
        ?>
    </div>
    </header>
    <main>

    <h2><span class = "verde">Seleziona</span> <span class = "rosso">Difficoltà</span></h2>
    <form action="game.php" method="get">
        <div class = "diffCard">
            <div class = "cardImmagine">
                <img src="../img/facile.png" alt="">
            </div>

            <button class = "diff" type = "submit" name ="difficulty" value = "facile">Facile</button>
    
        </div>
        <div class = "diffCard">
            <div class = "cardImmagine">
                <img src="../img/medio.png" alt="">
            </div>

            <button class = "diff" type = "submit" name ="difficulty" value = "medio">Medio</button>
    
        </div>
        <div class = "diffCard">
            <div class = "cardImmagine">
                <img src="../img/difficile.png" alt="">
            </div>

            <button class = "diff" type = "submit" name ="difficulty" value = "difficile">Difficile</button>
    
        </div>
        <div class = "diffCard">
            <div class = "cardImmagine">
                <img src="../img/custom.png" alt="">
            </div>

            <button class = "diff" id = "customButton">Custom</button>
   
    </form>
</main>
<footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>