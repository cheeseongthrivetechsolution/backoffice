<?php
  class Merchant {
    // DB stuff
    private $conn;
    private $table = 'merchant';
    // Post Properties
    public $merchant_id;
    public $code;
    public $name;
    public $logo;
    public $favicon;
    public $api_url;
    public $image_url;
    public $status;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $updated_by;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //Get Merchant info by Code
    public function getByCode() {
        // Create query
        $query = '  SELECT * FROM ' . $this->table . '
                    WHERE code = :code';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(':code', $this->code);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        if ($row) {
          $this->merchant_id = $row['merchant_id'];
          $this->code = $row['code'];
          $this->name = $row['name'];
          $this->logo = $row['logo'];
          $this->favicon = $row['favicon'];
          $this->api_url = $row['api_url'];
          $this->image_url = $row['image_url'];
          $this->status = $row['status'];
          $this->created_at = $row['created_at'];
          $this->created_by = $row['created_by'];
          $this->updated_at = $row['updated_at'];
          $this->updated_by = $row['updated_by'];
        }
    }

    //Get Merchant info by ID
    public function getByID() {
        // Create query
        $query = '  SELECT * FROM ' . $this->table . '
                    WHERE merchant_id = :merchant_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(':merchant_id', $this->merchant_id);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        if ($row) {
          $this->merchant_id = $row['merchant_id'];
          $this->code = $row['code'];
          $this->name = $row['name'];
          $this->logo = $row['logo'];
          $this->favicon = $row['favicon'];
          $this->api_url = $row['api_url'];
          $this->image_url = $row['image_url'];
          $this->status = $row['status'];
          $this->created_at = $row['created_at'];
          $this->created_by = $row['created_by'];
          $this->updated_at = $row['updated_at'];
          $this->updated_by = $row['updated_by'];
        }
    }




  }
