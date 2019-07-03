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

    public function setId($id) {

      $this->id = $id;
    }
    public function setStanzaId($stanza_id) {

      $this->stanza_id = $stanza_id;
    }
    public function setConfigurazioneId($configurazione_id) {

      $this->configurazione_id = $configurazione_id;
    }
    public function setCreatedAt($create_at) {

      $this->created_at = $create_at;
    }

    public function getId() {

      return $this->id;
    }
    public function getStanzaId() {

      return $this->stanza_id;
    }
    public function getConfigurazioneId() {

      return $this->configurazione_id;
    }
    public function getCreatedAt() {

      return $this->create_at;
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

    function setId($id) {

      $this->id = $id;
    }
    function setRoomNumber($room_number) {

      $this->room_number = $room_number;
    }
    function setFloor($floor) {

      $this->floor = $floor;
    }
    function setBeds($beds) {

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

    function setIdC($id) {

      $this->id = $id;
    }
    function setTitle($title) {

      $this->title = $title;
    }
    function setDescription($description) {

      $this->description = $description;
    }
    function setCreated($created_at) {

      $this->created_at = $created_at;
    }


    function getIdC() {

      return $this->id;
    }
    function getTitle() {

      return $this->title;
    }
    function getDescription() {

      return $this->description;
    }
    function getCreated() {

      return $this->created_at;
    }


    public static function getConfigurazioneById($conn, $configurazione_id) {

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
                      $row["created_at"]);

        return $configurazione;

      }
    }
  }
  class Pagamento {

    private $id;
    private $status;
    private $price;

    function __construct($id, $status, $price) {

      $this->id = $id;
      $this->status = $status;
      $this->price = $price;
    }

    function setIdP($id) {

      $this->id = $id;
    }
    function setStatus($status) {

      $this->status = $status;
    }
    function setPrice($price) {

      $this->price = $price;
    }


    function getIdP() {

      return $this->id;
    }
    function getStatus() {

      return $this->status;
    }
    function getPrice() {

      return $this->price;
    }


    public static function getPagamentiById($conn, $pagamenti_id) {

      $sql = "

        SELECT *
        FROM pagamenti
        WHERE id = $id

      ";

      $result = $conn->query($sql);
      // var_dump($sql); die();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pagamento = new Pagamento(
                      $row["id"],
                      $row["status"],
                      $row["price"]);

        return $pagamento;
      }
    }
  }
  class Ospite {

    private $id;
    private $name;
    private $date_of_birth;
    private $lastname;
    private $document_type;
    private $document_number;

    function __construct($id, $name, $date_of_birth, $lastname, $document_type, $document_number) {

      $this->id = $id;
      $this->name = $name;
      $this->date_of_birth = $date_of_birth;
      $this->lastname = $lastname;
      $this->document_type = $document_type;
      $this->document_number = $document_number;
    }

    function setIdO($id) {

      $this->id = $id;
    }
    function setName($name) {

      $this->name = $name;
    }
    function setDateOfBirth($date_of_birth) {

      $this->date_of_birth = $date_of_birth;
    }
    function setLastName($lastname) {

      $this->lastname = $lastname;
    }
    function setDocumentType($document_type) {

      $this->document_type = $document_type;
    }
    function setDocumentNumber($document_number) {

      $this->document_number = $document_number;
    }


    function getIdO() {

      return $this->id;
    }
    function getName() {

      return $this->name;
    }
    function getDateOfBirth() {

      return $this->date_of_birth;
    }
    function getLastName() {

      return $this->lastname;
    }
    function getDocumentType() {

      return $this->document_type;
    }
    function getDocumentNumber() {

      return $this->document_type;
    }


    public static function getOspiteById($conn, $ospiti_id) {

      $sql = "

      SELECT *
      FROM prenotazioni_has_ospiti
      JOIN ospiti
        ON prenotazioni_has_ospiti.ospite_id = ospiti.id
      WHERE prenotazione_id = $prenotazione_id
      ";

      $result = $conn->query($sql);

      // var_dump($sql); die();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ospite = new Ospite(
                      $row["id"],
                      $row["name"],
                      $row["date_of_birth"],
                      $row["lastname"],
                      $row["document_type"],
                      $row["document_number"]);

        return $ospite;
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
  $configurazione_id = $prenotazione->getConfigurazioneId();
  $pagamenti_id = $prenotazione->getId();
  $ospiti_id = $prenotazione->getId();

   $stanza = Stanza::getStanzaById($conn, $stanza_id);
   $configurazione = Configurazione::getConfigurazioneById($conn, $configurazione_id);
   $pagamente = Pagamento::getPagamentiById($conn, $pagamenti_id);
   $ospite = Ospite::getOspiteById($conn, $ospiti_id);

   echo "Prenotazione: " . $prenotazione->getId() . "<br>" .
          "-Stanza : " .  $stanza->getId() . " ; " .$stanza->getRoomNumber() . " ; " . $stanza->getFloor() ." ; " . $stanza->getBeds() . "<br>--> ".
          "<br><br>";
          "-Configurazione : " .  $configurazione->getIdC() . " ; " .$configurazione->getTitle() .  "<br>--> " .
          "<br><br>";
          "-Pagamento : " .  $pagamento->getIdP() . " ; " .$pagamento->getStatus() . " ; " . $pagamento->getPrice() ." ; "  . "<br>--> " .
          "<br><br>";
          "-Ospite : " .  $ospite->getIdO() . " ; " .$ospite->getName() . " ; " . $ospite->getDateOfBirth() ." ; "  .$ospite->getLastName() ." ; ".$ospite->getDocumentType() ." ; ".$ospite->getDocumentNumber() ."<br>--> " .
          "<br><br>";
  }

 ?>
