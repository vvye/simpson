<nav>
	<ul>
		<li><span class="title"><?= SITE_NAME ?></span></li>
		<?php foreach ($menuItems as $menuItem): ?>
			<?php if ($menuItem['condition'] ?? true): ?>
				<li<?= $menuItem['active'] ? ' class="active"' : '' ?>>
					<a href="<?= $menuItem['link'] ?? (BASE_PATH . '/?p=' . $menuItem['name']) ?>">
						<?= $menuItem['caption'] ?? $menuItem['name'] ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</nav>
