<?
	//Grab All the form  elelements
	$FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $Age = $_POST['Age'];
    $SchoolId = $_POST['SchoolId'];

    /// This is an array of data values from muliple seclect and goes into the 
    $selectedOrgIds = $_POST['SelectedOrgs'];

    ///lets add the student to the students table to tge the new student ID
    //Just a fake connection for demo puposes using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    ///Prepare the post for student
    $sql = "INSERT INTO students (FirstName, LastName, Email, Age, ScoolId)
  	VALUES ($FirstName, $LastName, Email, Age, SchoolId)";
  	
  	//Execute above query 
  	$conn->exec($sql);

  	///now that the new student is in lets use the lastInsertId function to get the  last id
  	$newStudentID = $conn->lastInsertId();

  	////Now that i have the new student id above lets loop through and execute a insert into for the Orgs
  	foreach ($selectedOrgIds as $key) {
  		//Put the the key in variable 
  		$orgId = $key;

  		//Add the student id above to the array of the muliti select ill add a new row for each item chosen 
  		$sqlOrgs = "INSERT INTO OrgAssignment (StudentOrgId, StudentId)
  		VALUES ($orgId, $newStudentID)";
  		//Execute above query 
  		$conn->exec($sqlOrgs);

  	}

?>

From the form the select has [] to give return that post in an array to loop through it 
<select name="SelectedOrgs[]" multiple class="form-control">
	<option value="6">Campus Public Radio</option>
	<option value="1">Debate Club</option>
	<option value="4">Student Union</option>
	<option value="5">Tennis Team</option>
	<option value="2">Triathlon Club</option>
	<option value="3">Writer's Assocation</option>
</select>