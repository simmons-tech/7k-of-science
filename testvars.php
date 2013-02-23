<html>
<head></head>
<body>
<!--
<script>
function grabData() {
	var data_from_ajax;

	$.get('https://adat.scripts.mit.edu:444/www/dev/simmons/display/dashboard.php', function(data) {
	  data_from_ajax = data;
	});
	
	window.alert(data_from_ajax);
	window.alert("Done");
}
    
window.onload = grabData;

</script>
-->

<?php

$content = file_get_contents('https://adat.scripts.mit.edu:444/www/dev/simmons/display/dashboard.php');
print($content);

//include("https://adat.scripts.mit.edu:444/www/dev/simmons/display/dashboard.php");

/*

//  if (@$_SERVER['SSL_CLIENT_S_DN_CN']) {
//   print 'Welcome, <b>' . $_SERVER['SSL_CLIENT_S_DN_CN'] . '</b>.<br>'
//       . 'A certificate for <b>' . $_SERVER['SSL_CLIENT_S_DN_Email'] . '</b>'
//       . ', issued by the <b>' . $_SERVER['SSL_CLIENT_I_DN_O']
//       . '</b>, is correctly installed on your browser.<br>'
//       . 'Your certificate will expire on ' . $_SERVER['SSL_CLIENT_V_END'] . '.';
// 
// 
// print($_SERVER['SSL_CLIENT_S_DN_CN']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_ST']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_L']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_I_DN_O']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_OU']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_CN']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_T']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_I']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_G']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_S']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_D']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_UID']);
// print('  </br>');
// print($_SERVER['SSL_CLIENT_S_DN_Email']);
// print('  </br>');
// 
//  } else {
//   ?>No certificate has been detected. Please ensure you are accessing
//   <a href="https://geofft.scripts.mit.edu:444/detect.php">http<b>s</b>://geofft.scripts.mit.edu<b>:444</b>/detect.php</a>.<?php }

*/
  
  
   ?>
</body>
</html>
