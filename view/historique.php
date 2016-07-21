<?php include '../model/connexionbdd.php';
include '../controllers/AboHistorique.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'header.html'; ?>
<body>
	<div id="site">
		<?php include 'menu.html'; ?>
		<section>
			<form action="#" method="get">
				<label>Bienvenue :</label>
				<select name="id_perso">
					<?php currentId_perso($bdd); ?>
				</select>
				<label>Changer son Abonnement :</label>
				<select name="abo">
					<?php listeAbo($bdd) ?>
				</select>
				<input name="bouton_abo" value="Valider Abonnement" type="submit" />
				<label>Donner son Avis :</label>
				<select name="id_film">
					<?php listeId_film($bdd); ?>
				</select>
				<textarea name="avis" rows="10" cols="20"></textarea>
				<input name="bouton_avis" value="Envoyer Avis" type="submit" />
				<?php if (isset($_GET['bouton_avis'])) {
					changeAvis($bdd);
				} 
				?>
				<label>Ajouter Historique :</label>
				<select name="id_membre">
					<?php currentId_membre($bdd); ?>
				</select>
				<select name="film">
					<?php listeFilm($bdd); ?>
				</select>
				<input name="bouton_ajouter" value="Ajouter Historique" type="submit" />
				<?php if (isset($_GET['bouton_ajouter'])) {
					ajouterHistorique($bdd);
				}
				?>
			</form>
			<?php
			if (isset($_GET["bouton_abo"])) {
				changeAbo($bdd);
			}
			?>
			<h2>Historique du membre :</h2>
			<table>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>id Abonnement</th>
					<th>Nom Abonnement</th>
					<th>id Film</th>
					<th>Titre</th>
					<th>Date de vue</th>
					<th>Date Abonnement</th>
					<th>Date d'Inscription</th>
					<th>Avis</th>
				</tr>		
				<?php listeHistorique($bdd); ?>
			</table>
		</section>
	</div>
</body>
</html>