<?php include '../model/connexionbdd.php';
include '../controllers/AboHistorique.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'header.html'; ?>
<body>
	<div id="site">
		<?php include 'menu.html'; ?>
		<section>
			<h2>Liste des abonnements :</h2>
			<table>
				<tr>
					<th>Nom</th>
					<th>Résumé</th>
					<th>Prix</th>
					<th>Durée de l'Abonnement ( en jours )</th>
				</tr>		
				<?php abonnement($bdd); ?>
			</table>
			<h2>Liste des réductions :</h2>
			<table>
				<tr>
					<th>Nom</th>
					<th>Réduction ( en % )</th>
				</tr>		
				<?php reduction($bdd); ?>
			</table>
		</section>
	</div>
</body>
</html>