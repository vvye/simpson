<div class="panel profile">
	<?php if ($hasAvatar): ?>
		<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/<?= $userId ?>.png" alt="Avatar" />
	<?php else: ?>
		<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" alt="Avatar" />
	<?php endif; ?>

	<h2><?= $firstName ?> <?= $lastName ?></h2>

	<?php if ($emailPublic): ?>
		<p><?= $email ?></p>
	<?php endif ?>

	<p>
		Registered: <?= formatDate($registrationTime, true) ?><br />
		Last login: <?= formatDate($lastLoginTime, true) ?>
	</p>

	<div class="clearfix"></div>

	<?php if ($bio !== ''): ?>
		<p><?= $bio ?></p>
	<?php endif ?>
</div>

<?php if ($isOwnProfile): ?>
	<a class="button" href="<?= BASE_PATH ?>/edit-profile?token=<?= $token ?>">Edit profile</a>
<?php endif ?>

