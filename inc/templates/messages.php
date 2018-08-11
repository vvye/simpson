<div class="narrow">
	<form>
		<a class="primary button">Write a message</a>
	</form>

	<?php foreach ($messages as $message): ?>
		<div class="message panel">
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
					<span class="post-time"><?= formatDate($message['post_time'], true) ?></span>
				</div>
				<?= $message['content'] ?>
				<?php if (count($message['replies']) > 0): ?>
					<div class="replies">
						<h3>
							<?= count($message['replies']) ?> <?= count($message['replies']) === 1 ? 'reply' : 'replies' ?>
						</h3>
						<ul>
							<?php foreach ($message['replies'] as $reply): ?>
								<li class="reply">
									<?php if ($reply['authorHasAvatar']): ?>
										<img class="avatar"
										     src="<?= BASE_PATH ?>/img/avatars/<?= $reply['author_id'] ?>.png" />
									<?php else: ?>
										<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
									<?php endif ?>
									<div class="content">
										<div class="info">
											<h4>
												<a href="<?= BASE_PATH ?>/profile/<?= $reply['author_id'] ?>">
													<?= $reply['author_first_name'] ?> <?= $reply['author_last_name'] ?>
												</a>
											</h4>
											<span class="post-time"><?= formatDate($message['post_time'], true) ?></span>
										</div>
										<?= $reply['content'] ?>
									</div>
									<div class="clearfix"></div>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
				<?php endif ?>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php endforeach ?>
</div>
