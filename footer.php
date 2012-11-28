	<aside>
		<?php
		// login box for users
		autologin();				
		$login_failed = 0;
		echo '<div id="login">';
			if( isset($_POST['submit']) AND $_POST['submit'] == $footer['login'] ) {
				$values = array();
				$values['username'] = $_POST['User'];
				$values['password'] = $_POST['Password'];
				$values['autologin'] = isset($_POST['Autologin']);
				// if the data is not correct show the form again
				if (!login($values)) {
					echo $footer['login_error'];
					$login_failed = 1;
				// else show the welcome message
				} else {
					$login_failed = 0;
				}
			}
			if ( !isset($_SESSION['UserID']) OR $login_failed == 1 ) {
			// if no user is logged in or the login failed show the login form ?>
				<form name="Login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" accept-charset=\"UTF-8\">
				<ul id="login_form">
					<li><?php echo $footer['login_name']; ?></li>
					<li><input type="text" name="User" maxlength="32"></li>
					<li><?php echo $footer['login_pw']; ?></li>
					<li><input type="password" name="Password"></li>
					<li><?php echo $footer['keep_login']; ?><input type="checkbox" name="<?php echo $footer['autologin'] ?>" value="1"></li>
					<li><input type="submit" name="submit" value="<?php echo $footer['login'] ?>"></li>
					<li><a href="calendar/passwort.php"><?php echo $footer['forgotten_pw'] ?></a></li>
				</ul>
				</form>
			<?php // if a user is logged in only show the welcome message
			} else {
				echo $footer['welcome'].$_SESSION['Nickname'].".";
				echo " (<a href='calendar/logout.php'>".$footer['logout']."</a>)";
			}
			?>
		</div>
		<?php // configuration box ?>
		<ul id="bottom">
			<li>
			<?php 
			if (isset($_GET['m'])){
				echo '<a href="calendar/liste.php?year='.$_GET['y'].'&amp;month='.$_GET['m'].'" target="_blank">'.$footer['monthly_events'].'</a>';
			} else {
				echo '<a href="calendar/liste.php?year='.$_SESSION['phpcal_year'].'&amp;month='.$_SESSION['phpcal_month'].'" target="_blank">'.$footer['monthly_events'].'</a>';
			};
			?>
			</li>
			<?php
			if ( isset($_SESSION['phpcal_rights']) AND in_array('admin', $_SESSION['phpcal_rights']) ) {
				echo '<li><a href="user_config.php" target="_blank">'.$footer['user_config'].'</a></li>';
				echo '<li><a href="event_config.php" target="_blank">'.$footer['event config'].'</a></li>';
			}
			?>
		</ul>
	</aside>
	</div> <!--- content end !--->
	<?php // important to keep the footer at the bottom ?>
	<div class="push"></div>
</div> <!--- wrapper end !--->
<footer class="footer">
	<ul class="footer-nav">
		<li>
			<?php echo $main['calendar'] ?>
		</li>
	</ul>
</footer>
</body>
</html>