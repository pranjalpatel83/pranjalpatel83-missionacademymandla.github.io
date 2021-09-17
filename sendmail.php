<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                                                      // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

session_start();
$uri = $_SERVER['PHP_SELF'] . "?" . SID;
?>

<title>MySQL in PHP test page</title>
<h1>PHP script to access a MySQL database</h1>

<?php

// have username and password been passed from a form?
if( !empty($_POST) ) {
	$dbuser = $_POST['dbuser'];
		$pass = $_POST['pass'];
}

if ( isset($dbuser) && isset($pass) ) {
	// try to connect to MySQL database with user and password supplied
	$mysqli = mysqli_connect("csmysql.cs.cf.ac.uk", $dbuser, $pass, "sample");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Could not connect: %s\n", mysqli_connect_error());
		unset($dbuser); unset($pass);
	}
}

// username and password will be set if they were passed or unset if not,
//  or if they were wrong
if( !isset($dbuser) || !isset($pass) ) {
    // just print form asking for account details
    echo "<form action=\"$uri\" method=post>\n";
    echo "<p>MySQL account name: ";
    echo "<input type=text name=dbuser>\n";
    echo "<br>Password: <input type=password name=pass>\n";
    echo "<br><input type=submit name=login value=Login>\n";
    echo "</form>\n";
    exit;
}

// we have logged in to MySQL

// run the query
if( $res = $mysqli->query("SELECT s.name AS NAME, o.osname AS OS, p.pname AS PERSON
       FROM systems s, opsystem o, people p
       WHERE s.oscode=o.oscode and s.ownercode = p.pcode") ) {

	// retrieve the results
	print "<table cols=3 border=1>\n";
	print "<tr>\n";
	print "<th>Name</th>\n";
	print "<th>Owner</th>\n";
	print "<th>Operating System</th>\n";
	print "</tr>";
	while( $row = $res->fetch_assoc() ) {
		print "<tr>\n";
		echo "<td>" . $row["NAME"] . "</td>\n";
		print "<td>" . $row["OS"] . "</td>\n";
		print "<td>" . $row["PERSON"] . "</td>\n";
		print "</tr>\n";
	}
	print "</table>\n";
}
?>