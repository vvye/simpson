<h2><?= $firstName ?> <?= $lastName ?></h2>

<?php if ($isEmailPublic): ?>
	<p><?= $email ?></p>
<?php endif ?>

<p>
	Registered: <?= formatDate($registrationTime, true) ?><br />
	Last seen: <?= formatDate($lastLoginTime, true) ?>
</p>

<?php if ($bio !== ''): ?>
	<hr />
	<p><?= $bio ?></p>
<?php endif ?>

