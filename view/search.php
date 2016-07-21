<?php include '../model/connexionbdd.php';
include '../controllers/recherche.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'header.html'; ?>
<body>
	<div id="site">
		<?php include 'menu.html'; ?>
		<section>
			<h2>Bienvenue dans la section recherche du Cine Campus !!</h2>
			<article>
				<h3>Comment faire une recherche ??</h3>
				<p>Faite une recherche via la barre de recherche sur votre film que vous voulez, suivant son nom, sa date, son genre etc...</p>
			</article>
			<form action="result.php" method="get">
				<label>Genre :</label>
				<select name="genre">
					<option value="-1" name="none">none</option>
					<?php listeGenre($bdd); ?>
				</select>
				<label>Distributeur :</label>
				<select name="distrib">
					<option value="-1" name="none">none</option>
					<?php listeDistrib($bdd); ?>
				</select>
				<label>Date de sortie :</label>
				<select name="date_sceance">
					<option value="-1" name="none">none</option>
					<?php listeDate($bdd); ?>
				</select>
				<label for="recherche">Recherche :</label>
				<input type="text" name="recherche" placeholder="Titre du film">
				<input name="bouton" value="Recherche" type="submit" />
			</form>
		</section>
	</section>
</div>
</body>
</html>