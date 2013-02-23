<?php

	include('globalsetup.php');
  	include('picasaFunctions.php');  	 
  	 
	$items = getDashboardDisplayItems();
	printDashboard($items);


function printDashboard($result) {
		//$counter = Purposefully not defined, so first value is blank instead of 1;
	
	while($row = mysql_fetch_array($result))
		  {
	//	$row['fileLocation']
		if($counter == 1) {
			$counter++;
		}
		
		echo '<div class="slide" id="res-event' . $counter . '">';
		echo '<img src="' . $row['fileLocation'] . '"></img>';
		echo '</div>';
	
		$counter++;
		}

}
  	 
 
				
				?>