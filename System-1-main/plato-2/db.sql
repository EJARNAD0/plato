-- Drop the database if it exists and create a fresh one
DROP DATABASE IF EXISTS db_plato;
CREATE DATABASE db_plato;
USE db_plato;

-- Drop the `tbl_users` table if it exists
DROP TABLE IF EXISTS `tbl_users`;

-- Create `tbl_users` table
CREATE TABLE `tbl_users` (
  `user_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT, 
  `user_lastname` VARCHAR(180) NOT NULL,
  `user_firstname` VARCHAR(180) NOT NULL,
  `username` VARCHAR(180) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_access` VARCHAR(50) NOT NULL,
  `user_date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_date_updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_status` TINYINT(1) NOT NULL DEFAULT '0',
  `user_address` VARCHAR(255) DEFAULT NULL,  -- Address field for user's full address
  `user_city` VARCHAR(100) DEFAULT NULL,     -- City field for user's city
  UNIQUE (`username`),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4;


-- Drop the `user_feedback` table if it exists
DROP TABLE IF EXISTS `user_feedback`;

-- Create `user_feedback` table without AUTO_INCREMENT for user_id
CREATE TABLE `user_feedback` (
    `feedback_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(8) UNSIGNED NOT NULL,  
    `feedback` TEXT NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `tbl_users`(`user_id`) ON DELETE CASCADE,
    INDEX (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Drop the `transactions` table if it exists
DROP TABLE IF EXISTS `transactions`;

-- Create `transactions` table
CREATE TABLE `transactions` (
    `transaction_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(8) UNSIGNED NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `transaction_type` ENUM('received', 'sent') NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `tbl_users`(`user_id`) ON DELETE CASCADE,
    INDEX (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Drop the `notifications` table if it exists
DROP TABLE IF EXISTS `notifications`;

-- Create `notifications` table
CREATE TABLE `notifications` (
    `notification_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(8) UNSIGNED NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `tbl_users`(`user_id`) ON DELETE CASCADE,
    INDEX (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Drop the `requests` table if it exists
DROP TABLE IF EXISTS `requests`;

-- Create `requests` table
CREATE TABLE `requests` (
    `request_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(8) UNSIGNED NOT NULL,
    `request_details` TEXT NOT NULL,
    `request_status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `tbl_users`(`user_id`) ON DELETE CASCADE,
    INDEX (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
