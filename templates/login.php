<!-- CO551 CW2 - Task 6 (Bootstrap reference: https://getbootstrap.com/docs/5.1/forms/overview/) -->
<?php echo $message; ?>
<h2>Login</h2><br>
<form name="frmLogin" action="authenticate.php" method="post">
   <label for="txtid" class="form-label">Student ID:</label>
   <input class="form-control" style="width:15%;" name="txtid" type="text" />
   <br/>
   <label for="txtpwd" class="form-label">Password:</label>
   <input class="form-control" style="width:15%;" name="txtpwd" type="password" />
   <br/>
   <input type="submit" class="btn btn-primary" value="Login" name="btnlogin" />
</form>
