<?php

  include "databaseInfo.php";

  class Prenotazione {

    private $id;
    private $stanza_id;
    private $configurazione_id;
    private $create_at;

    public function __construct($id, $stanza_id, $configurazione_id, $create_at) {

      $this->id = $id;
      $this->stanza_id = $stanza_id;
      $this->configurazione_id = $configurazione_id;
      $this->create_at = $create_at;
    }

    public function setId() {

      $this->id = $id;
    }
    public function setStanzaId() {

      $this->stanza_id = $stanza_id;
    }

    public function getId() {

      return $this->id;
    }
    public function getStanzaId() {

      return $this->stanza_id;
    }

    public function getAsArray() {

      return [
        "id" => $this->id,
        "stanza_id" => $this->stanza_id,
        "configurazione_id" => $this->configurazione_id,
        "create_at" => $this->create_at
      ];
    }

    public static function getAllPrenotazioni($conn) {

      $sql = "

      SELECT *
      FROM prenotazioni
      WHERE created_at > '2018-05-01 00:00:00'
        AND created_at <'2018-06-01 00:00:00'
      ORDER BY id DESC

      ";
      $result = $conn->query($sql);


      // var_dump($sql); die();

      if ($result->num_rows > 0) {
        $prenotazioni = [];
        while($row = $result->fetch_assoc()) {
          $prenotazioni[] =
              new Prenotazione($row["id"],
                               $row["stanza_id"],
                               $row["configurazione_id"],
                               $row["created_at"]);
        }
      }

      return $prenotazioni;
    }
  }
  class Stanza {

    private $id;
    private $room_number;
    private $floor;
    private $beds;

    function __construct($id, $room_number, $floor, $beds) {

      $this->id = $id;
      $this->room_number = $room_number;
      $this->floor = $floor;
      $this->beds = $beds;
    }

    function setId() {

      $this->id = $id;
    }
    function setRoomNumber() {

      $this->room_number = $room_number;
    }
    function setFloor() {

      $this->floor = $floor;
    }
    function setBeds() {

      $this->beds = $beds;
    }

    function getId() {

      return $this->id;
    }
    function getRoomNumber() {

      return $this->room_number;
    }
    function getFloor() {

      return $this->floor;
    }
    function getBeds() {

      return $this->beds;
    }

    public static function getStanzaById($conn, $id) {

      $sql = "

        SELECT *
        FROM stanze
        WHERE id = $id

      ";

      $result = $conn->query($sql);

      // var_dump($sql); die();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stanza = new Stanza(
                      $row["id"],
                      $row["room_number"],
                      $row["floor"],
                      $row["beds"]);

        return $stanza;
      }
    }
  }
  class Configurazione {

    private $id;
    private $title;
    private $description;
    private $created_at;

    function __construct($id, $title, $description, $created_at) {

      $this->id = $id;
      $this->title = $title;
      $this->description = $description;
      $this->created_at = $created_at;
    }

    function setIdC() {

      $this->id = $id;
    }
    function setTitle() {

      $this->title = $title;
    }
    function setDescription() {

      $this->description = $description;
    }
    function setCreated() {

      $this->create_at = $created_at;
    }

    function getIdC() {

      return $this->id;
    }
    function getTitle() {

      return $this->title;
    }
    function getDesciption() {

      return $this->description;
    }
    function getCreated() {

      return $this->created_at;
    }

    public static function getConfigurazioneById($conn, $id) {

      $sql = "

        SELECT *
        FROM configurazioni
        WHERE id = $id

      ";

      $result = $conn->query($sql);

      // var_dump($sql); die();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $configurazione = new Configurazione(
                      $row["id"],
                      $row["title"],
                      $row["description"],
                      $row["create_at"]);

        return $configurazione;
      }
    }
  }

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_errno) {

    echo $conn->connect_error;
    return;
  }

  // var_dump($conn); die();

  $prenotazioni = Prenotazione::getAllPrenotazioni($conn);

  foreach ($prenotazioni as $prenotazione) {

    $stanza_id = $prenotazione->getStanzaId();
    $configurazione_id = $prenotazione->getConfigurazioneById();
    $stanza = Stanza::getStanzaById($conn, $stanza_id);
    $configurazione = Configurazione::getConfigurazioneById($conn, $configurazione_id);

    echo "Prenotazione: " . $prenotazione->getId() . "<br>" .
          "-Stanza : " .  $stanza->getId() . " ; " .$stanza->getRoomNumber() . " ; " . $stanza->getFloor() ." ; " . $stanza->getBeds() . "<br>--> " .
          "<br><br>";
          "-Configurazione : " .  $configurazione->getIdC() . " ; " .$configurazione->getTitle() . " ; " . $configurazione->getDesciption() ." ; " . $configurazione->getCreated() . "<br>--> " .
          "<br><br>";
  }

 ?>
