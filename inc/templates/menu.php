<nav>
	<ul>
		<li><span class="title">simpson</span></li>
		<?php foreach ($menuItems as $menuItem): ?>
			<li><a href="?p=<?= $menuItem['name'] ?>"><?= $menuItem['caption'] ?? $menuItem['name'] ?></a></li>
		<?php endforeach ?>
	</ul>
</nav>