function prenotazioniMaggio() {

  $.ajax({

    url: "getPrenotazioniMaggio.php",
    method: "GET",
    success: function(data) {

      var prenotazioni = JSON.parse(data);

      var container = $(".prenotazioni");

      var template = $("#prenotazioni-template").html();
      var compiled = Handlebars.compile(template);

      for (var i = 0; i < prenotazioni.length; i++) {

        var prenotazione = prenotazioni[i];
        var finalHTML = compiled(prenotazione);
        container.append(finalHTML);
      }
    }
  });
}

function init() {

  prenotazioniMaggio();
}

$(document).ready(init);
