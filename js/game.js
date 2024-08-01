    // se il primo click è avvenuto o meno
    let firstClick = false;
    //const boardSize = 10;
    //const numMines = 15;
    let gameInProgress = false;
    let board = [];
    let startTime;
    let timerInterval;
    
    let gamePrev = false;
    let indiziUsati;
    
    let boardSize; 
    let numMines; 
    let difficolta;
    let maxIndizi;
   
    let tempoPassato = 0;
    function difficoltaSetup(){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
       
        difficolta= urlParams.get('difficulty');
        
        switch(difficolta){
            case "facile":
                difficolta = 0;
                numMines = 10;
                boardSize = 10;
                maxIndizi = 3;
                break;
            case "medio":
                difficolta = 1;
                numMines = 20;
                boardSize = 16;
                maxIndizi = 2;
                break;
            case "difficile":
                numMines = 30;
                boardSize = 20;
                maxIndizi = 3;
                difficolta = 2;
                break;
            default:
                //se non era nessuna di queste, deve essere custom, dunque prendiamo i valori passati con GET dal form
                difficolta = -1;
                boardSize = urlParams.get('board_size');
                numMines = Math.floor((urlParams.get('mine_percentage')/100) * boardSize * boardSize);
                maxIndizi = urlParams.get('num_indizi');
                break;
        }
    }
    function fineGioco(vittoria){
        const btn = document.getElementById("avvia");
        btn.disabled = false;
        document.getElementById("riavvia").disabled = true;
        gameInProgress = false;
        gamePrev = true;
        stopTimer();

        //inserimento partita nel database
        let http = new XMLHttpRequest();
        let url = 'inserisciPartita.php';
        let params = "time=" + document.getElementById("timer").innerText.split(" ")[1] + "&difficolta=" + difficolta + "&vittoria=" + vittoria + "&indiziUsati=" + indiziUsati;
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.send(params);
        
        if(!vittoria){ 
            revealAllMines();
            document.getElementById("messaggio").innerText = "Hai perso!";
            return;
        }
        document.getElementById("messaggio").innerText = "Hai vinto!";
        return;
        
    }
    
    function riavvia(){
        
        fineGioco(false);
        iniziaGioco();
    }

    function startTimer() {
        tempoPassato = 1;
        timerInterval = setInterval(updateTimer, 1000);
    }
    
    function updateTimer() {
        
        
        document.getElementById('timer').innerText = "Tempo: " + tempoPassato;
        tempoPassato++;
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }

    function initBoard() {
        for (let i = 0; i < boardSize; i++) {
            let riga = [];
            for (let j = 0; j < boardSize; j++) {
                riga.push({
                    mine: false,
                    revealed: false,
                    flagged: false,
                    count: 0
                });
            }
            board.push(riga);
        }
    }

    function placeMines(xviet, yviet) {
        let count = 0;
       while (count < numMines) {
            let x = Math.floor(Math.random() * boardSize);
            let y = Math.floor(Math.random() * boardSize);
            //se la cella è già minata o è vicina alla cella cliccata
           if (!board[x][y].mine && (Math.abs(x - xviet) > 1 || Math.abs(y - yviet) > 1)) {
                board[x][y].mine = true;
                count++;
            }
        }
    }

    function calcolaConti() {
        for (let i = 0; i < boardSize; i++) {
            for (let j = 0; j < boardSize; j++) {
                if (!board[i][j].mine) {
                    let count = 0;
                    for (let dx = -1; dx <= 1; dx++) {
                        for (let dy = -1; dy <= 1; dy++) {
                            let nx = i + dx;
                            let ny = j + dy;
                            if (nx >= 0 && nx < boardSize && ny >= 0 && ny < boardSize && board[nx][ny].mine) {
                                count++;
                            }
                        }
                    }
                    board[i][j].count = count;
                }
            }
        }
    }
    function assignColor(x, y){
        
        switch(board[x][y].count){
            case 1:
                return "yellow";
            case 2:
                return "orange";
            case 3:
                return "red";
            case 4:
                return "purple";
            case 5:
                return "violet";
            case 6:
                return "purple";
            
        }
    }
    function revealAllMines(){
        for(let x = 0; x < boardSize; x++){
            for(let y = 0; y < boardSize; y++){
                if(board[x][y].mine){
                    const cell = document.getElementById(`cell_${x}_${y}`);
                    cell.classList.add("mine");
                    if(board[x][y].flagged)
                        cell.style.backgroundColor = "grey";
                }
            }
        }

    }
    function revealCell(x, y) {
        
        if (x < 0 || x >= boardSize || y < 0 || y >= boardSize || board[x][y].revealed || board[x][y].flagged) 
            return;
        
        
        if(!firstClick){
            
            firstClick = true;
            document.getElementById("riavvia").disabled = false;
            placeMines(x, y);
            calcolaConti();
            
        }
        
        board[x][y].revealed = true;
        let cell = document.getElementById(`cell_${x}_${y}`);
        cell.classList.remove('hidden');
        cell.classList.add("scoperta");
        if (board[x][y].mine) {
            
            
            cell.classList.add('mine');
            fineGioco(false);

           
        } else {
            if (board[x][y].count === 0) {
                for (let dx = -1; dx <= 1; dx++) {
                    for (let dy = -1; dy <= 1; dy++) {
                        revealCell(x + dx, y + dy);
                    }
                }
            } else {

                cell.innerText = board[x][y].count;
                let color = assignColor(x, y);
                if(board[x][y].count != 0){
                    cell.style.backgroundColor = color;
                } 
            }
        }
    }

    function flagCell(x, y) {
        if (x < 0 || x >= boardSize || y < 0 || y >= boardSize || board[x][y].revealed) return;
        board[x][y].flagged = !board[x][y].flagged;
        let cell = document.getElementById(`cell_${x}_${y}`);

        const msg = document.getElementById("bandiere");
        console.log(msg.innerText);
        let msgNumber = Number(msg.innerText.split(" ")[2]);
        
        if(board[x][y].flagged){
            if(msgNumber != 0){
                msgNumber--;
            }
        }
        else{
            msgNumber++;
        }
        msg.innerText = "Mine Rimaste: " + msgNumber;

        cell.classList.toggle('flagged');
        
        //checkGameStatus();
    }

    function updateIndiziRimasti(){
        const indizi = document.getElementById("indiziRimasti");
        indizi.innerText = "Indizi Rimasti: " + (maxIndizi - indiziUsati);
    };

    function checkGameStatus() {
        let flaggedMines = 0;
        let incorrectlyFlagged = 0;
        let scopertaCounter = 0;
        for (let i = 0; i < boardSize; i++) {
            for (let j = 0; j < boardSize; j++) {
                if (board[i][j].mine && board[i][j].flagged) {
                    flaggedMines++;
                }
                if (!board[i][j].mine && board[i][j].flagged) {
                    incorrectlyFlagged++;
                }  
                if(board[i][j].revealed){
                    scopertaCounter++;
                }
            }
        }
      
        if (flaggedMines === numMines && incorrectlyFlagged === 0 && scopertaCounter == (boardSize * boardSize) - numMines) {
            fineGioco(true);
            
           
        }
    }
    function IsFlagged(x, y){
        if (x < 0 || x >= boardSize || y < 0 || y >= boardSize || board[x][y].revealed) 
        return false;

        return board[x][y].flagged;
    }
    function checkIfSatisfied(x, y){
        let count = 0;
        for(let i = -1; i <= 1; i++){
            for(let j = -1; j <= 1; j++){
                console.log(IsFlagged(i,j));
                if(IsFlagged(x + i,y + j)){
                    count++;
                }
            }
        }
        if(count == board[x][y].count){
            for(let i = -1; i <= 1; i++){
                for(let j = -1; j <= 1; j++){
                    revealCell(x + i,y + j);
                }
            }
        }

    }
    function handleCellClick(event, x, y) {
        if(!gameInProgress)
            return
        if (!startTime) {
            startTime = true;
            startTimer();
               
        }

        if (event.button === 0) {
            if(board[x][y].revealed){
                checkIfSatisfied(x, y);
            }
            revealCell(x, y);
        } else if (event.button === 2) {
            flagCell(x, y);
        }
          
        checkGameStatus();
        
        //evita che il menu contestuale venga visualizzato
        event.preventDefault(); 

    }


