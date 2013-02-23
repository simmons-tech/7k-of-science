<html>
	<body>
	<?php
	include('globalsetup.php');
	setupHeader();
	
  	showSimmonsUsers(getUsers());
	
	//If this is an update of the form
	if($_POST['admin'] != NULL) {
		//Update the database
		$newAdmins = $_POST['admin'];
		$newResidents = $_POST['resid'];
		
		setCreds($newAdmins, $newResids);
		
	}
	
	//showDisplayItemTable(getDisplayItems());
	
	?>
	
	</body>
</html>

<?php
	


function showSimmonsUsers($result) {
	global $isAdmin;

	echo ("<h2>Simmons Users of Database</h2>");
	echo "<table border='1'>
	<tr>
	<th>Id</th>
	<th>Username</th>
	<th>Name</th>
	<th>isAdmin</th>
	<th>isResident</th>
	</tr>";
	
	while($row = mysql_fetch_array($result))
	  {
	  $uname = $row['username'];
	  $userLookup = "userLookup.php?uname=$uname";
		  //print($userLookup);
	  
	  echo "<tr>";
	  echo "<td>" . $row['id'] . "</td>";
	  echo "<td>" . getPopupLink($row['username'], $userLookup) . "</td>";
	  echo "<td>" . $row['name'] . "</td>";
	  
	  echo "<td class='tableImg'>" . getBinaryImage($row['isAdmin']) . "</td>";
	  echo "<td class='tableImg' >" . getBinaryImage($row['isResident']) . "</td>";
	  echo "</tr>";
	  }
	
	echo "</table>";
	
  }

?>