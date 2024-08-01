

function inizializza(){
    var customButton = document.getElementById('customButton');
    
    customButton.addEventListener('click', function(event) {
        event.preventDefault();
    
        window.location.href = 'custom_difficulty.php';
})};
