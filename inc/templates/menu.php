<nav>
	<ul>
		<li><h1>simpson</h1></li>
		<?php foreach ($menuItems as $menuItem): ?>
			<li><a href="?p=<?= $menuItem['name'] ?>"><?= $menuItem['caption'] ?? $menuItem['name'] ?></a></li>
		<?php endforeach ?>
	</ul>
</nav>
