<div class="narrow">

	<?php if ($success): ?>
		<div class="alert success"><?= MSG_MESSAGE_DELETE_SUCCESS ?></div>
		<a class="button" href="<?= BASE_PATH ?>/?p=messages">Back</a>
	<?php elseif ($error): ?>
		<div class="alert error"><?= MSG_MESSAGE_DELETE_FAILURE ?></div>
	<?php else: ?>

		<p>Delete this message?</p>

		<div id="message-<?= $message['id'] ?>" class="message panel">
			<?php if ($message['authorHasAvatar']): ?>
				<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/<?= $message['author_id'] ?>.png" />
			<?php else: ?>
				<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
			<?php endif ?>
			<div class="content">
				<div class="info">
					<h3>
						<a href="<?= BASE_PATH ?>/profile/<?= $message['author_id'] ?>">
							<?= $message['author_first_name'] ?> <?= $message['author_last_name'] ?>
						</a>
					</h3>
					<?php if ($message['hasAddressee']): ?>
						<h3>
							► <a href="<?= BASE_PATH ?>/profile/<?= $message['addressee_id'] ?>">
								<?= $message['addressee_first_name'] ?> <?= $message['addressee_last_name'] ?>
							</a>
						</h3>
					<?php endif ?>
					<span class="post-time"><?= renderDate($message['post_time'], true) ?></span>
				</div>
				<div class="text">
					<?= $message['content'] ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

		<form class="delete-form" action="<?= BASE_PATH ?>/?p=delete&message=<?= $message['id'] ?>" method="post">
			<input type="submit" class="button" name="submit" value="Delete" />
			<input type="hidden" name="token" value="<?= $token ?>" />
			<a class="primary button" href="<?= BASE_PATH ?>/?p=messages">Cancel</a>
		</form>

	<?php endif ?>

</div>