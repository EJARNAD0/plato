<?php
class Notification {
    public function send($recipient, $title, $message) {
        // You would add your logic here to send the notification, e.g., insert into the database
        global $db;

        $query = "INSERT INTO notifications (recipient_id, title, message, timestamp) 
                  VALUES (:recipient, :title, :message, NOW())";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message', $message);
        
        return $stmt->execute();
    }
}
?>
