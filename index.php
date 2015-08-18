<?php

	/*
		simpson, by vvye
	*/

	require_once('inc/functions/static_pages.php');

	include('header.php');

?>

	<div class="pure-g">
		<div class="pure-u-1-2">
			<div class="l-box">
				<h1 class="title">simpson</h1>

				<p>a simple social network</p>

				<p>Hello world! Insert some kind of message here, such as "welcome to my awesome site", "simpson
					is the leading provider of social networks worldwide", and other blatant lies.</p>

				<form class="pure-form" action="">
					<input type="email" name="email" placeholder="e-mail" />
					<input type="password" name="password" placeholder="password" />
					<input type="submit" class="pure-button" name="login-submit"
					       value="login" />
				</form>
			</div>
		</div>
		<div class="pure-u-1-2">
			<div class="l-box text-center">
				<div class="box">
					<h2>join the fun!</h2>

					<form class="pure-form pure-form-stacked register-form" action="">
						<div class="pure-g">
							<div class="pure-u-1-2"><input type="text" name="first-name" placeholder="first name"></div>
							<div class="pure-u-1-2"><input type="text" name="last-name" placeholder="last name"></div>
						</div>
						<input type="email" placeholder="e-mail">
						<input type="password" placeholder="choose a password">
						<input type="submit" class="pure-button pure-button-primary" value="join" />
					</form>
				</div>
			</div>
		</div>
	</div>

<?php

	include('footer.php');
