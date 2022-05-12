<?php
  class WhitelistIP {
    // DB stuff
    private $conn;
    private $table = 'whitelist_ip';
    // Post Properties
    public $whitelist_ip_id;
    public $ip;
    public $country;
    public $city;
    public $postcode;
    public $status;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $update_by;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //checkIP
    public function check() {
      // Create query
      $query = '  SELECT * FROM ' . $this->table . '
                  WHERE ip = :ip AND status = 1';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind data
      $stmt->bindParam(':ip', $this->ip);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row) {
          return true;
      }
      return false;
    }

    //add
    public function add() {
      // Create query
      $query = 'INSERT INTO' . $this->table . '
                SET
                  ip = :ip,
                  country = :country,
                  city = :city,
                  postcode = :postcode,
                  created_by = :created_by,
                  updated_by = :updated_by';
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean dataType
      $this->ip = htmlspecialchars(strip_tags($this->ip));
      $this->country = htmlspecialchars(strip_tags($this->country));
      $this->city = htmlspecialchars(strip_tags($this->city));
      $this->postcode = htmlspecialchars(strip_tags($this->postcode));
      $this->created_by = htmlspecialchars(strip_tags($this->created_by));
      $this->update_by = htmlspecialchars(strip_tags($this->update_by));

      // Bind data
      $stmt->bindParam(':ip', $this->ip);
      $stmt->bindParam(':country', $this->country);
      $stmt->bindParam(':city', $this->city);
      $stmt->bindParam(':postcode', $this->postcode);
      $stmt->bindParam(':created_by', $this->created_by);
      $stmt->bindParam(':updated_by', $this->updated_by);

      if($stmt->execute()) {
          return true;
      }

      //print error
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    //add
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                  ip = :ip,
                  country = :country,
                  city = :city,
                  postcode = :postcode,
                  status = :status,
                  updated_at = :updated_at,
                  updated_by = :updated_by
                  WHERE user_id = :user_id';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind data
      $stmt->bindParam(':ip', $this->ip);
      $stmt->bindParam(':country', $this->country);
      $stmt->bindParam(':city', $this->city);
      $stmt->bindParam(':postcode', $this->postcode);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':updated_at', $this->updated_at);
      $stmt->bindParam(':updated_by', $this->updated_by);

      // Execute query
      if($stmt->execute()) {
          return true;
      }
      //print error
      printf("Error: %s.\n", $stmt->error);
      return false;
    }

  }
