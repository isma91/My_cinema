<?php include '../model/connexionbdd.php';
include '../controllers/AboHistorique.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'header.html'; ?>
<body>
	<div id="site">
		<?php include 'menu.html'; ?>
		<section>
			<h2>Liste des membres :</h2>
			<table>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Date de naissance</th>
					<th>eMail</th>
					<th>Adresse</th>
					<th>Code Postal</th>
					<th>Ville</th>
					<th>Pays</th>
					<th>Historique</th>
				</tr>
				<?php listeMembre($bdd);
				?>
			</table>
		</section>
	</div>
</body>
</html>