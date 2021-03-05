<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classe';

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

//lié entre eleve et eleve_information
$request = $bdd->prepare("
        SELECT el.prenom, el.nom, el.login, el.password, info.rue, info.cp, info.ville, info.pays
        FROM eleve as el
        INNER JOIN eleve_information as info ON el.information_id = info.id
");

$request->execute();

//lié entre eleve_competence et eleve
$request = $bdd->prepare("
        SELECT co.niveau, el.prenom, el.nom, el.login, el.password
        FROM eleve_competence as co
        INNER JOIN eleve as el ON co.eleve_id = el.id
");

$request->execute();

//lié entre eleve_competence et competence
$request = $bdd->prepare("
        SELECT elco.niveau, co.titre, co.description
        FROM eleve_competence as elco
        INNER JOIN competence as co ON elco.competence_id = co.id
");

$request->execute();

?>
