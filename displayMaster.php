<html>
	<?php
	include('globalsetup.php');
  	include('picasaFunctions.php');
  		setupHeader();
	?>
	

<script language="JavaScript1.2">



var howOftenAdvance = <?php printHowOftenAdvance() ?>; //number often in seconds to rotate
var howOftenUpdate = <?php printHowOftenUpdate() ?>; //number often in seconds to rotate

var current = 0; //start the counter at 0
var ns6 = document.getElementById&&!document.all; //detect netscape 6


// place your images, text, etc in the array elements here

var items = new Array();

<?php 
	$screen = $_GET["screen"]; //Automatically defaults to 0
	
	//$items = getDisplayDisplayItems();
	//printLiveDisplaySection($items, $screen);
 ?>

function loopAdvance() {
	advance();
	setTimeout("loopAdvance()",howOftenAdvance);
}

function loopUpdate() {
	//update();
	//setTimeout("loopUpdate()",howOftenUpdate);
}



// function rotater() {
//     document.getElementById("placeholder").innerHTML = items[current];
//     current = (current==items.length-1) ? 0 : current + 1;
//     setTimeout("rotater()",howOften*1000);
// }

// function rotater() {
//     if(document.layers) {
//         document.placeholderlayer.document.write(items[current]);
//         document.placeholderlayer.document.close();
//     }
//     if(ns6)document.getElementById("placeholderdiv").innerHTML=items[current]
//         if(document.all)
//             placeholderdiv.innerHTML=items[current];
// 
//     current = (current==items.length-1) ? 0 : current + 1; //increment or reset
//     setTimeout("rotater()",howOften*1000);
// }


//window.onload= setupChildren() ;
var windowsList = [];
var childW = null;
 
 function launchChildW(num) {
   childW = windowsList[num];
   if (childW != null) {
   		childW.window.open();
   } else {
    
	   wopts  = 'width=500,height=500,resizable=1,alwaysRaised=1,scrollbars=0';
	   childW = window.open('s1.php?screen=' + num, 'childW' + num, wopts);

	   if (childW != null) {
	//      childW.document.open()
	//      childW.document.bgColor = "ccffcc";
	//      childW.document.write('<br>');
	//      if (childW.opener == null) {
	//        childW.opener = self;
	//      }

		windowsList[num] = childW;

	   } else {
		   alert("Failed to open child window");
	   }
   }
   return childW;
 }

function launchChildWindows() {

	for (var i = 1; i <= 12; i++)
	{
		launchChildW(i);
	}	
}

function update() {
	for (var i = 1; i <= 12; i++)
	{
		if(windowsList[i] != null) {
			windowsList[i].location.href = windowsList[i].location.href
		}
	}	
}

function advance() {
	for (var i = 1; i <= 12; i++)
		{
		if(windowsList[i] != null) {
			windowsList[i].rotater();
			}
		}
}
 
function closeAll(txt) {
   for (var i = 1; i <= 12; i++)
	{
		//Test option
		//windowsList[i].document.writeln(txt + "<BR>");
		if(windowsList[i] != null) {
			windowsList[i].close();
		}
	}
 }

function initLoop() {
	loopUpdate();
	loopAdvance();
} 

</script>

<body id="fullscreenbody">

<form name="buttons" 
    onSubmit="showMe(document.buttons.writeText.value); return false">
<!--
<input NAME="launchButton" TYPE="button" VALUE="Launch Windows" 
    onClick="launchChildWindows()">
-->    
<input name="imageUpdate" type="button" value="Update All Images"
    onclick="update()">    
    <br/><br/>

<input name="imageAdvance" type="button" value="Next Image"
    onclick="advance()">    
    <br/><br/>
    
<input name="windowsClose" type="button" value="Close All"
    onclick="closeAll()">    
    <br/><br/>
<input name="windowsClose" type="button" value="Start Loop"
    onclick="initLoop()">    
    <br/><br/>

<?php

for($i = 1; $i <= 12; $i++) {
	echo '<input NAME="launchButton" TYPE="button" VALUE="Launch Window ' . $i . '" 
    onClick="launchChildW(' . $i . ')">
    <br/>
    
    ';
}

?>

</form>


<layer id="placeholderlayer"></layer><div id="placeholderdiv"></div>
</body>