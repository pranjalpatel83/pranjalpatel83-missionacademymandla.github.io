<?php 
require_once("fconfig.php");
if((isset($_REQUEST['your_name'])&& $_REQUEST['your_name'] !='') && (isset($_REQUEST['your_email'])&& $_REQUEST['your_email'] !=''))
{
 require_once("contact_mail.php");

$yourName = $conn->real_escape_string($_REQUEST['your_name']);
$yourEmail = $conn->real_escape_string($_REQUEST['your_email']);
$yourPhone = $conn->real_escape_string($_REQUEST['your_phone']);
$comments = $conn->real_escape_string($_REQUEST['comments']);
$sql="INSERT INTO contact_form_info (name, email, phone, comments) VALUES ('".$yourName."','".$yourEmail."', '".$yourPhone."', '".$comments."')";
if(!$result = $conn->query($sql)){
die('There was an error running the query [' . $conn->error . ']');

}
else
{
echo "Thank you! We will contact you soon";
}
}
else
{
echo "Please fill Name and Email";
}
?>