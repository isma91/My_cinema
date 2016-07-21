<?php include '../model/connexionbdd.php'; 
include '../controllers/recherche.php';
?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'header.html'; ?>
<body>
	<div id="site">
		<?php include 'menu.html'; ?>
		<?php
		if (isset($_GET["bouton"])) {
			recherche($bdd);
		}
		?>
	</div>
</body>
</html>