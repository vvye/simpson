<form>
	<fieldset>
		<legend>Personal info</legend>
		<table>
			<tr>
				<td>First name:</td>
				<td>
					<label><input type="text" name="first-name" /></label>
				</td>
			</tr>
			<tr>
				<td>Last name:</td>
				<td>
					<label><input type="text" name="last-name" /></label>
				</td>
			</tr>
			<tr>
				<td>E-Mail address:</td>
				<td>
					<label><input type="email" name="email" /></label>
					<label class="checkbox">
						<input type="checkbox" name="email-public" />
						<span class="label">Show my e-mail address in public</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>Bio:</td>
				<td>
					<label><textarea name="bio"></textarea></label>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Credentials</legend>
		<table>
			<tr>
				<td>Old password:</td>
				<td><label><input type="password" name="old-password" /></label></td>
			</tr>
			<tr>
				<td>New password:</td>
				<td><label><input type="password" name="new-password-1" /></label></td>
				<td><label><input type="password" name="new-password-2" /></label></td>
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
						<input type="checkbox" name="change-avatar" />
						<span class="label">Choose a new avatar</span>
					</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<label class="checkbox">
						<input type="checkbox" name="remove-avatar" />
						<span class="label">Remove avatar</span>
					</label>
				</td>
			</tr>
		</table>
	</fieldset>
	<input type="submit" class="large primary button" value="Edit profile">
</form>