function revealBoard() {
    for (let i = 0; i < boardSize; i++) {
        for (let j = 0; j < boardSize; j++) {
            let cell = document.getElementById(`cell_${i}_${j}`);
            if (!board[i][j].revealed) {
                cell.classList.remove('hidden');
                if (board[i][j].mine) {
                    cell.classList.add('mine');
                }
            }
        }
    }
}

function initGame() {
    
    difficoltaSetup();
    firstClick = false;
    initBoard();
    
    
    document.getElementById("riavvia").disabled = true;
    let boardDiv = document.getElementById('board');

    
    for (let i = 0; i < boardSize; i++) {
        for (let j = 0; j < boardSize; j++) {
            let cell = document.createElement('div');
            cell.id = `cell_${i}_${j}`;
            cell.classList.add('cell', 'hidden');
            cell.addEventListener('mousedown', function(event) {
                handleCellClick(event, i, j);
            });
            cell.addEventListener('contextmenu', function(event) {
                event.preventDefault(); // Prevent the default right-click menu
            });
            boardDiv.appendChild(cell);
        }
        boardDiv.appendChild(document.createElement('br'));
    }
    if(!gamePrev){    
        iniziaGioco();    
    }
    
}
function removeAllChildren(tab){
    
    while(tab.firstChild){

        tab.removeChild(tab.firstChild)
    }
}






function iniziaGioco(){
    if(gameInProgress){
        return;
    }
    if(gamePrev){
        stopTimer();
        startTime = false;
        const tim = document.getElementById("timer");
        tim.innerText = "Tempo: 0";
        const tab = document.getElementById("board");
        removeAllChildren(tab);
        board.length = 0;
        firstClick = false;
        document.getElementById("messaggio").innerText = " ";
        initGame();
        document.getElementById("bandiere").innerText = "Mine Rimaste:"
        document.getElementById("indiziRimasti").innerText = "Indizi Rimasti: " + maxIndizi;
        const btn = document.getElementById("hint");
        btn.disabled = false;
        
    }
    indiziUsati = 0;
    document.getElementById("bandiere").innerText += " " + numMines;
    document.getElementById("indiziRimasti").innerText = "Indizi Rimasti: " + maxIndizi;
    
    gameInProgress = true;

    const btn = document.getElementById("avvia");
    btn.disabled = true;
}
function indizio(){
    if(indiziUsati == maxIndizi || !firstClick ){
        console.log(indiziUsati + " Indizi Usati");
        return;
    }


    let x = Math.floor(Math.random() * boardSize);
    let y = Math.floor(Math.random() * boardSize);
    while(board[x][y].revealed || board[x][y].flagged){
        x = Math.floor(Math.random() * boardSize);
        y = Math.floor(Math.random() * boardSize);
    }
    if(board[x][y].mine){
        flagCell(x,y);
    }
    else{
        revealCell(x,y);
    }
    indiziUsati++;
    if(indiziUsati == maxIndizi){
        const btn = document.getElementById("hint");
        btn.disabled = true;
    }
    updateIndiziRimasti();
}