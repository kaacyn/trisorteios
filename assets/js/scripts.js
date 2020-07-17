jQuery(document).ready(function ($) {

    function pad(num, size) {
        var s = num+"";
        while (s.length < size) s = "0" + s;
        return s;
    }

  
    function generateNumber(index) {
      var numbers = $("#cartela-premiada").data("numero-cartela");
      var desired = numbers[index];
      var duration = 2000;

      var output = $('#output' + index); 
      var started = new Date().getTime();

      animationTimer = setInterval(function() {
        if (output.text().trim() === desired || new Date().getTime() - started > duration) {
          clearInterval(animationTimer); 
          output.text(pad(desired,2)); 
          if(numbers.length == index + 1){
            $('#titular').slideDown( "slow", function() {
                // Animation complete.
              });
          } else {
            generateNumber(index + 1);
          }
        } else {
          output.text(
            pad( '' + Math.floor(Math.random() * 10) +
            Math.floor(Math.random() * 10),2)
          );
        }
      }, 100);
    }

    if($("#cartela-premiada").data("numero-start") == "on"){
        generateNumber(0);
    }
    

});




