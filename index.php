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

echo "Les élèves et leurs informations";
//lié entre eleve et eleve_information
$request = $bdd->prepare("
        SELECT el.prenom, el.nom, el.login, el.password, info.rue, info.cp, info.ville, info.pays
        FROM eleve as el
        INNER JOIN eleve_information as info ON el.information_id = info.id
");

$request->execute();

echo "<pre>";
print_r($request->fetchAll());
echo "</pre>";

echo "Les compétences des élèves et leur niveau dans ses compétences";

//lié entre eleve_competence, eleve et competence
$request = $bdd->prepare("
        SELECT elco.niveau, co.titre, co.description, el.nom, el.nom, el.login, el.password
        FROM eleve_competence as elco
        INNER JOIN eleve as el ON elco.eleve_id = el.id
        INNER JOIN competence as co ON elco.competence_id = co.id
");

$request->execute();

echo "<pre>";
print_r($request->fetchAll());
echo "</pre>";


include "script.js";
?>
