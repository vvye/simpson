<form>
	<fieldset>
		<legend>Personal info</legend>
		<table>
			<tr>
				<td><label for="first-name">First name:</label></td>
				<td>
					<input type="text" id="first-name" name="first-name" />
				</td>
			</tr>
			<tr>
				<td><label for="last-name">Last name:</label></td>
				<td>
					<input type="text" id="last-name" name="last-name" />
				</td>
			</tr>
			<tr>
				<td><label for="email">E-Mail address:</label></td>
				<td>
					<input type="email" id="email" name="email" />
					<label class="checkbox">
						<input type="checkbox" id="email-public" name="email-public" />
						<span class="label">Show my e-mail address in public</span>
					</label>
				</td>
			</tr>
			<tr>
				<td><label for="bio">Bio:</label></td>
				<td>
					<textarea id="bio" name="bio"></textarea>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Credentials</legend>
		<table>
			<tr>
				<td><label for="old-password">Old password:</label></td>
				<td><input type="password" id="old-password" name="old-password" /></td>
			</tr>
			<tr>
				<td><label for="new-password-1">New password:</label></td>
				<td>
					<input type="password" class="stacked" id="new-password-1" name="new-password-1" />
				</td>
				<td>
					<input type="password" class="stacked" id="new-password-2" name="new-password-2" />
				</td>
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