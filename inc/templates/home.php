<div class="grid">

	<div class="column">
		<div class="content">
			<h1>simpson</h1>
			<p>a <em>simp</em>le <em>soc</em>ial <em>n</em>etwork</p>
			<p>Hello World! <em>simpson</em> is a minimalist social network that exists for no reason in particular.</p>
			<?php if (!$loggedIn): ?>
				<form class="login-form" action="<?= BASE_PATH ?>/session.php?action=login" method="post">
					<label><input type="email" name="email" placeholder="E-Mail" /></label>
					<label><input type="password" name="password" placeholder="Password" /></label>
					<button type="submit">Log in</button>
				</form>
				<?php if ($loginError): ?>
					<div class="alert error">
						That didn't work.
					</div>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>

	<div class="column">
		<div class="content">
			<div class="panel register">
				<?php if ($loggedIn): ?>
					<h3>Hi <?= $displayName ?>!</h3>
				<?php else: ?>
					<h3>Join the fun!</h3>
					<form action="<?= BASE_PATH ?>/?p=home" method="post">
						<table>
							<tr>
								<td><label for="first-name">First name:</label></td>
								<td>
									<input type="text" id="first-name" name="first-name" placeholder="First name"
									       value="<?= $firstName ?>" />
								</td>
							</tr>
							<tr>
								<td><label for="last-name">Last name:</label></td>
								<td>
									<input type="text" id="last-name" name="last-name" placeholder="Last name"
									       value="<?= $lastName ?>" />
								</td>
							</tr>
							<tr>
								<td><label for="email">E-Mail:</label></td>
								<td>
									<input type="email" id="email" name="email" placeholder="E-Mail"
									       value="<?= $email ?>" />
								</td>
							</tr>
							<tr>
								<td><label for="password">Choose a password:</label></td>
								<td>
									<input type="password" id="password" name="password" value="<?= $password ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="2" class="action">
									<button type="submit" name="register" class="large primary full-size">Join</button>
								</td>
							</tr>
							<?php if ($registrationAttempted): ?>
								<tr>
									<td colspan="2">
										<?php if (empty($registrationErrorMessages)): ?>
											<div class="alert success">
												Welcome to <em>simpson</em>! You can log in now.
											</div>
										<?php else: ?>
											<div class="alert error">
												<?= join('<br />', $registrationErrorMessages) ?>
											</div>
										<?php endif ?>
									</td>
								</tr>
							<?php endif ?>
						</table>
					</form>
				<?php endif ?>
			</div>
		</div>
	</div>

</div>

