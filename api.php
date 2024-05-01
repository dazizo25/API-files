<?php 
 
require_once 'db_connect.php';
 
$response = array();
 
if(isset($_GET['apicall'])){
	 
  switch($_GET['apicall']){
 
  case 'view': 
    $sql = "SELECT * FROM Lead";
    $result=mysqli_query($conn, $sql);
    $leads = array();

    while($row = mysqli_fetch_array($result)){
	    $leads[] = $row;
    }

    mysqli_close($conn);
    $response['leads'] = $leads; 
    echo json_encode($response);
	
	case 'insert':
	  $source = $_POST['source'];
      $status = $_POST['status'];
      $typeoflead = $_POST['typeoflead'];

      //insert new lead in table Leads
      $query = "INSERT INTO Lead (source, status, type) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('sss', $source, $status, $typeoflead);
      $stmt->execute();

      if ($stmt->affected_rows > 0){
	    echo "<p>Lead inserted into database sucessfully.</p>";
      } else {
	    echo "<p>An error has occured.<br/>The item was not added.</p>";
      }
      $conn->close();

  case 'insert_contact':
    $companyName = $_POST['companyName'];
    $contactName = $_POST['contactName'];
    $title = $_POST['title'];
    $role = $_POST['role'];
    $phoneNumber = $_POST['phoneNumber'];
    $extensionNumber = $_POST['extensionNumber'];
    $mobileNumber = $_POST['mobileNumber'];
    $emailAddress = $_POST['emailAddress'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $postCode = $_POST['postCode'];
    $status = $_POST['status'];
    $annualRevenue = $_POST['annualRevenue'];

    $query = "INSERT INTO Contact (company_name, contact_name, title, role, phone_number, extension_number , mobile_number, email_address, street, city, county, postcode, status, annual_revenue)VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssssssssss', $companyName, $contactName, $title, $role, $phoneNumber, $extensionNumber, $mobileNumber, $emailAddress, $street, $city, $county, $postCode, $status, $annualRevenue);
    $stmt->execute();

    if ($stmt->affected_rows > 0){
	    echo "<p>contact inserted into database sucessfully.</p>";
      } else {
	    echo "<p>An error has occured.<br/>The item was not added.</p>";
      }
      $conn->close();


}
}
?>
