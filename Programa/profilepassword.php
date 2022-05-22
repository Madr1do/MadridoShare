
<?php
session_start();
include 'sidemenu.php';

$id = $_SESSION["id"];/* userid of the user */
if(count($_POST)>0) {
$result = mysqli_query($con,"SELECT *from accounts WHERE id='" . $id . "'");
$row=mysqli_fetch_array($result);

mysqli_query($con,"UPDATE accounts set password='" . password_hash($_POST["newPassword"], PASSWORD_DEFAULT) . "' WHERE id='" . $id . "'");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Password Change</title>

</head>
<body>
<h3 align="center">CHANGE PASSWORD</h3>
<div><?php if(isset($message)) { echo $message; } ?></div>
<form method="post" action="" align="center">
Current Password:<br>
<input type="password" name="currentPassword"><span id="currentPassword" class="required"></span>
<br>
New Password:<br>
<input type="password" name="newPassword"><span id="newPassword" class="required"></span>
<br>
Confirm Password:<br>
<input type="password" name="confirmPassword"><span id="confirmPassword" class="required"></span>
<br><br>
<input type="submit">
</form>
<br>=
<br>
</body>
</html>
