<html>
<?php 
	include('globalsetup.php');
	setupHeader();

	$username = $_GET['uname'];	

	if(isset($_POST['editUsername'])) {
		$username = $_POST['editUsername'];
		submitUpdates();
		
		closeAndReloadParent();
	} 
	
		showUserDetail($username);
	

function submitUpdates() {
	$editName = 		addslashes($_POST['editName']);
	$editUsername = 	addslashes($_POST['editUsername']);
	//Detect troublemakers
	
	$editIsAdmin = 		$_POST['editIsAdmin'];
	if(!isset($editIsAdmin)) {$editIsAdmin = 0;}
	$editIsResident = 	$_POST['editIsResident'];
	if(!isset($editIsResident)) {$editIsResident = 0;}
	
	editUser($editName, $editUsername, $editIsAdmin, $editIsResident);
}

function showUserDetail($un) {
	global $isAdmin;
	
	//Get the user's data
	$result = getUser($un);
	
	
	while($row = mysql_fetch_array($result))
	  {
	  print "<div class='popupText'>";
	  
	  if($isAdmin >= 1) {
	  	print '<form name="input" action="userLookup.php" method="post">';
	  }
	  
	  echo "<b>Username:</b> <br/>" . $row['username'] . "<br/>";

	  $_POST['editName'] = $row['name'];
	  $_POST['editUsername'] = $row['username'];
	  
	if(!$isAdmin) {
		echo "<b>Name:</b> <br/>" . $row['name'] . "<br/>";
		echo "<b>Admin?</b> <br/>" . getBinaryImage($row['isAdmin']) . "<br/>";
		echo "<b>Simmons Resident?</b> <br/>" . getBinaryImage($row['isResident']) . "<br/>";
	} else {
		echo'<b>Name: </b><br/>';
		echo ' <input title="Name: " id="editName" name="editName" type="text" value="' . 
				$row['name'] . '" /><br/>';
		
		echo "<b>Admin?</b> <br/>" . getCheckboxText("editIsAdmin", $row['isAdmin']) . "<br/>";
	  	echo "<b>Simmons Resident?</b> <br/>" . 
	  		getCheckboxText("editIsResident", $row['isResident']) . "<br/>";
	  	echo '<input type="hidden" name="editUsername" value="' . $row['username'] . '" />';
	  		
	  }
	  
	  }
	if($isAdmin >= 1) {
		echo '<input type="submit" value="Submit Changes">
			</form> ';
	} else {
	print '<br/>
		<a href="javascript:self.close()">Close</a>';
	}


print("</div>");
	
}



?>



</html>

