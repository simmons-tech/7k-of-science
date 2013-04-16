<html>
	<?php
	include('globalsetup.php');
  	include('picasaFunctions.php');
  		setupHeader();
  		
	?>
	

<script language="JavaScript1.2">

var howOften = <?php printHowOftenAdvance() ?>; //number often in seconds to rotate
var current = 0; //start the counter at 0
var ns6 = document.getElementById&&!document.all; //detect netscape 6


// place your images, text, etc in the array elements here

var items = new Array();

<?php 
$items = getDisplayDisplayItems();
printLiveDisplayItemArray($items);
 ?>
   
function rotater() {
    document.getElementById("placeholder").innerHTML = items[current];
    current = (current==items.length-1) ? 0 : current + 1;
    setTimeout("rotater()",howOftenAdvance);
}

function rotater() {
    if(document.layers) {
        document.placeholderlayer.document.write(items[current]);
        document.placeholderlayer.document.close();
    }
    if(ns6)document.getElementById("placeholderdiv").innerHTML=items[current]
        if(document.all)
            placeholderdiv.innerHTML=items[current];

    current = (current==items.length-1) ? 0 : current + 1; //increment or reset
    setTimeout("rotater()",howOftenAdvance);
}
window.onload=rotater;
//-->
</script>

<body id="fullscreenbody">

<layer id="placeholderlayer"></layer><div id="placeholderdiv"></div>
</body>