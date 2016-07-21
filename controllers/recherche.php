<?php

function recherche($bdd)
{
	if($_GET['genre'] != -1)
	{
		$genre_film = ' AND tp_film.id_genre = ' . $_GET['genre'];
	}

	else
	{
		$genre_film = '';
	}

	if($_GET['distrib'] != -1)
	{
		$distrib_film = ' AND tp_film.id_distrib = ' . $_GET['distrib'];
	}

	else
	{
		$distrib_film = '';
	}

	if($_GET['date_sceance'] != -1)
	{
		$date_film = ' INNER JOIN tp_grille_programme ON tp_film.id_film = tp_grille_programme.id_film ' ;
		$date_film2 = ' AND tp_grille_programme.debut_sceance = "' . $_GET['date_sceance']. '"';
	}

	else
	{
		$date_film = '';
		$date_film2 = '';
	}

	$sql = 'SELECT COUNT(tp_film.titre) as numLigne FROM tp_film ' .$date_film  . 'WHERE tp_film.titre LIKE "%' . $_GET["recherche"] .'%"' . $genre_film . $distrib_film . $date_film2 . ' ORDER BY tp_film.titre ASC';
	$requete = $bdd->query($sql);
	$data= $requete->fetch();
	$numLigne = $data['numLigne'];
	$elementParPage = 10;
	$nbreTotalPage = ceil($numLigne/$elementParPage);

	if (isset($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nbreTotalPage) {
		$numPage = $_GET['page'];
	}
	else
	{
		$numPage = 1;
	}

	for ($i = 1; $i <= $nbreTotalPage; $i++) { 
		?><a href="result.php?genre=<?= $_GET['genre'] ?>&distrib=<?= $_GET['distrib'] ?>&date_sceance=<?= $_GET['date_sceance'] ?>&recherche=<?= $_GET['recherche'] ?>&bouton=Recherche&page=<?= $i ?>"><?= $i . " | " ?></a>
		<?php
	}
	$num = ($numPage-1)*$elementParPage;
	$sql = 'SELECT tp_film.titre FROM tp_film ' .$date_film  . 'WHERE tp_film.titre LIKE "%' . $_GET["recherche"] .'%"' . $genre_film . $distrib_film . $date_film2 . ' ORDER BY tp_film.titre ASC LIMIT ' . $num .',' . $elementParPage;
	$requete = $bdd->prepare($sql);
	$requete->execute();
	$result = $requete->fetchAll();
	foreach ($result as $key => $value) {
		echo $value["titre"] . "<br>";
	}
}

function listeGenre($bdd)
{
	$sql = 'SELECT tp_genre.id_genre, tp_genre.nom FROM tp_genre ORDER BY tp_genre.nom ASC';
	$requete = $bdd->query($sql);
	while($data= $requete->fetch()) {
		?><option value=<?php echo $data["id_genre"];?>><?php echo $data["nom"];?></option>
		<?php
	}
}

function listeDistrib($bdd)
{
	$sql = 'SELECT tp_distrib.id_distrib, tp_distrib.nom FROM tp_distrib ORDER BY tp_distrib.nom ASC';
	$requete = $bdd->query($sql);
	while($data= $requete->fetch()) {
		?><option value=<?php echo $data["id_distrib"];?>><?php echo $data["nom"];?></option>
		<?php
	}
}

function listeDate($bdd)
{
	$sql = 'SELECT tp_grille_programme.debut_sceance FROM tp_grille_programme ORDER BY tp_grille_programme.debut_sceance ASC';
	$requete = $bdd->query($sql);
	while($data= $requete->fetch()) {
		?><option value=<?php echo $data["debut_sceance"];?>><?php echo $data["debut_sceance"];?></option>
		<?php
	}
}