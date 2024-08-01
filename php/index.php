<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src = "../js/headerButtons.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    
</head>
<body>
    <header>
        <div id = "right">
            <h1><span class = "verde">Campo</span><span class = "rosso"> Minato</span></h1>
            <a href="index.php" id = "home" class = "current">Home</a>
            <a href="difficulty.php" id = "game" >Game</a>
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
     <div id = "titoloMain">
        <span id = "campo" class = "titleField">Campo</span> 
        <span id ="minato" class ="titleField">Minato!</span>
    </div>
    
    <?php
   
    if(isset ($_SESSION['logged']) && $_SESSION['logged'] == true){
    
        if(isset($_SESSION['username']) && isset($_SESSION['logged'])) {
            $username = $_SESSION['username'];
            echo "<p id = 'username'><span class = 'verde'>Bentornato</span>,<span class = 'rosso'> $username!</span></p>";
        }
    }
    ?>
       <div id = "giocaBottone">
       <a id =  "gioca" href = "difficulty.php">Clicca qui per giocare</a>
    </div>
       <h2>Manuale</h2>
       <div id = "howToPlay">
       Il campo minato è un gioco in cui l'obiettivo è scoprire tutte le caselle libere senza far esplodere le mine.
        <ul>
        <li>Il gioco si svolge su una griglia di caselle. Ogni casella può essere vuota o contenere una mina.</li>

        <li> Il giocatore inizia selezionando una casella della griglia. Questa casella viene scoperta, rivelando se contiene una mina o è vuota.</li>

        <li>  Se una casella è vuota, può avere intorno a sé caselle che contengono mine. Le caselle senza mine mostreranno un numero che indica quante mine ci sono nelle caselle adiacenti. </li>

        <li>  Se una casella selezionata contiene una mina, il gioco termina immediatamente e il giocatore perde.</li>
        
        <li>  Il giocatore può segnare le caselle che sospetta contengano mine, cliccando la casella con il tasto destro del mouse.</li>

        <li> L'obiettivo è scoprire tutte le caselle libere senza far esplodere le mine. Il gioco termina con una vittoria quando tutte le caselle senza mine sono scoperte e tutte le mine sono segnate con una bandiera.</li>
       
        <li>  Il campo minato può avere griglie di varie dimensioni e un numero variabile di mine, a seconda del livello di difficoltà desiderato.</li>
 
        <li> è possibile utilizzare fino ad un certo numero di indizi, in base alla difficoltà selezionata. Usarne uno rivela una tessera random sulla tabella. Se è una mina, invece di essere rivelata, vi viene automaticamente piazzata una bandiera sopra.</li>
        
        <li>Al primo click della partita, il giocatore è garantito che la casella cliccata e tutte quelle adiacenti siano vuote.</li>
        
        <li>Se una casella scoperta e non vuota ha un numero di caselle segnate con una bandiera pari al numero scritto sulla casella, è possibile cliccarla con il tasto sinistro per scoprire automaticamente le caselle adiacenti. Se una delle caselle scoperte in questo modo è una mina, il gioco termina con una sconfitta.</li>
        </ul>
        Il sito offre la possibilità di creare un account per tenere traccia dei propri punteggi, e di visualizzare le classifiche dei migliori giocatori nella pagina <a href="classifiche.php">Classifiche</a>
</div>
</main>

    <footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>