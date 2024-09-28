<?php
class Request {
    private $DB_SERVER = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = '';
    private $DB_DATABASE = 'db_plato';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=" . $this->DB_SERVER . ";dbname=" . $this->DB_DATABASE, $this->DB_USERNAME, $this->DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Insert a new request
    public function new_request($user_id, $request_details){
        $sql = "INSERT INTO requests (user_id, request_details) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $request_details]);
    }

    // Update request details
    public function update_request($request_id, $request_details){
        $sql = "UPDATE requests SET request_details = ? WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$request_details, $request_id]);
    }

    // Update request status
    public function update_request_status($request_id, $request_status){
        $sql = "UPDATE requests SET request_status = ? WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$request_status, $request_id]);
    }

    // Delete request
    public function delete_request($request_id){
        $sql = "DELETE FROM requests WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$request_id]);
    }

    // Retrieve requests for a specific user
    public function get_requests_by_user($user_id){
        $sql = "SELECT r.request_id, r.request_details, r.request_status, r.created_at, tu.user_firstname, tu.user_lastname
                FROM requests r
                JOIN tbl_users tu ON r.user_id = tu.user_id
                WHERE r.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve all requests
    public function get_all_requests(){
        $sql = "SELECT r.request_id, r.request_details, r.request_status, r.created_at, tu.user_firstname, tu.user_lastname
                FROM requests r
                JOIN tbl_users tu ON r.user_id = tu.user_id
                ORDER BY r.created_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
