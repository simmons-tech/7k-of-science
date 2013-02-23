<html>
	<?php
	include('globalsetup.php');
  	include('picasaFunctions.php');
  		setupHeader();
	?>
	
	
	
	<script>
	  $(function(){
		$('#flip').jcoverflip();
	 	$('#flip2').jcoverflip();
	 	$('#flip3').jcoverflip();
	  });
	  
	  
	</script>
	
	<body>
	
	<h3>Pictures</h3>
	
	<?php
		
		print('<div id="controlButtons">');
		print("	<a href=\"addPicPopup.php\" onclick=\"javascript:void window.open('addPicPopup.php','1352593439001','width=500,height=350,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">");
		print('<img src="http://aux.iconpedia.net/uploads/1331050018396872710.png" alt="Add Image" height="42" width="42"> ');
		
		
		print("</a>
	<br/><br/>");
	
	//Editing button options
		if($isAdmin) {
			//Add admin controls
			//print('<div id="place2" ondrop="dropIt(event);" ondragover="event.preventDefault();">');
			//print("<b>Trash</b>");
			//print("</div>");	
		}
		
		print("</div>");
		
		echo("<h3>Active Photos</h3>");
		
		echo '<div class="wrapper">
    		<ul id="flip" class="theslider">';
		showSliderUserPhotos(getActiveDisplayItems());
      	echo '</ul>
	    </div>';
	    //showUserPhotos(getActiveDisplayItems());
	
		echo("<h3>My Photos</h3>");
	 	//showUserPhotos(getDisplayItemsOf($myusername));
	 	
	 	echo '<div class="wrapper">
    		<ul id="flip2" class="theslider">';
		showSliderUserPhotos(getDisplayItemsOf($myusername));
      	echo '</ul>
	    </div>';
		
		echo("<h3>All Photos</h3>");
	 	//showUserPhotos(getDisplayItems());
	 	echo '<div class="wrapper">
    		<ul id="flip3" class="theslider">';
		showSliderUserPhotos(getDisplayItems());
      	echo '</ul>
	    </div>';
	    
	 ?>
	
	<br/>
	
	
	
	</body>
</html>