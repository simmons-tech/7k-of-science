<html>
	<?php
	include('globalsetup.php');
  	include('picasaFunctions.php');
  		setupHeader();
	?>
	
	<style>
	hr {color:sienna;}
	p {margin-left:20px;}
	body {background-color: #4D54D8;}
	#flip {background-color:  	#FFF040; }
	#flip2 {background-color:  	#FFF040;}
	#flip3 {background-color: #FFF040;}
	
	#label1 {background-color: #FF4040;}
	#label2 {background-color: #FF4040;}
	#label3 {background-color:  	#FF4040;}
	
	#flip a {background-color: #FF4040;}
	#flip2 a {background-color: #FF4040;}
	#flip3 a {background-color: #FF4040;}
	
	
</style>
	
	<script>
	  $(function(){
		$('#flip').jcoverflip();
	 	$('#flip2').jcoverflip();
	 	$('#flip3').jcoverflip();
	  });
	  
	  
	</script>
	
	<body>
	
	<h2>Pictures</h2>
	
	<?php
		
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
		showSliderUserPhotos(getDashboardDisplayItems());
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