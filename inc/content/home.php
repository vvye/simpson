<?php

	require_once 'inc/functions/forms.php';

?>

<div class="pure-g">
	<div class="pure-u-1-2">
		<div class="l-box">
			<h1 class="title">simpson</h1>

			<p>a <em>simp</em>le <em>so</em>cial <em>n</em>etwork</p>

			<p>Hello world! Insert some kind of message here, such as "welcome to my awesome site", "simpson
				is the leading provider of social networks worldwide", and other blatant lies.</p>

			<?php

				renderLoginForm();

			?>

		</div>
	</div>
	<div class="pure-u-1-2">
		<div class="l-box text-center">

			<?php

				renderRegisterForm();

			?>

		</div>
	</div>
</div>
