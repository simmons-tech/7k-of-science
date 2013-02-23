<?php
	$sqlusername="adat";
	$sqlpassword="MySQLPass!";
	$sqldatabase="adat+simmons";
	$sqlserver = "sql.mit.edu";
	$myname = $_SERVER['SSL_CLIENT_S_DN_CN'];
	$myemail = $_SERVER['SSL_CLIENT_S_DN_Email'];
	$myusername = substr($myemail, 0, strpos($myemail, "@"));
	$isResident = 0;
	$isAdmin = 0;

	//print("Started global<br/>");
	checkPrivs();
	//print("Privs checked<br/>");
	
	$userList = getUsers();
	
			
	checkForNewUser($userList);
	
	//showSimmonsUsers(getUsers());

function setupHeader() {
	print('<head>
	<title>Simmons Display</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	
	<script type="text/javascript" src="Libraries/jquery.js"></script>
	<script type="text/javascript" src="Libraries/jquery.ui.js"></script>
	<script type="text/javascript" src="Libraries/jquery.jcoverflip.js"></script>
	
	</head>');
}


function setupDatabase() {
	global $sqlserver, $sqlusername, $sqlpassword, $sqldatabase;

	$con = mysql_connect($sqlserver, $sqlusername, $sqlpassword);
	
	if (!$con) {
  		die('Could not connect: ' . mysql_error());
  	}
  	@mysql_select_db($sqldatabase) or die( "Unable to select database");
}

function getUsers() {
	checkDBConnection();
	return mysql_query("SELECT * FROM User ORDER BY id");
}

function getUser($un) {
	checkDBConnection();
	return mysql_query("SELECT * FROM User WHERE `username` = '$un'");
}

function getDisplayItem($id) {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem WHERE `id` = '$id'");
}

function checkPrivs() {
	global $myusername, $isAdmin, $isResident;

	checkDBConnection();
	$stuff = mysql_query("SELECT `isAdmin` , `isResident` FROM `User` WHERE `username` = '$myusername'");

	while($row = mysql_fetch_array($stuff))
	  {
		  $isAdmin = $row['isAdmin'];
		  $isResident = $row['isResident'];		  
	  }
	
	return;
}

function getDisplayItems() {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem ORDER BY timeCreated DESC");
}

function getDisplayItemsOf($un) {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem WHERE ownerUsername='" . $un . "' ORDER BY timeCreated DESC");
}

function getDashDisplayItems() {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem WHERE onDash='1' ORDER BY timeCreated DESC");
}

function getDisplayDisplayItems() {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem WHERE onDisplay='1' ORDER BY timeCreated DESC");
}

function getDashboardDisplayItems() {
	checkDBConnection();
	return mysql_query("SELECT * FROM DisplayItem WHERE onDash='1' ORDER BY timeCreated DESC");
}



function checkDBConnection() {
	global $con;
	if($con == NULL) {
		setupDatabase();
	}
}

function closeDatabase() {
	mysql_close($con);
}

function checkForNewUser($users) {
	global $myusername, $myname;
	checkDBConnection();
	$users = mysql_query("SELECT * FROM User WHERE username='" . $myusername . "'");

	while($row = mysql_fetch_array($users))
	  {
		  //echo "" . $row['username'] . "<br/>";
		  if($myusername == $row['username']) {	
		  	//echo("Gotcha");	
		  	return;
		  } 
	  
	  }
  	print('<script> window.alert("Welcome to the Simmons Display Database for the first time, ' . $myname .'!"); </script>');
  	
  	
  	//print('<script> window.alert("Is it alright if I just call you ' . substr($myname, 0, strpos($myname, " ")) .'? Thanks bro."); </script>');
  	
  	$search = $myusername;
	$string = file_get_contents("residents.txt");
	$string = explode("\n", $string); // \n is the character for a line break
	if(in_array($search, $string)){
		$isResident = 1;
		
		print('<script> window.alert("You are listed as a resident, congratulations"); </script>');
		
		//print("You are so a resident");
	} else {
		$isResident = 0;
		print('<script> window.alert("Watchu doing? You are not listed as a resident..."); </script>');
		
		//print("Watchu doing? You are not listed as a resident...");
	}
  	
  	
	createNewUser($isResident);
}

function createNewUser($isRes) {
	global $myname, $myusername, $isAdmin, $isResident;
	
	checkDBConnection();
	$users = mysql_query("INSERT INTO User(username, name, isAdmin, isResident) VALUES('$myusername', '$myname', 0, $isRes)");
	
}

function createNewDisplayItem($file, $thumb) {
	global $myusername;
	
	checkDBConnection();
	
	$myquery = "INSERT INTO DisplayItem(ownerUsername, fileLocation, thumbLocation, onDisplay, onDash, duration, doesExist) VALUES('$myusername', '$file', '$thumb', 0, 0, 60, 1)";
	
	$display = mysql_query($myquery);
	
	closeAndReloadParent();	
}
  
function getMultiCheckboxText($un, $category, $value) {

	$text =  '<input type="checkbox" name="' . $category . '[]" ';
	$text = $text . 'value="' . $un  . '" ';
	
	if($value == 1) {$text = $text . 'checked="checked"';} 
	$text = $text . ' />';
	//$text = $text . "My value is " . $value;
	return $text;
}

function getCheckboxText($category, $value) {

	$text =  '<input type="checkbox" name="' . $category . '" ';
	$text = $text . 'value="' . '1'  . '" ';
	
	if($value == 1) {$text = $text . 'checked="checked"';} 
	$text = $text . ' />';
	//$text = $text . "My value is " . $value;
	return $text;
}

function editUser($name, $username, $isAdmin, $isResident) {
	checkDBConnection();
	
	$myquery = "UPDATE User SET name='$name', isAdmin='$isAdmin', isResident='$isResident' WHERE username = '$username'";
	
	$display = mysql_query($myquery);
	//print($display);
}

function editDisplayItem($editId, $editOnDisplay, $editOnDashboard) {
	checkDBConnection();
	
	$myquery = "UPDATE DisplayItem SET onDisplay='$editOnDisplay', onDash='$editOnDashboard' WHERE id = '$editId'";
	
	$display = mysql_query($myquery);

}

function showDisplayItemTable($result) {

	print("<head>
	<title>Display Items</title>
	</head>");
	echo ("Displays");
	echo "<table border='1'>
	<tr>
	<th>Id</th>
	<th>ownerUsername</th>
	<th>fileLocation</th>
	<th>thumbLocation</th>
	<th>OnDisplay</th>
	<th>Duration</th>
	<th>doesExist</th>
	<th>timeCreated</th>
	</tr>";
	
	while($row = mysql_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['id'] . "</td>";
	  echo "<td>" . $row['ownerUsername'] . "</td>";
	  echo "<td>" . $row['fileLocation'] . "</td>";
	  echo "<td>" . $row['thumbLocation'] . "</td>";
	  echo "<td>" . getTextOf($row['onDisplay']) . "</td>";
	  echo "<td>" . $row['duration'] . "</td>";
	  echo "<td>" . getTextOf($row['doesExist']) . "</td>";
	  echo "<td>" . $row['timeCreated'] . "</td>";
	  
	  echo "</tr>";
	  }
	echo "</table>";
	
	//var_dump($user);
  }

function getTextOf($binaryValue) {
	if($binaryValue) { 
		return "Yes"; 
	} else {	
		return "No";
	} 
}

function closeAndReloadParent() {
	//return;
	print("<br/>Successfully inserted!");
	
	
	print("<script type=\"text/javascript\">
		   opener.location.href = unescape(opener.location.pathname);
		   //opener.location.reload(true);
		   self.close();
		</script>");
	//	*/
	
	//window.location = location.href;
	
	/*
	print("<script type=\"text/javascript\">
		   opener.location.reload(true);
		   self.close();
		</script>");
	//	*/
		
}

function showSliderUserPhotos($result) {
	global $myusername;


	while($row = mysql_fetch_array($result))
		  {
	
		$url = 'picLookup.php?picId=' . $row['id'];
		
		echo '<li>';

		
		//Image
		echo '<img src="' . $row['thumbLocation'] . '" alt="Pic" />
		';
		echo '<span class="title">';
		echo '<a href="' . $url . '" class="editLink"  
		';
		
		//Link javascript popup
		echo  'onclick="javascript:void window.open(\'' . $url . '\',\'1352593439021\',\'width=400,height=350,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0\');return false;">';
		
		echo "Edit " . $row['title'] . "</a>
		
		";
		
		echo "";
		//Insert title here
		
		
		echo'</span></li>';
	
	  }
}

function showUserPhotos($result) {
	global $myusername;

while($row = mysql_fetch_array($result))
	  {
	  //echo "<tr>";
	  //echo "<td>" . $row['id'] . "</td>";
	  //echo "<td>" . $row['ownerId'] . "</td>";
	  //echo "<td>" . $row['fileLocation'] . "</td>";

	$url = 'picLookup.php?picId=' . $row['id'];
	//print($url);
	
	echo '<a href="' . $url . '" onclick="javascript:void window.open(\'' . $url . '\',\'1352593439021\',\'width=500,height=350,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0\');return false;">';
	  echo '<img src="' . $row['thumbLocation'] . '" alt="Pic" draggable="true" ondragstart="dragIt(event);" >';
	
	echo('</a>');
	
	//echo '<input type="image" src="' . $row['thumbLocation'] . '" name="image">';
	  
	  //echo "<td>" . getTextOf($row['onDisplay']) . "</td>";
	  //echo "<td>" . $row['duration'] . "</td>";
	  //echo "<td>" . getTextOf($row['doesExist']) . "</td>";
	  //echo "<td>" . $row['timeCreated'] . "</td>";
	  
	  //echo "</tr>";
	  }
	
	
	//var_dump($user);

	
  }


function getLink($text, $url) {
	return '<a href="' . $url . '">' . $text . '</a> ';
}

function getPopupLink($text, $url) {
	return '<a class="popup" href="' . $url . '" onclick="javascript:void window.open(\'' . $url . '\',\'1352593439021\',\'width=300,height=200,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0\');return false;">' . $text . '</a>';
}


function getBinaryImage($value) {
	if($value) {
		return '<img src="img/yes_check.png" alt="Yes" height="10" width="10">';
	} else {
		return '<img src="img/no_check.gif" alt="No" height="10" width="10">';	
	}
}

function printLiveDisplayItemArray($result) {
	$counter = 0;

	while($row = mysql_fetch_array($result)) {

		$width = 7280;
		$height = 1920;

		  echo "items[" . $counter . ']="';
		  echo "<a href='' ><img alt='Please contact Simmons Tech'";
		  echo " src='" . $row['fileLocation'] . "' height='" . $height . "' width='" . $width . "' border='0' />";
		  echo'</a>";
	  
		  ';

	$counter++;
	  }

}

function printLiveDisplaySection($result, $section) {
$counter = 0;

	while($row = mysql_fetch_array($result))
	  {
		//Print the piece in the rotating image section
		
		$width = 7280;
		$height = 1920;
		
		echo "items[" . $counter . ']="';
		echo "<img id='s" . $section . "' alt='Please contact Simmons Tech'";
		echo " src='" . $row['fileLocation'] . "' height='" . $height . "' width='" . $width . "' border='0' />";
		echo'";
		
		';
		
		$counter++;
	  }

}

function printHowOftenAdvance() {
	echo "30000";
	//Every 30 seconds
}

function printHowOftenUpdate() {
	echo "600000";
	//Every 10 minutes
}

function printControlButtons() {
		print('<div id="controlButtons">');
		print("	<a href=\"addPicPopup.php\" onclick=\"javascript:void window.open('addPicPopup.php','1352593439001','width=500,height=150,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">");
		print('<img src="http://aux.iconpedia.net/uploads/1331050018396872710.png" alt="Add Image" height="42" width="42"> ');
		print("</a>");
}

function printAdminStatus() {
	global $isAdmin, $isResident;
	checkPrivs();
	
	if(isset($isAdmin) && $isAdmin) {
		print("<h3>Welcome back, Admin!</h3>
		");
	} else if(isset($isResident) && $isResident) {
		print("<h3>Welcome back, Simmmons Resident!</h3>
		");
	} else {
		print("Welcome, Guest!
		");
	}
	
}

?>