<?php if ($isOwnProfile): ?>
	<div><a class="button" href="<?= BASE_PATH ?>/edit-profile?token=<?= $token ?>">Edit profile</a></div>
<?php endif ?>

<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />

<h2><?= $firstName ?> <?= $lastName ?></h2>

<?php if ($isEmailPublic): ?>
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

