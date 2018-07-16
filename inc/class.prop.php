<?php

require_once('dbconfig.php');

class PROP
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($ufname, $ulname, $ustreet, $ustate, $uzip, $uphone, $umail, $upass, $ujoindate)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
            $utype = "renter";
			
			$stmt = $this->conn->prepare("INSERT INTO user(user_fName, user_lName, user_street, user_state, user_zip, user_phone, user_email, user_pass, user_type, joining_date) 
                   VALUES(:ufname, :ulname, :ustreet, :ustate, :uzip, :uphone, :umail, :upass, :utype, :ujoindate)");
												  
			$stmt->bindparam(":ufname", $ufname);
			$stmt->bindparam(":ulname", $ulname);
            $stmt->bindparam(":ustreet", $ustreet);
            $stmt->bindparam(":ustate", $ustate);
            $stmt->bindparam(":uzip", $uzip);
            $stmt->bindparam(":uphone", $uphone);
            $stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
            $stmt->bindparam(":utype", $utype);
            $stmt->bindparam(":ujoindate", $ujoindate);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_email, user_pass FROM user WHERE user_email=:umail ");
			$stmt->execute(array(':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>