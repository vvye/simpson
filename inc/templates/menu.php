<nav>
	<ul>
		<?php foreach ($menuItems as $menuItem): ?>
			<li><a href="<?= $menuItem['name'] ?>"><?= $menuItem['caption'] ?? $menuItem['name'] ?></a></li>
		<?php endforeach ?>
	</ul>
</nav>
