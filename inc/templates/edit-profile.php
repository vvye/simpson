<form action="<?= $action ?>" method="post">
	<fieldset>
		<legend>Personal info</legend>
		<table>
			<tr>
				<td><label for="first-name">First name:</label></td>
				<td>
					<input type="text" id="first-name" name="first-name" value="<?= $firstName ?>" />
				</td>
			</tr>
			<tr>
				<td><label for="last-name">Last name:</label></td>
				<td>
					<input type="text" id="last-name" name="last-name" value="<?= $lastName ?>" />
				</td>
			</tr>
			<tr>
				<td><label for="email">E-Mail address:</label></td>
				<td>
					<input type="email" id="email" name="email" value="<?= $email ?>" />
					<label class="checkbox">
						<input type="checkbox" id="email-public" name="email-public"
							<?= $emailPublic ? 'checked="checked"' : '' ?> />
						<span class="label">Show my e-mail address in public</span>
					</label>
				</td>
			</tr>
			<tr>
				<td><label for="bio">Bio:</label></td>
				<td>
					<textarea id="bio" name="bio"><?= $bio ?></textarea>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Credentials</legend>
		<table>
			<tr>
				<td><label for="old-password">Old password:</label></td>
				<td><input type="password" id="old-password" name="old-password" value="" /></td>
			</tr>
			<tr>
				<td><label for="new-password">New password:</label></td>
				<td class="stacked-input">
					<input type="password" class="stacked" id="new-password" name="new-password"
					       value="<?= $newPassword ?>" />
					<input type="password" class="stacked" id="new-password-confirm" name="new-password-confirm"
					       value="<?= $newPasswordConfirm ?>" />
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Avatar</legend>
		<table>
			<tr>
				<td>Current avatar:</td>
				<td>
					<?php if ($hasAvatar): ?>
						<img src="<?= BASE_PATH ?>/img/avatars/<?= $userId ?>.png" alt="Avatar" />
					<?php else: ?>
						<img src="<?= BASE_PATH ?>/img/avatars/default.png" alt="Avatar" />
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<label class="checkbox">
						<input type="checkbox" id="change-avatar" name="change-avatar" />
						<span class="label">Choose a new avatar</span>
					</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<label class="checkbox">
						<input type="checkbox" id="remove-avatar" name="remove-avatar" />
						<span class="label">Remove avatar</span>
					</label>
				</td>
			</tr>
		</table>
	</fieldset>
	<input type="submit" name="submit" class="large primary button" value="Edit profile">
</form>