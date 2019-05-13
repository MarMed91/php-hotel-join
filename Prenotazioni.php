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

    public function getId() {

      return $this->id;
    }

    public function getStanzaId() {

      return $this->stanza_id;
    }

    public function getconfigurazioneId() {

      return $this->configurazione_id;
    }

    public function getCreateAt() {

      return $this->created_at;
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
      WHERE created_at > '2018-05-01'
        AND created_at <'2018-06-01
      ORDER BY created_at DESC
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

    function getRoomNumber() {

      return $this->room_number;
    }

    function getFloor() {

      return $this->floor;
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

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_errno) {

    echo $conn->connect_error;
    return;
  }

  // var_dump($conn); die();

  $prenotazioni = Prenotazione::getAllPrenotazioni($conn);

  foreach ($prenotazioni as $prenotazione) {

    $stanza_id = $prenotazione->getStanzaId();
    $stanza = Stanza::getStanzaById($conn, $stanza_id);

    echo "id: " . $prenotazione->getId() . "<br>" .
          "--> " . $stanza->getRoomNumber() . "<br>--> " . $stanza->getFloor() .
          "<br><br>";
  }

 ?>
