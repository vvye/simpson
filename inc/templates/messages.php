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
			<div class="replies">
				<h3>3 replies</h3>
				<ul>
					<li class="reply">
						<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
						<div class="content">
							<div class="info">
								<h4>name</h4>
								<span class="post-time">odifhgd odijgfoidjfg</span>
							</div>
							Nunquam imitari musa. Cum accola velum, omnes bursaes amor domesticus, flavum adgiumes. Est
							regius elevatus,
							cesaris. Lumen moris, tanquam altus devirginato. Bullas ridetis in hafnia! Candidatuss
							favere!
							Cum racana
							assimilant, omnes eleateses aperto festus, azureus messores.
						</div>
						<div class="clearfix"></div>
					</li>
					<li class="reply">
						<img class="avatar" src="<?= BASE_PATH ?>/img/avatars/default.png" />
						<div class="content">
							<div class="info">
								<h4>name</h4>
								<span class="post-time">odifhgd odijgfoidjfg</span>
							</div>
							Nunquam imitari musa. Cum accola velum, omnes bursaes amor domesticus, flavum adgiumes. Est
							regius elevatus,
							cesaris. Lumen moris, tanquam altus devirginato. Bullas ridetis in hafnia! Candidatuss
							favere!
							Cum racana
							assimilant, omnes eleateses aperto festus, azureus messores.
							Nunquam imitari musa. Cum accola velum, omnes bursaes amor domesticus, flavum adgiumes. Est
							regius elevatus,
							cesaris. Lumen moris, tanquam altus devirginato. Bullas ridetis in hafnia! Candidatuss
							favere!
							Cum racana
							assimilant, omnes eleateses aperto festus, azureus messores.
							Nunquam imitari musa. Cum accola velum, omnes bursaes amor domesticus, flavum adgiumes. Est
							regius elevatus,
							cesaris. Lumen moris, tanquam altus devirginato. Bullas ridetis in hafnia! Candidatuss
							favere!
							Cum racana
							assimilant, omnes eleateses aperto festus, azureus messores.
						</div>
						<div class="clearfix"></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<?php endforeach ?>