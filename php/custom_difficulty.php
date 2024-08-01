<!-- custom_difficulty.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Difficoltà Custom</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/custom_diff.css">
    </style>
    <script src = "../js/headerButtons.js"></script>

     <script src = "../js/custom_slider.js"></script>
</head>
<body onload ="inizializza()">
    <header>
        <div id = "right">
        <h1><span class = "verde">Campo</span><span class = "rosso"> Minato</h1>
        
        <a href="index.php" id = "home">Home</a>
        <a href="difficulty.php" id = "game" class = "current" >Game</a>
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
    
    <h2><span class = "rosso">Difficoltà</span> <span class = "verde">Custom</span></h2>
    <form action="game.php" method="get">
        <input type="hidden" name="difficulty" value="custom"> 
        <label for="boardSize">Grandezza Tabellone:</label><span id="boardSizeValue" class="slider-value">15</span>
        <br>
        <input type="range" id="boardSize" name="board_size" min="5" max="30" class="slider" value="15">
        <br>
        
        <label for="minePercentage">Percentuale di Mine:</label> <span id="minePercentageValue" class="slider-value">20</span>
        <br>
        <input type="range" id="minePercentage" name="mine_percentage" min="5" max="60" class="slider" value="20">
       
        <br>
        <label for="maxIndizi">Numero massimo di Indizi:</label><span id="maxIndiziValue" class="slider-value">2</span>
        <br>
        <input type="range" id="maxIndizi" name="num_indizi" min="0" max="10" class="slider" value="2">
       
        <button type="submit">Start Game</button>
    </form>
    <footer>
        Progetto realizzato da Luca Granucci per il corso di Progettazione Web
</footer>
</body>
</html>
