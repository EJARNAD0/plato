<?php
class User{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_file';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_user($username, $password, $lastname, $firstname, $access){
		// Check if username already exists
		$checkUsername = $this->conn->prepare("SELECT COUNT(*) FROM tbl_users WHERE username = :username");
		$checkUsername->execute([':username' => $username]);
		$usernameExists = $checkUsername->fetchColumn();
	
		if ($usernameExists > 0) {
			// If the username already exists, return an error or handle it as necessary
			throw new Exception("The username '$username' is already taken. Please choose a different username.");
		}
	
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
			[$lastname, $firstname, $username, $password, $NOW, $NOW, '1', $access],
		];
	
		$stmt = $this->conn->prepare("INSERT INTO tbl_users 
			(user_lastname, user_firstname, username, user_password, user_date_added, user_date_updated, user_status, user_access) 
			VALUES (?,?,?,?,?,?,?,?)");
	
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row) {
				$stmt->execute($row);
			}
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
			throw $e;
		}
	
		return true;
	}
	
	
	public function update_user($lastname,$firstname, $access, $id){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_users SET user_firstname=:user_firstname,user_lastname=:user_lastname,user_date_updated=:user_date_updated,user_access=:user_access WHERE user_id=:user_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_firstname'=>$firstname, ':user_lastname'=>$lastname,':user_date_updated'=>$NOW,':user_access'=>$access,':user_id'=>$id));
		return true;
	}
	public function list_users_search($keyword){
		
		//$keyword = "%".$keyword."%";

		$q = $this->conn->prepare('SELECT * FROM `tbl_users` WHERE `user_firstname` LIKE ?');
		$q->bindValue(1, "%$keyword%", PDO::PARAM_STR);
		$q->execute();

		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]= $r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	public function change_user_status($id,$status){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_users SET user_status=:user_status,user_date_updated=:user_date_updated, WHERE user_id=:user_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_status'=>$status,':user_date_updated'=>$NOW,':user_id'=>$id));
		return true;
	}

	public function change_username($id,$username){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_users SET username=:username,user_date_updated=:user_date_updated, WHERE user_id=:user_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':username'=>$username,':user_date_updated'=>$NOW,':user_id'=>$id));
		return true;
	}


	public function change_password($id,$password){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_users SET user_password=:user_password,user_date_updated=:user_date_updated,WHERE user_id=:user_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_password'=>$password,':user_date_updated'=>$NOW,':user_id'=>$id));
		return true;
	}
	
	public function list_users() {
		$sql = "SELECT * FROM tbl_users";
		$q = $this->conn->query($sql) or die("failed!");
	
		$data = []; // Initialize $data as an empty array
	
		while($r = $q->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $r;
		}
	
		if (empty($data)) {
			return false;
		} else {
			return $data;
		}
	}
	
  public function delete_user($id){
		$sql = "DELETE FROM tbl_users WHERE user_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':id', $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_id($username){
		$sql="SELECT user_id FROM tbl_users WHERE username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$user_id = $q->fetchColumn();
		return $user_id;
	}
	function get_username($id){
		$sql="SELECT username FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$username = $q->fetchColumn();
		return $username;
	}
	function get_user_firstname($id){
		$sql="SELECT user_firstname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_firstname = $q->fetchColumn();
		return $user_firstname;
	}
	function get_user_lastname($id){
		$sql="SELECT user_lastname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_lastname = $q->fetchColumn();
		return $user_lastname;
	}
	function get_user_access($id){
		$sql="SELECT user_access FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_access = $q->fetchColumn();
		return $user_access;
	}
	function get_user_status($id){
		$sql="SELECT user_status FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_status = $q->fetchColumn();
		return $user_status;
	}
	function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}else{
			return false;
		}
	}
	public function check_login($username,$password){
		
		$sql = "SELECT count(*) FROM tbl_users WHERE username = :username AND user_password = :password"; 
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username,'password' => ($password) ]);
		$number_of_rows = $q->fetchColumn();
        $password = ($password);
	
		if($number_of_rows == 1){
			
			$_SESSION['login']=true;
			$_SESSION['username']=$username;
			return true;
		}else{
			return false;
		}
	}
}