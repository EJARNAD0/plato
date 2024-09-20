<?php
class Request {
    private $DB_SERVER = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = '';
    private $DB_DATABASE = 'db_file';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=" . $this->DB_SERVER . ";dbname=" . $this->DB_DATABASE, $this->DB_USERNAME, $this->DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Insert new request
    public function new_request($user_id, $request_details){
        $sql = "INSERT INTO requests (user_id, request_details) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $request_details]);
    }

    // Update request
    public function update_request($request_id, $request_details, $request_status){
        $sql = "UPDATE requests SET request_details = ?, request_status = ? WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$request_details, $request_status, $request_id]);
    }

    // Delete request
    public function delete_request($request_id){
        $sql = "DELETE FROM requests WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$request_id]);
    }

    // Retrieve request by ID
    public function get_request_by_id($request_id){
        $sql = "SELECT * FROM requests WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$request_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve requests for a user
    public function get_requests_by_user($user_id){
        $sql = "SELECT * FROM requests WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve all requests
    public function get_all_requests(){
        $sql = "SELECT * FROM requests ORDER BY created_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
