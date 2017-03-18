<nav>
	<ul>
		<li><span class="title">simpson</span></li>
		<?php foreach ($menuItems as $menuItem): ?>
			<li<?= $menuItem['name'] === $currentPageName ? ' class="active"' : '' ?>>
				<a href="?p=<?= $menuItem['name'] ?>"><?= $menuItem['caption'] ?? $menuItem['name'] ?></a>
			</li>
		<?php endforeach ?>
	</ul>
</nav>
