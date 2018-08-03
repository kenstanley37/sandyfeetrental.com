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
    /*
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
    */
    // Setup for Google
     public function get_freq_renters(){
       try
		{
            $stmt = $this->conn->prepare("SELECT concat(First_Name,' ,',Last_Name) as Name, Times_Rented from View3_most_frequent_users");
            $stmt->execute();
            //$result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(!headers_sent()){
               header('Content-Type:application/json');
           }

            while ($row = $stmt->fetch()) {
                $rows[]=array("c"=>array("0"=>array("v"=>$row['Name'],"f"=>NULL),"1"=>array("v"=>(int)$row['Times_Rented'],"f" =>NULL)));
            }
           echo $format = '{
            "cols":
            [
            {"id":"","label":"Name","pattern":"","type":"string"},
            {"id":"","label":"Rented","pattern":"","type":"number"}
            ],
            "rows":'.json_encode($rows).'}';
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    } // end get_freq_renters
    
    
    public function get_prop_list($building){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from property p left join building b on b.building_id = p.building_id where b.building_name = :building order by prop_num");
           
            $stmt->bindparam(":building", $building);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $number_of_rows = $stmt->rowCount();
            $output = '';
           
        if($number_of_rows > 0)
        {
         foreach($result as $row)
         {
          $output .= '
            <option value="'.$row["prop_id"].'">'.$row["prop_num"].'</option>
          ';
         }
        }
        else
        {

        }
        echo $output;           
           
           
        }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    } // end get_freq_renters
    
    
    public function get_build_list(){
       try
		{
            $stmt = $this->conn->prepare("SELECT * from building order by building_name");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $number_of_rows = $stmt->rowCount();
            $output = '';
           
        if($number_of_rows > 0)
        {
         foreach($result as $row)
         {
          $output .= '
            <option>'.$row["building_name"].'</option>
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
        echo $output;           
           
           
        }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    } // end get_freq_renters
    
    
    
    
    
    public function img_fetch($img_fetch){
        $query = "SELECT p.prop_id, p.prop_num, pp.prop_pic_id, pp.prop_pic_name, pp.prop_pic_desc, pp.prop_pic_name, pp.prop_pic_link FROM prop_pics pp
        left join property p on pp.prop_id = p.prop_id
        WHERE p.prop_id = :img_fetch
        ORDER BY pp.prop_pic_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':img_fetch', $img_fetch);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $number_of_rows = $stmt->rowCount();
        if(isset($result[0]['prop_num'])){
            $prop_num = $result[0]['prop_num'];
        } else {
            $prop_num = 'No Images';
        }
        $output = '';
        $output .= '
            <thead>
                <tr>
                    <th id="tbl-head" colspan="7">Property ID: '.$prop_num.'</th>
                </tr>
                <tr>
                    <th>Pic ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
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
                <td><a href="'.$row["prop_pic_link"].'"><img src="'.$row["prop_pic_link"].'" class="img-thumbnail" width="100" height="100" /></a></td>
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
        $output .= '
        </tbody>';
        echo $output;
    }
    
    public function img_upload($img_prop, $img_data){
        $directoryName = $img_prop;
        // check if property has it's own folder
        if(!is_dir($directoryName)){
            //if it doesn't have its own folder make one
            mkdir($directoryName, 0755);
        }
        
        //upload.php
        if(count($_FILES["file"]["name"]) > 0)
        {
            //$output = '';
            sleep(3);
            for($count=0; $count<count($_FILES["file"]["name"]); $count++)
            {
                $file_name = $_FILES["file"]["name"][$count];
                $tmp_name = $_FILES["file"]['tmp_name'][$count];
                $file_array = explode(".", $file_name);
                $file_extension = end($file_array);
                if(file_already_uploaded($file_name, $conn))
                {
                    $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
                }
                $location = 'uploads/'.$img_prop.'/' . $file_name;
                if(move_uploaded_file($tmp_name, $location))
                {
                    try
                    {
                        $query = "
                        INSERT INTO prop_pics (prop_id, prop_pic_name, prop_pic_desc, prop_pic_link) 
                        VALUES ('".$img_prop."', '".$file_name."', '', '')
                        ";
                        $statement = $conn->prepare($query);
                        $statement->execute();
                    }
                    catch(PDOException $e)
                    {
                        echo $e->getMessage();
                    }
                    
                }
            }
        }
    }
    
    
    public function file_already_uploaded($img_prop, $file_name, $conn)
        {

            $query = "SELECT * FROM prop_pocs WHERE prop_id = '".$img_prop."' and prop_pic_name = '".$file_name."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $number_of_rows = $statement->rowCount();
            if($number_of_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    
    public function img_edit(){
        
    }
    
    public function img_update(){
        
    }
    
    public function img_delete(){
        
    }
    
    
    
    
    

} // end class

?>