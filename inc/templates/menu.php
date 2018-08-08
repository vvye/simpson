<nav>
	<ul>
		<li><span class="title">simpson</span></li>
		<?php foreach ($menuItems as $menuItem): ?>
			<?php if ($menuItem['condition'] ?? true): ?>
				<li<?= $menuItem['name'] === $currentPageName ? ' class="active"' : '' ?>>
					<a href="<?= $menuItem['link'] ?? (BASE_PATH . '/' . $menuItem['name']) ?>">
						<?= $menuItem['caption'] ?? $menuItem['name'] ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</nav>
