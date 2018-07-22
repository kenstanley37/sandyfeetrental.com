<?php

require_once('dbconfig.php');

class PROP
{	

	private $conn;
    private $avg_rate;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
        //header('Content-Type:application/json');
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
public function avg_rate(){
   try
    {
        $stmt = $this->conn->prepare("SELECT * from View1_AverageRate");
        $stmt->execute();
       ?> 
        <table class="avgTable">
        <thead>
            <tr>
                <th>Property</th>
                <th>Average Rate</th>
            </tr>    
        </thead>
        <tbody>
        <?php
        while ($row = $stmt->fetch()) {
            //$avg_rate[] = array($row['Prop_Type'],$row['Avg_Prop_Rate']);
            ?>
            <tr>
                <td><?php echo $row['Prop_Type']."<br />\n"; ?></td>
                <td>$<?php echo $row['Avg_Prop_Rate']."<br />\n"; ?></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
        </table> 

        <?php
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
    
    public function avg_rate_array(){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from View1_AverageRate");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(!headers_sent()){
               header('Content-Type:application/json');
           }
            return $data;
           if (headers_sent()) {
              foreach (headers_list() as $header)
                header_remove($header);
            }
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }    
    
    public function no_rent(){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from View2_non_user");
            $stmt->execute();
           ?> 
            <table class="avgTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Stree Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Phone</th>
                    <th>E-Mail</th>
                </tr>    
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch()) {
                //$avg_rate[] = array($row['Prop_Type'],$row['Avg_Prop_Rate']);
                ?>
                <tr>
                    <td><?php echo $row['First_Name']."<br />\n"; ?></td>
                    <td><?php echo $row['Last_Name']."<br />\n"; ?></td>
                    <td><?php echo $row['Street']."<br />\n"; ?></td>
                    <td><?php echo $row['City']."<br />\n"; ?></td>
                    <td><?php echo $row['State']."<br />\n"; ?></td>
                    <td><?php echo $row['Zip']."<br />\n"; ?></td>
                    <td><?php echo $row['Phone']."<br />\n"; ?></td>
                    <td><?php echo $row['Email']."<br />\n"; ?></td>
                </tr>
               
                <?php
            }
            ?>
            </tbody>
            </table> 
            
            <?php
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
    
    public function get_no_rent(){
       try
		{
            $stmt = $this->conn->prepare("SELECT State, count(*) as count from View2_non_user group by state");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
           if(!headers_sent()){
               header('Content-Type:application/json');
           }
            return $data;
           if (headers_sent()) {
              foreach (headers_list() as $header)
                header_remove($header);
            }
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
    
    public function freq_renters(){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from View3_most_frequent_users");
            $stmt->execute();
           ?> 
            <table class="avgTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Times Rented</th>
                </tr>    
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch()) {
                //$avg_rate[] = array($row['Prop_Type'],$row['Avg_Prop_Rate']);
                ?>
                <tr>
                    <td><?php echo $row['First_Name']."<br />\n"; ?></td>
                    <td><?php echo $row['Last_Name']."<br />\n"; ?></td>
                    <td><?php echo (int)$row['Times_Rented']."<br />\n"; ?></td>
                </tr>
               
                <?php
            }
            ?>
            </tbody>
            </table> 
            
            <?php
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
    
    public function get_freq_renters(){
       try
		{
            $stmt = $this->conn->prepare("SELECT concat(First_Name,' ,',Last_Name) as Name, Times_Rented from View3_most_frequent_users");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
           if(!headers_sent()){
               header('Content-Type:application/json');
           }
            return $data;
           if (headers_sent()) {
              foreach (headers_list() as $header)
                header_remove($header);
            }
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
    
    
    
    
    
    
    
    

} // end class

?>