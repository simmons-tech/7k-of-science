<html>
<?php 
	include('globalsetup.php');
	setupHeader();
	//print("is setup, user is $myusername<br/>");

	$picId = $_GET['picId'];

	if(isset($_POST['editId'])) {
			$picId = $_POST['editId'];
			submitUpdates();
			
			closeAndReloadParent();
		} 
	
	showPicDetail($picId);
	

function submitUpdates() {	
	//$santized = addslashes($unclean);
	
	$editId = 		$_POST['editId'];
	$editOnDisplay = 	$_POST['editOnDisplay'];
	$editOnDashboard = $_POST['editOnDashboard'];
	
	editDisplayItem($editId, $editOnDisplay, $editOnDashboard);
}

function showPicDetail($picId) {
	global $isAdmin;
	
	//Get the user's data
	$result = getDisplayItem($picId);
	
	
	while($row = mysql_fetch_array($result))
	  {
	  if($isAdmin >= 1) {
	  	print '<form name="input" action="picLookup.php" method="post">';
	  } else {print '<div class="popupText">';}
	  
	  echo "<b>Owner Username:</b> <br/>" . $row['ownerUsername'] . "<br/><br/>";
	  echo '<img src="' . $row['thumbLocation'] . '" alt="Pic" " >';
	  echo '<br/>';
	  
	  if(!$isAdmin) {
		echo "<b>Active?</b> <br/>" . getBinaryImage($row['onDisplay']) . "<br/><br/>";
	  } else {
		
		echo "<br/><br/>";
		echo "<b>Currently on 7k Display?</b> <br/>" . getCheckboxText("editOnDisplay", $row['onDisplay']) . "<br/><br/>";
		
		echo "<b>Currently on Dashboard?</b> <br/>" . getCheckboxText("editOnDashboard", $row['onDash']) . "<br/><br/>";
	  	
	  	echo '<input type="hidden" name="editId" value="' . $row['id'] . '" />';
	  		
	  }
	  
	  }
	if($isAdmin >= 1) {
	echo '<input type="submit" value="Submit Changes">
</form> '; } else {
		print "</div>";
}
	
}
	
	
?>

</html>

