<?php
class database {
  //private variables
  private $servername ="172.31.22.43";
  private $username = "Lakshya200520220";
  private $password = "H8W09JXsy4";
  private $database = "Lakshya200520220";
  public $connect;// a variable to connect with the databse

// contruct function to connect to the database
  public function __construct()

  {
    $this->connect = new mysqli($this->servername,$this->username,$this->password,$this->database);
    if(mysqli_connect_error())
    {
      trigger_error(message:"Failed to connect: " . mysqli_connect_error());

    }
    else
    {
      return $this->con;
    }
  }

  //this function is to insert data into the database
  public function insertData($post)
  {
    $fname = $this->con->real_escape_string($_POST['fname']);
    $lname = $this->con->real_escape_string($_POST['lname']);
    $username= $this->con->real_escape_string($_POST['username']);
    $password= $this->con->real_escape_string($_POST['password']);
    $bio= $this->con->real_escape_string($_POST['bio']);
    $query = "INSERT INTO profile(fname,lname, username,password, bio) VALUES('$fname','$lname','$username','$password','$bio')";
    $sql   =$this->con->query($query);
    if($sql == true){
      header(header:"Location: header.php?msg1=insert");
    }
    else{
      echo "Record could not be added";
    }
  }
  public function displayData(){
    $query = "SELECT * FROM profile";
    $results = $this->con->query($query);

    if($results->num_rows > 0)
    {
      $data = array();
      while($row = $results->fetch_assoc())
      {
        $data[] = $row;
      }
      return $data;
    }
    else
    {
      echo "No records found";
    }
  }

  // now fetch a single row form our table (read ans update function)
  public function displayRecordById($id){

    $query = "SELECT * FROM profile WHERE id = '$id'";
    $result = $this->con->query($query);
    if(result->num_rows > 0){
      $row = $results->fetch_assoc();
    }
    else{
      echo "No record found";
    }
  }

  // update fucntion to change the data
  public function updateRecord($postData){
    $fname   = $this->con->real_escape_string($_POST['ufname']);
    $lname  = $this->con->real_escape_string($_POST['ulname']);
    $username = $this->con->real_escape_string($_POST['uusername']);
    $password = $this->con->real_escape_string($_POST['upassword']);
    $bio = $this->con->real_escape_string($_POST['ubio']);
    $id     = $this->con->real_escape_string($_POST['id']);

    if(!empty($id) && !empty($postData)){
      $query = "UPDATE profile SET fname = '$fname',lname = '$lname', username ='$username' ,password= $password , bio='$bio' WHERE id='$id'";
      $sql = $this->con->query($query);
      if($sql == true){
        header(header: "Location:header.php?msg2=update");
      }
      else{
        echo " could not update the record";
      }
    }
  }
  //this is to delete the unwanted records
  public function deleteRecord($id){
    $query = "DELETE FROM profile WHERE id ='$id'";
    $sql = $this->con->query($query);

    if($sql == true){
      header(header: "Location:header.php?msg3:delete");
    }else{
      echo "Could not delete the record";
    }

?>
