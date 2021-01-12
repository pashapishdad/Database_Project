<footer>

	<div>
		<?php 
			if(!isset($_SESSION['username'])){
				echo '<label>Admin Login</label><br>
					<form action="adminLogin.inc.php" method="post">
						<input type="text" name="mailuid" placeholder="Username or E-mail">
						<input type="password" name="pwd" placeholder="Password">
						<button type="submit" name ="login-submit">Login</button>
					</form><br>';
			}
		?>
	</div>

</footer>

</body>
</html>
