<?php

	require_once 'inc/functions/database.php';

	if (!isLoggedIn())
	{
		header('Location: index.php');
	}

	$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['userId'];

	$database = getDatabase();
	$result = $database->select('users', '*', [
		'id' => $id
	]);
	if (!empty($result) && count($result) === 1)
	{
		$user = $result[0];
	}
	else
	{
		die("unknown user.");
	}

?>

<div class="pure-g">
	<div class="pure-u-1 pure-u-lg-1-8">
		<img class="pure-img" src="img/avatars/default.png"/>
	</div>
	<div class="pure-u-1 pure-u-lg-7-8">
		<div class="main-user-info">
			<h1><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h1>
			<?php
				if ($user['email_public'])
				{
					$email = str_replace(['@', '.'], [' <em>at</em> ', ' <em>dot</em> '], $user['email']);
					echo '<p>' . $email . '</p>';
				}
			?>
			<p>Fiscinas tolerare in tubinga! Cur clinias observare? Est lotus equiso, cesaris. Caesium, vita, et
				compater.
				Eheu, lamia! Est magnum bursa, cesaris. Secundus, audax particulas sed mire promissio de fatalis, salvus
				musa. Visuss sunt nomens de varius fides.</p>
		</div>
	</div>
</div>
