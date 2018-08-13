<div class="narrow">

	<?php if (empty($messages)): ?>
		<em class="empty">There aren't any messages yet.</em>
	<?php endif ?>

	<form action="<?= BASE_PATH ?>/?p=messages" method="post">
		<div class="message message-form panel">
			<a class="primary button visible-with-js" id="write-message">Write a message</a>
			<div id="message-form" <?= $messageError ? '' : 'class="hidden-with-js"' ?>>
				<textarea id="content" name="content"
				          placeholder="Write a message&hellip;"><?= $messageContent ?></textarea>
				<label class="checkbox">
					<input type="checkbox" id="add-addressee"
					       name="add-addressee" <?= $addAddressee ? 'checked="checked"' : '' ?> />
					<span class="label">Address another user (the message will still be public)</span>
				</label>
				<div id="addressee-form" <?= $addAddressee ? '' : 'class="hidden-with-js"' ?>>
					<input type="text" id="addressee" name="addressee"
					       placeholder="First and last name, or user ID if name isn't unique"
					       value="<?= $addressee ?>" />
				</div>
				<input type="hidden" name="token" value="<?= $token ?>" />
				<input type="submit" name="post-message" id="post-message" class="button" value="Post message" />
				<?php if ($messageError): ?>
					<div class="alert error">
						<?= join('<br />', $messageErrors) ?>
					</div>
				<?php endif ?>
			</div>
			<?php if ($newMessageId !== null): ?>
				<div id="message-post-success" class="alert success">
					Your message has been posted!
				</div>
			<?php endif ?>
		</div>
	</form>

	<?php foreach ($messages as $message): ?>

		<div id="message-<?= $message['id'] ?>"
		     class="message panel<?= $message['id'] === $newMessageId ? ' newly-posted' : '' ?>">

			<?php if ($message['authorHasAvatar']): ?>
				<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/<?= $message['author_id'] ?>.png" />
			<?php else: ?>
				<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
			<?php endif ?>

			<div class="content">

				<div class="info">
					<h3>
						<a href="<?= BASE_PATH ?>/?p=profile&user=<?= $message['author_id'] ?>">
							<?= $message['author_first_name'] ?> <?= $message['author_last_name'] ?>
						</a>
					</h3>
					<?php if ($message['hasAddressee']): ?>
						<h3>
							► <a href="<?= BASE_PATH ?>/?p=profile&user=<?= $message['addressee_id'] ?>">
								<?= $message['addressee_first_name'] ?> <?= $message['addressee_last_name'] ?>
							</a>
						</h3>
					<?php endif ?>

					<span class="post-time"><?= renderDate($message['post_time'], true) ?></span>

					<?php if ($message['isOwnMessage']): ?>
						<a class="tiny subtle button" href="<?= BASE_PATH ?>/?p=delete&message=<?= $message['id'] ?>">
							Delete</a>
					<?php endif ?>

				</div>

				<div class="text">
					<?= $message['content'] ?>
				</div>

				<?php if (!empty($message['replies'])): ?>

					<div class="replies">
						<h3>
							<?= count($message['replies']) ?> <?= count($message['replies']) === 1 ? 'reply' : 'replies' ?>
						</h3>

						<a class="tiny subtle reply-toggle button visible-with-js">
							<?= count($message['replies']) > REPLIES_SHOWN ? '▼' : '▲' ?>
						</a>

						<ul<?= count($message['replies']) > REPLIES_SHOWN ? ' class="hidden-with-js"' : '' ?>>

							<?php foreach ($message['replies'] as $reply): ?>

								<li class="reply<?= $reply['id'] === $newReplyId ? ' newly-posted' : '' ?>">

									<?php if ($reply['authorHasAvatar']): ?>
										<img class="avatar"
										     src="<?= BASE_PATH ?>/img/avatars/<?= $reply['author_id'] ?>.png" />
									<?php else: ?>
										<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
									<?php endif ?>

									<div class="content">
										<div class="info">
											<h4>
												<a href="<?= BASE_PATH ?>/?p=profile&user=<?= $reply['author_id'] ?>">
													<?= $reply['author_first_name'] ?> <?= $reply['author_last_name'] ?>
												</a>
											</h4>
											<span class="post-time"><?= renderDate($reply['post_time'], true) ?></span>
											<?php if ($reply['isOwnMessage']): ?>
												<a class="tiny subtle button"
												   href="<?= BASE_PATH ?>/?p=delete&message=<?= $reply['id'] ?>">Delete</a>
											<?php endif ?>
										</div>

										<?= $reply['content'] ?>
									</div>
									<div class="clearfix"></div>
								</li>

							<?php endforeach ?>

						</ul>
					</div>

				<?php endif ?>

				<div class="clearfix"></div>

				<div id="message-<?= $message['id'] ?>-reply-form" class="reply-form message-form">

					<a class="small button visible-with-js" data-message="<?= $message['id'] ?>">Reply</a>
					<form action="<?= BASE_PATH ?>/?p=messages#message-<?= $message['id'] ?>"
					      data-message="<?= $message['id'] ?>" method="post"
						<?= $messageId === $message['id'] && $replyError ? '' : 'class="hidden-with-js"' ?>>
						<input type="hidden" name="message-id" value="<?= $message['id'] ?>" />
						<input type="hidden" name="token" value="<?= $token ?>" />
						<textarea name="reply-content" placeholder="Write a reply&hellip;"></textarea>
						<input class="small button" type="submit" name="post-reply" value="Post reply">
						<?php if ($messageId === $message['id'] && $replyError): ?>
							<div class="alert error">
								<?= join('<br />', $replyErrors) ?>
							</div>
						<?php endif ?>
					</form>

					<?php if ($messageId === $message['id'] && $newReplyId !== null): ?>
						<div id="reply-post-success" class="alert success">
							Your reply has been posted!
						</div>
					<?php endif ?>

				</div>

			</div>

		</div>

	<?php endforeach ?>

</div>

<script type="text/javascript" src="<?= BASE_PATH ?>/js/messages.js"></script>
