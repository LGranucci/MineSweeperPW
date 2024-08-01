<!DOCTYPE html>
<html lang = "it">
<head>
    <title>Classifiche</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/classifiche.css">
    <script src = "../js/headerButtons.js"></script>

</head>
<body>
    
    <header>
        <div id = "right">
            <h1><span class = "verde">Campo</span><span class = "rosso"> Minato</h1>
            <a href="index.php" id = "home">Home</a>
            <a href="difficulty.php" id = "game" >Game</a>
            <a id = "classifiche" href = "classifiche.php" class = "current">Classifiche</a>
         </div>
        <div id = "logButtons">
        <?php
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            echo'<button id = "logOut" onclick = "logOutClick()">Log Out</button>'; 
        }
        else{
            echo ' <button id = "login" onclick = "loginClick()">Login</button>
            <button id = "signUp" onclick = "signupClick()">Sign Up</button>';
        }
        ?>
        </div>
    </header>   
    
    <main>
    <div id = "presentazione">
    <h2>Classifiche</h2>
    <p>Vedi le classifiche degli utenti registrati!</p>
    </div>
        <!-- Your classifiche content goes here -->
        <div id = "tableGrid">
            
        <div class ="tableWrap">   
            <h3> Partite vinte</h3> 
        <table>
        <thead>
            <th>Username</th><th>Partite vinte</th>
        </thead>
           
            <?php 
                function riga($user, $count){
                    echo "<tr> <td>$user</td><td>$count</td></tr>";
                }
                function query($query){
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    $result = mysqli_query($connection, $query);
                    return $result;
                }
                function difficultyQuery($diff){
                    $query = "SELECT Username, Tempo
                                from partita
                                where vittoria = 1 and difficolta = $diff
                                order by Tempo 
                                LIMIT 5";
                    return $query;
                }
                
                    require_once "dbaccess.php";
                  
                   
                    $query = "SELECT Username, count(*) as partite
                                from partita
                                where vittoria = 1
                                group by Username
                                order by partite desc
                                LIMIT 5";
                    $result = query($query);
                    while($row = mysqli_fetch_assoc($result)){
                        $user = $row["Username"];
                        $count = $row["partite"];
                        riga($user, $count);
                    }
                  
                
                //fare blocco catch (necessario?)
                ?>
            </table>
        </div>
        <div class ="tableWrap">   
            <h3> Partite facili in ordine di tempo</h3> 
        <table>
            <thead>
            <th>Username</th><th>Tempo</th>
            </thead>
            <?php 
                $query = difficultyQuery(0);
                  $result = query($query);
                  while($row = mysqli_fetch_assoc($result)){
                      $user = $row["Username"];
                      $count = $row["Tempo"];
                      riga($user, $count);
                  }
                ?>
            </table>
                </div>
                <div class ="tableWrap">   
            <h3> Partite Medie in ordine di tempo</h3> 
        <table>
        <thead>
            <th>Username</th><th>Tempo</th>
            </thead>
            <?php 
                $query = difficultyQuery(1);
                  $result = query($query);
                  while($row = mysqli_fetch_assoc($result)){
                      $user = $row["Username"];
                      $count = $row["Tempo"];
                      riga($user, $count);
                  }
                ?>
            </table>
            </div>


            <div class ="tableWrap">   
            <h3> Partite Difficili in ordine di tempo</h3> 
        <table>
        <thead>
            <th>Username</th><th>Tempo</th>
            </thead>
            <?php 
                $query = difficultyQuery(2);
                  $result = query($query);
                  while($row = mysqli_fetch_assoc($result)){
                      $user = $row["Username"];
                      $count = $row["Tempo"];
                      riga($user, $count);
                  }
                ?>
            </table>
            </div>
    </main>
    
    <footer>
            Progetto realizzato da Luca Granucci per il corso di Progettazione Web
    </footer>
</body>
</html>