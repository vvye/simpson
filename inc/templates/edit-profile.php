<form>
	<fieldset>
		<legend>Personal info</legend>
		<table>
			<tr>
				<td><label for="first-name">First name:</label></td>
				<td>
					<label><input type="text" id="first-name" name="first-name" /></label>
				</td>
			</tr>
			<tr>
				<td><label for="last-name">Last name:</label></td>
				<td>
					<label><input type="text" id="last-name" name="last-name" /></label>
				</td>
			</tr>
			<tr>
				<td><label for="email">E-Mail address:</label></td>
				<td>
					<label><input type="email" id="email" name="email" /></label>
					<label class="checkbox">
						<input type="checkbox" id="email-public" name="email-public" />
						<span class="label">Show my e-mail address in public</span>
					</label>
				</td>
			</tr>
			<tr>
				<td><label for="bio">Bio:</label></td>
				<td>
					<label><textarea id="bio" name="bio"></textarea></label>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Credentials</legend>
		<table>
			<tr>
				<td><label for="old-password">Old password:</label></td>
				<td><label><input type="password" id="old-password" name="old-password" /></label></td>
			</tr>
			<tr>
				<td><label for="new-password-1">New password:</label></td>
				<td><label><input type="password" id="new-password-1" name="new-password-1" /></label></td>
				<td><label><input type="password" id="new-password-2" name="new-password-2" /></label></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Avatar</legend>
		<table>
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
	<input type="submit" class="large primary button" value="Edit profile">
</form>