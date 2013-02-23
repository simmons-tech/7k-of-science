<?php
$nl = "<br/>";
$myname = $_SERVER['SSL_CLIENT_S_DN_CN'];
$myemail = $_SERVER['SSL_CLIENT_S_DN_Email'];
$myusername = substr($myemail, 0, strpos($myemail, "@"));

function writeChanges($changed) {
        $changed = "test";
	$myFile = ".ltaccess.mit";
        $fh = fopen($myFile, 'w') or die("Can't open file");
	fwrite($fh, $changed);
        fclose($fh);
}

function getCurrentAuthsString() {
        $filename = '.htaccess.mit';
        $string = "Require user ";

        $fh = fopen($filename, "r");
        $original = fread($fh, filesize($filename));
        fclose($fh);

        $current = substr($original, strpos($original, "\n"));
        $current = substr($current, 14);
        $current = substr($current, 0, strpos($current, "\n"));
        return $current;
}

function getCurrentAuthsArray() {
        return explode(" ", getCurrentAuthsString());
}


echo("Welcome, " . $myname . "<br/>");

$auths = getCurrentAuthsArray();

if(in_array($myusername, $auths)) {
	echo("<br/>You have admin priviledges! <br/>");
} else {
	echo("<br/>You are not an admin, sorry bro. <br/>");
	exit();	
}


print("Authenticated users are: <br/>");

#var_dump($current);
#print("<br/>");
#var_dump($authusers);
#exit();
print("<form action=\"modadmin.php\" method=\"post\">");

foreach($auths as $user) {
    print("<input type=\"checkbox\" checked=\"checked\" name=\"check$user\"> $user </input>");
    print("<br/>");
   # print("$user . "</li>");
}
#print("<input type=\"submit\" />");
print("</form>");


print("<br/>");
print("Add an admin? Type name below and press submit");

?>

<form action="modadmin.php" method="post">
Username: <input type="text" name="newuname" />
<input type="submit" />
</form>

<?php 
$auths = getCurrentAuthsArray();
$newauths = "";
foreach($auths as $user) {
    $checkid = "check" . $user;
    if(isset($_POST[$checkid])) {
#	print $checkid;	
	$newauths = " " + $checkid;	
	}
    else {
#	print "Unchecked";
    }
    writeChanges($newauths);

}

if(isset($_POST["newuname"])) {
	$newuname = $_POST["newuname"];

	#print("</br>Old List: " . $current);
	$newcurrent = getCurrent() . " " . $newuname;
	#print("<br/>New List: " . $newcurrent);

	$output = str_replace($current, $newcurrent, $original);
	writeChanges($output);

}

?>


