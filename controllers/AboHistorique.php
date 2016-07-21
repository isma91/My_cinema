<?php 
function abonnement($bdd)
{
    $sql = 'SELECT * FROM tp_abonnement ORDER BY prix ASC';
    $requete = $bdd->prepare($sql);
    $requete->execute();
    $result = $requete->fetchAll();
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?php echo $value["nom"];?></td>
            <td><?php echo $value["resum"];?></td>
            <td><?php echo $value["prix"];?></td>
            <td><?php echo $value["duree_abo"];?></td>
        </tr>
        <?php
    }
}

function reduction($bdd)
{
    $sql = 'SELECT tp_reduction.nom, tp_reduction.pourcentage_reduc FROM tp_reduction ORDER BY pourcentage_reduc DESC';
    $requete = $bdd->prepare($sql);
    $requete->execute();
    $result = $requete->fetchAll();
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?php echo $value["nom"];?></td>
            <td><?php echo $value["pourcentage_reduc"];?></td>
        </tr>
        <?php
    }
}

function listeMembre($bdd)
{
    $sql = "SELECT COUNT(*) AS \"numLigne\" FROM tp_fiche_personne";
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
        ?><a href="membre.php?page=<?= $i ?>"><?= $i . " | " ?></a>
        <?php
    }
    $num = ($numPage-1)*$elementParPage;
    $sql = 'SELECT * FROM tp_fiche_personne INNER JOIN tp_membre ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso ORDER BY tp_fiche_personne.nom ASC LIMIT ' . $num .',' . $elementParPage;
    $requete = $bdd->prepare($sql);
    $requete->execute();
    $result = $requete->fetchAll();
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?php echo $value["nom"];?></td>
            <td><?php echo $value["prenom"];?></td>
            <td><?php echo $value["date_naissance"];?></td>
            <td><?php echo $value["email"];?></td>
            <td><?php echo $value["adresse"];?></td>
            <td><?php echo $value["cpostal"];?></td>
            <td><?php echo $value["ville"];?></td>
            <td><?php echo $value["pays"];?></td>
            <td><a href="historique.php?id_perso=<?= $value['id_perso'] ?>">Voir historique</a></td>
        </tr>
        <?php
    }
}

function listeHistorique($bdd)
{
    $sql = 'SELECT tp_fiche_personne.nom AS nom_personne, tp_fiche_personne.prenom, tp_membre.id_abo, tp_abonnement.nom AS nom_abonnement, tp_historique_membre.id_film, tp_film.titre, tp_historique_membre.date, tp_membre.date_abo, tp_membre.date_inscription, tp_historique_membre.avis FROM tp_membre INNER JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso INNER JOIN tp_historique_membre ON tp_membre.id_membre = tp_historique_membre.id_membre INNER JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film 
    INNER JOIN tp_abonnement ON tp_membre.id_abo = tp_abonnement.id_abo WHERE tp_fiche_personne.id_perso = ' .$_GET['id_perso'] . ' ORDER BY tp_historique_membre.date DESC';
    $requete = $bdd->prepare($sql);
    $requete->execute();
    $result = $requete->fetchAll();
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?php echo $value["nom_personne"];?></td>
            <td><?php echo $value["prenom"];?></td>
            <td><?php echo $value["id_abo"];?></td>
            <td><?php echo $value["nom_abonnement"];?></td>
            <td><?php echo $value["id_film"];?></td>
            <td><?php echo $value["titre"];?></td>
            <td><?php echo $value["date"];?></td>
            <td><?php echo $value["date_abo"];?></td>
            <td><?php echo $value["date_inscription"];?></td>
            <td><?php echo $value["avis"]; ?></td>
        </tr>
        <?php
    }
}

