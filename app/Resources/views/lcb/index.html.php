<a href='<?php echo $urlIndex;?>'> Home </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
<a href='<?php echo $urlArticles;?>'> Articles </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
<a href='<?php echo $urlCategories;?>'> Categories </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp

<br/><br/><hr/><br><br/>

<h2> 1. Registration</h2>
if you want to create account <a href='<?php echo $urlRegistration;?>'>CLICK HERE</a>

  <br/><br/><hr/><br><br/>

<h2> 2. Login / Logout </h2>

<?php
 if($userId == '') {
?>
if you want to "LOGIN"   <a href='<?php echo $urlLogin;?>'>CLICK HERE</a>
<?php } else {?>
	if you want to "LOGOUT" <a href='<?php echo $urlLogout;?>'>CLICK HERE</a>
<?php }?>
