<div class="grid">

	<div class="column">
		<div class="column-content">
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
		<div class="column-content">
			<div class="panel home-panel">

				<?php if ($loggedIn): ?>

					<h3>Hi <a href="<?= BASE_PATH ?>/?p=profile"><?= $displayName ?></a>!</h3>

					<?php if ($numNewMessages > 0 || $numNewReplies > 0 || $numNewAddressings > 0
						|| $numNewRepliesToUser > 0): ?>

						<?php if ($hasAvatar): ?>
							<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/<?= $userId ?>.png" />
						<?php else: ?>
							<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
						<?php endif ?>

						<p>Here's what happened since your last visit:</p>
						<div class="content">
							<ul>
								<?php if ($numNewMessages !== 0): ?>
									<li>
										<strong><?= $numNewMessages ?></strong> new
										message<?= $numNewMessages === 1 ? '' : 's' ?>
										<?php if ($numNewReplies !== 0): ?>
											with <strong><?= $numNewReplies ?></strong> new
											<?= $numNewReplies === 1 ? 'reply' : 'replies' ?> in total
										<?php endif ?>
									</li>
								<?php endif ?>
								<?php if ($numNewAddressings !== 0): ?>
									<li><strong><?= $numNewAddressings ?></strong> of them are for you!</li>
								<?php endif ?>
								<?php if ($numNewRepliesToUser !== 0): ?>
									<li><strong><?= $numNewRepliesToUser ?></strong> new replies to your messages</li>
								<?php endif ?>
							</ul>
						</div>

					<?php else: ?>

						<?php if ($hasAvatar): ?>
							<img class="avatar centered" src="<?= BASE_PATH ?>/img/avatars/<?= $userId ?>.png" />
						<?php else: ?>
							<img class="avatar centered" src="<?= BASE_PATH ?>/img/avatars/default.png" />
						<?php endif ?>

					<?php endif ?>

					<div class="clearfix"></div>

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

