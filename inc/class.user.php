<?php
require_once('dbconfig.php');

class USER
{	

	private $conn;
    private $urank;
	
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
	
    public function fname(){
        if(isset($_SESSION['user_session'])){
            $user_id = $_SESSION['user_session'];
        
            $stmt = $this->conn->prepare("SELECT user_fName from user where user_id = '$user_id'");
            $stmt->execute();
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            $user_fname = $userRow['user_fName'];
            return $user_fname;
        }
        
    }
    
	public function register($ufname, $ulname, $ustreet, $ustate, $ucity, $uzip, $uphone, $umail, $upass, $ujoindate)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
            $utype = "renter";
			
			$stmt = $this->conn->prepare("INSERT INTO user(user_fName, user_lName, user_street, user_state, user_city, user_zip, user_phone, user_email, user_pass, user_type, joining_date) 
                   VALUES(:ufname, :ulname, :ustreet, :ustate, :ucity, :uzip, :uphone, :umail, :upass, :utype, :ujoindate)");
												  
			$stmt->bindparam(":ufname", $ufname);
			$stmt->bindparam(":ulname", $ulname);
            $stmt->bindparam(":ustreet", $ustreet);
            $stmt->bindparam(":ustate", $ustate);
            $stmt->bindparam(":ucity", $ucity);
            $stmt->bindparam(":uzip", $uzip);
            $stmt->bindparam(":uphone", $uphone);
            $stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
            $stmt->bindparam(":utype", $utype);
            $stmt->bindparam(":ujoindate", $ujoindate);
				
			$stmt->execute();	
			return $stmt;
            //return true;
            exit();
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
			$stmt = $this->conn->prepare("SELECT user_id, user_fName, user_email, user_pass, user_type FROM user WHERE user_email=:umail ");
			$stmt->execute(array(':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
                    $_SESSION['user_fName'] = $userRow['user_fName'];
                    $_SESSION['user_rank'] = $userRow['user_type'];
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
    
    public function check_rank()
    {
        if(isset($_SESSION['user_rank'])){
            $urank = $_SESSION['user_rank'];
            if($urank === "admin"){
            //$this->redirect('admin/index.php');
            return "admin";
            }else if($urank === "renter"){
                //$this->redirect('renter/index.php');
                return "renter";
            }else if($urank === "owner"){
                //$this->redirect('owner/index.php');
                return "owner";
            }
        } else {
            return "loggedout";
        }
        
    }
	
	public function redirect($url)
	{
        $this->doLogout();
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