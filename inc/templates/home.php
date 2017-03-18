<div class="grid">

	<div class="column">
		<div class="content">
			<h1>simpson</h1>
			<p>a <em>simp</em>le <em>soc</em>ial <em>n</em>etwork</p>
			<p>Hello World! <em>simpson</em> is a minimalist social network that exists for no reason in particular.</p>
			<?php if (!$loggedIn): ?>
				<form method="post" action="session.php?action=login">
					<label><input type="email" name="email" placeholder="E-Mail" /></label>
					<label><input type="password" name="password" placeholder="Password" /></label>
					<button type="submit">Log in</button>
				</form>
				<?php if ($loginError): ?>
					<div class="error message">
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
					<h3>Hi <?= $firstName ?>!</h3>
				<?php else: ?>
					<h3>Join the fun!</h3>
					<form method="post">
						<table>
							<tr>
								<td><label for="first-name">First name:</label></td>
								<td><input type="text" id="first-name" name="first-name" /></td>
							</tr>
							<tr>
								<td><label for="last-name">Last name:</label></td>
								<td><input type="text" id="last-name" name="last-name" /></td>
							</tr>
							<tr>
								<td><label for="email">E-Mail:</label></td>
								<td><input type="email" id="email" name="email" /></td>
							</tr>
							<tr>
								<td><label for="password">Choose a password:</label></td>
								<td><input type="password" id="password" name="password" /></td>
							</tr>
							<tr>
								<td colspan="2" class="action">
									<button type="submit" name="register" class="large primary full-size">Join</button>
								</td>
							</tr>
						</table>
					</form>
				<?php endif ?>
			</div>
		</div>
	</div>

</div>

