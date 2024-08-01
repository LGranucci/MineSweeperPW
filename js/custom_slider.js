function inizializza(){
    const boardSizeSlider = document.getElementById("boardSize");
    const boardSizeValue = document.getElementById("boardSizeValue");
    const minePercentageSlider = document.getElementById("minePercentage");
    const minePercentageValue = document.getElementById("minePercentageValue");
    const maxIndiziSlider = document.getElementById("maxIndizi");
    const maxIndiziValue = document.getElementById("maxIndiziValue");
     boardSizeSlider.addEventListener("input", function() {
        boardSizeValue.textContent = this.value;
    });
    maxIndiziSlider.addEventListener("input", function() {
        maxIndiziValue.textContent = this.value;
    });
    minePercentageSlider.addEventListener("input", function() {
        minePercentageValue.textContent = this.value;
    });
    //mette il footer in fondo
    const foot = document.getElementsByTagName("footer");
    foot[0].style.position = "fixed";
    foot[0].style.bottom = 0;
}