function listeId_film($bdd)
{
    $sql = 'SELECT tp_fiche_personne.nom AS nom_personne, tp_fiche_personne.prenom, tp_membre.id_abo, tp_abonnement.nom AS nom_abonnement, tp_historique_membre.id_film AS historique_id_film , tp_film.titre, tp_historique_membre.date, tp_membre.date_abo, tp_membre.date_inscription, tp_historique_membre.avis FROM tp_membre INNER JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso INNER JOIN tp_historique_membre ON tp_membre.id_membre = tp_historique_membre.id_membre INNER JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film INNER JOIN tp_abonnement ON tp_membre.id_abo = tp_abonnement.id_abo WHERE tp_fiche_personne.id_perso = ' .$_GET['id_perso'] . ' ORDER BY tp_film.titre ASC';
    $requete = $bdd->query($sql);
    while($data= $requete->fetch()) {
        ?><option value=<?php echo $data["historique_id_film"];?>><?php echo $data["titre"];?></option>
        <?php
    }
}

function listeAbo($bdd)
{
    $sql = 'SELECT tp_abonnement.id_abo, tp_abonnement.nom FROM tp_abonnement';
    $requete = $bdd->query($sql);
    while($data= $requete->fetch()) {
        ?><option value=<?php echo $data["id_abo"];?>><?php echo $data["nom"];?></option>
        <?php
    }
}

function changeAbo($bdd)
{
    $sql1 ='UPDATE tp_membre SET tp_membre.id_abo = ' .$_GET['abo'] . ' , tp_membre.date_abo = CURDATE() WHERE id_fiche_perso = ' . $_GET['id_perso'];
    $requete = $bdd->query($sql1);
    echo "<script>alert(\"Abonnement changer avec succès !! >^_^>  <^_^<  >^_^>\")</script>";
}

function currentId_perso($bdd)
{
    $sql = 'SELECT tp_historique_membre.id_membre ,tp_fiche_personne.id_perso, tp_fiche_personne.nom, tp_fiche_personne.prenom FROM tp_historique_membre INNER JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre INNER JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso WHERE tp_fiche_personne.id_perso = '.$_GET['id_perso'] . ' GROUP BY tp_fiche_personne.id_perso';
    $requete = $bdd->query($sql);
    while($data= $requete->fetch()) {
        ?><option value=<?php echo $data["id_perso"];?>><?php echo $data["nom"]; ?> <?php echo $data["prenom"]; ?></option>
        <?php
    }
}

function changeAvis($bdd)
{
    $sql ='UPDATE tp_historique_membre, tp_membre, tp_fiche_personne SET tp_historique_membre.avis = " ' . $_GET['avis'] . ' "' . ' WHERE id_film = ' .$_GET['id_film'] . ' && tp_membre.id_membre = tp_historique_membre.id_membre && tp_membre.id_fiche_perso = tp_fiche_personne.id_perso && tp_fiche_personne.id_perso = ' .$_GET['id_perso'];
    $requete = $bdd->query($sql);
}

function listeFilm($bdd)
{
    $sql = 'SELECT tp_film.id_film, tp_film.titre FROM tp_film ORDER BY titre ASC';
    $requete = $bdd->query($sql);
    while($data= $requete->fetch()) {
        ?><option value=<?php echo $data["id_film"];?>><?php echo $data["titre"];?></option>
        <?php
    }
}

function currentId_membre($bdd)
{
    $sql = 'SELECT tp_historique_membre.id_membre ,tp_fiche_personne.id_perso, tp_fiche_personne.nom, tp_fiche_personne.prenom FROM tp_historique_membre INNER JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre INNER JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso WHERE tp_membre.id_fiche_perso = '.$_GET['id_perso'] . ' GROUP BY tp_membre.id_membre';
    $requete = $bdd->query($sql);
    while($data= $requete->fetch()) {
        ?><option value=<?php echo $data["id_membre"];?>><?php echo $data["nom"]; ?> <?php echo $data["prenom"]; ?></option>
        <?php
    }
}

function ajouterHistorique($bdd)
{
    $sql = 'INSERT INTO tp_historique_membre (id_membre, id_film, date) VALUE ( ' .$_GET["id_membre"] .', ' .$_GET["film"] . ', CURDATE() )';
    $requete = $bdd->query($sql);
    echo "<script>alert(\"historique ajouter avec succès !! >^_^>  <^_^<  >^_^>\")</script>";
}
?>