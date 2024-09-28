<?php
class Feedback {
    private $DB_SERVER = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = '';
    private $DB_DATABASE = 'db_plato';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=" . $this->DB_SERVER . ";dbname=" . $this->DB_DATABASE, $this->DB_USERNAME, $this->DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Insert new feedback
    public function new_feedback($user_id, $feedback){
        $sql = "INSERT INTO user_feedback (user_id, feedback) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $feedback]);
    }

    // Update feedback
    public function update_feedback($feedback_id, $feedback){
        $sql = "UPDATE user_feedback SET feedback = ? WHERE feedback_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$feedback, $feedback_id]);
    }

    // Delete feedback
    public function delete_feedback($feedback_id){
        $sql = "DELETE FROM user_feedback WHERE feedback_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$feedback_id]);
    }

    // Retrieve feedback for a user
    public function get_feedback_by_user($user_id){
        $sql = "SELECT uf.feedback_id, uf.feedback, uf.timestamp, tu.user_firstname, tu.user_lastname
                FROM user_feedback uf
                JOIN tbl_users tu ON uf.user_id = tu.user_id
                WHERE uf.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve all feedback
    public function get_all_feedback(){
        $sql = "SELECT uf.feedback_id, uf.feedback, uf.timestamp, tu.user_firstname, tu.user_lastname
                FROM user_feedback uf
                JOIN tbl_users tu ON uf.user_id = tu.user_id
                ORDER BY uf.timestamp DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>