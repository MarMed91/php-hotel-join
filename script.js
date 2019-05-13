function ospitiList() {

  $.ajax({

    url: "getOspitiList.php",
    method: "POST",
    success: function(data) {

      var ospiti = JSON.parse(data);

      var container = $(".prenotazioni1");

      var template = $("#nameSurname-template").html();
      var compiled = Handlebars.compile(template);

      for (var i = 0; i < ospiti.length; i++) {

        var ospiti = ospiti[i];
        var finalHTML1 = compiled(ospiti);
        container.append(finalHTML1);
      }
    }
  });

}

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
  ospitiList();
}

$(document).ready(init);
