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
            <table class="greenTable">
            <thead>
                <tr>
                    <th colspan="2">Average Rate</th>
                </tr>
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
           //$check = [];
            $stmt = $this->conn->prepare("SELECT * from View1_AverageRate");
            $stmt->execute();
            //$check[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //$stmt->setFetchMode(PDO::FETCH_ASSOC);
           $data = $stmt->fetchAll(PDO::FETCH_OBJ);
           //while($row = $stmt->fetch()){
           //        $fred[] = [$row['Prop_Type'], (int)$row['Avg_Prop_Rate']];
           //}
            //return($check);
           header('Content-Type:application/json');
           return $data;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
}
?>