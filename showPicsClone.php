<html>
	<?php
//	phpinfo();
//	exit();
	
	include('globalsetup.php');
  	include('picasaFunctions.php');
  		setupHeader();
	?>
	
	<script>
	  
	  //alert("Preshifted");
	  
	  //$(window).load(function() {
	  $(document).ready(function() {
	  	$('#flip').jcoverflip();
	 	$('#flip2').jcoverflip();
	 	$('#flip3').jcoverflip();
	  
	  	//alert("midshifted");
	  });
	  
	  //alert("Postshifted");
	  
	</script>
	
	<body>
	
	<h2>Simmons 7k Display Manager</h2>
	
	<?php
	printAdminStatus();
		
	printControlButtons();
	
	//Editing button options
		if($isAdmin) {
			//Add admin controls
			//print('<div id="place2" ondrop="dropIt(event);" ondragover="event.preventDefault();">');
			//print("<b>Trash</b>");
			//print("</div>");	
		}
		
		print("</div>
		<br/><br/>");
		echo '<div id="wrapper1">
			<div id="label1" class="label">Active Photos</div>
    		<ul id="flip" class="theslider">';
		showSliderUserPhotos(getDisplayDisplayItems());
      	echo '</ul>
	    </div>';
	    //showUserPhotos(getActiveDisplayItems());
	
	 	//showUserPhotos(getDisplayItemsOf($myusername));
	 	
	 	echo '<div id="wrapper2">
	 		<div id="label2" class="label">My Photos</div>
    		<ul id="flip2" class="theslider">';
		showSliderUserPhotos(getDisplayItemsOf($myusername));
      	echo '</ul>
	    </div>';
		
	 	//showUserPhotos(getDisplayItems());
	 	echo '<div id="wrapper3">
	    	<div id="label3" class="label">All Photos</div>
    		<ul id="flip3" class="theslider">';
		showSliderUserPhotos(getDisplayItems());
      	echo '</ul>
	    </div>';
	    
	 ?>
	
	<br/>
	
	
	
	</body>
</html>