<?php

	require_once 'inc/functions/session.php';

	function renderLoginForm()
	{
		if (!isLoggedIn())
		{
			?>
			<form class="pure-form login-form" method="post" action="session.php">
				<input type="email" name="email" placeholder="email"/>
				<input type="password" name="password" placeholder="password"/>
				<input type="submit" class="pure-button" name="login-submit" value="log in"/>
			</form>
			<?php

			if (isset($_SESSION['loginErrorMessage']))
			{
				echo '<div class="error">' . $_SESSION['loginErrorMessage'] . '</div>';
			}
		}
	}


	function renderRegisterForm()
	{
		?>
		<div class="panel">
			<h2>join the fun!</h2>

			<form class="pure-form pure-form-stacked register-form" method="post" action="session.php">
				<div class="pure-g">
					<div class="pure-u-11-24">
						<input type="text" class="pure-u-1" name="first-name" placeholder="first name">
					</div>
					<div class="pure-u-2-24"></div>
					<div class="pure-u-11-24">
						<input type="text" class="pure-u-1" name="last-name" placeholder="last name">
					</div>
					<input type="email" class="pure-u-1" name="email"
					       placeholder="email (you'll use this to log in)">
					<input type="password" class="pure-u-1" name="password" placeholder="choose a password">
					<input type="submit" class="pure-button pure-button-primary pure-u-1"
					       name="register-submit"
					       value="join"/>
				</div>
			</form>
		<?php

		if (isset($_SESSION['registerErrorMessage']))
		{
			echo '<div class="error">' . $_SESSION['registerErrorMessage'] . '</div>';
		}
	}
