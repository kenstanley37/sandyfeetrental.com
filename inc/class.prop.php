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
        <table id="reportTable" class="avgTable">
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
            <table id="reportTable" class="avgTable">
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
            <table id="reportTable" class="avgTable">
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
    } // end get_freq_renters
    
    public function get_prop_list(){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from property order by prop_num");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $number_of_rows = $stmt->rowCount();
            $output = '';
        $output .= '
            <select name="property" id="property_list">
                <option value=""></option>
        ';
        if($number_of_rows > 0)
        {
         $count = 0;
         foreach($result as $row)
         {
          $count ++; 
          $output .= '
            <option>'.$row["prop_num"].'</option>
          ';
         }
        }
        else
        {
         $output .= '
            <tr>
                <td colspan="7" align="center">No Data Found</td>
            </tr>
         ';
        }
        $output .= '</select>';
        echo $output;           
           
           
        }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    } // end get_freq_renters
    
    public function img_fetch($img_fetch){
        $query = "SELECT p.prop_num, pp.prop_pic_id, pp.prop_pic_name, pp.prop_pic_desc, pp.prop_pic_name, pp.prop_pic_link FROM prop_pics pp
        left join property p on pp.prop_id = p.prop_id
        WHERE p.prop_num = :img_fetch
        ORDER BY pp.prop_id, pp.prop_pic_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':img_fetch', $img_fetch);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $number_of_rows = $stmt->rowCount();
        $output = '';
        $output .= '
         <table class="table table-bordered table-striped">
            <tr>
                <th id="tbl-head" colspan="7">Property ID: '.$img_fetch.'</th>
            </tr>
            <tr>
                <th>Pic ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        ';
        if($number_of_rows > 0)
        {
         $count = 0;
         foreach($result as $row)
         {
          $count ++; 
          $output .= '
            <tr>
                <td>'.$row["prop_pic_id"].'</td>
                <td><a href="uploads/'.$row["prop_pic_name"].'"><img src="'.$row["prop_pic_link"].'" class="img-thumbnail" width="100" height="100" /></a></td>
                <td>'.$row["prop_pic_name"].'</td>
                <td>'.$row["prop_pic_desc"].'</td>
                <td><button type="button" class="btn btn-warning btn-xs edit" id="'.$row["prop_pic_id"].'">Edit</button></td>
                <td><button type="button" class="btn btn-danger btn-xs delete" id="'.$row["prop_pic_id"].'" data-image_name="'.$row["prop_pic_name"].'">Delete</button></td>
            </tr>
          ';
         }
        }
        else
        {
         $output .= '
            <tr>
                <td colspan="7" align="center">No Data Found</td>
            </tr>
         ';
        }
        $output .= '</table>';
        echo $output;
    }
    
    public function img_upload(){
        
    }
    
    public function img_edit(){
        
    }
    
    public function img_update(){
        
    }
    
    public function img_delete(){
        
    }
    
    
    
    
    

} // end class

?>