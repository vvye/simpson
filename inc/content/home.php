<div class="pure-g">
	<div class="pure-u-1-2">
		<div class="l-box">
			<h1 class="title">simpson</h1>

			<p>a <em>simp</em>le <em>so</em>cial <em>n</em>etwork</p>

			<p>Hello world! Insert some kind of message here, such as "welcome to my awesome site", "simpson
				is the leading provider of social networks worldwide", and other blatant lies.</p>

			<?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
				<div class="panel">Hi <?php echo $_SESSION['firstName']; ?>! <a href="?p=logout">logout</a></div>
			<?php else: ?>
				<form class="pure-form login-form" method="post" action="?p=login">
					<input type="email" name="email" placeholder="email"/>
					<input type="password" name="password" placeholder="password"/>
					<input type="submit" class="pure-button" name="login-submit"
					       value="log in"/>
				</form>
				<?php if (isset($loginErrorMessage)): ?>
					<div class="error"><?php echo $loginErrorMessage; ?></div>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	<div class="pure-u-1-2">
		<div class="l-box text-center">
			<?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
				<div class="panel">
					<p>insert actions/notifications here</p>
				</div>
			<?php else: ?>
				<div class="panel">
					<h2>join the fun!</h2>

					<form class="pure-form pure-form-stacked register-form" method="post" action="?p=register">
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
							<input type="submit" class="pure-button pure-button-primary pure-u-1" name="register-submit"
							       value="join"/>
						</div>
					</form>
					<?php if (isset($registerErrorMessage)): ?>
						<div class="error"><?php echo $registerErrorMessage; ?></div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>
