function ospitiList() {

  var me = $(this);
  var id = me.data("id");
  $.ajax({

    url: "getOspitiList.php",
    data: { id:id },
    method: "POST",
    success: function(data) {

      var ospiti = JSON.parse(data);

      for (var i = 0; i < ospiti.length; i++) {

        var ospite = ospiti[i];
        me.find(".name_lastname").text(ospite["name"], ospite["lastname"]);
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
  $(document).on("click", ".prenotazione", ospitiList);
}

$(document).ready(init);
