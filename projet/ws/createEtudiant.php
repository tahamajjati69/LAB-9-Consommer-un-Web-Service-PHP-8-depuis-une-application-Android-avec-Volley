<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once __DIR__ . '/../service/EtudiantService.php';
    require_once __DIR__ . '/../classes/Etudiant.php';

    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : null;
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : null;
    $ville = isset($_POST['ville']) ? trim($_POST['ville']) : null;
    $sexe = isset($_POST['sexe']) ? trim($_POST['sexe']) : null;

    if (!empty($nom) && !empty($prenom) && !empty($ville) && !empty($sexe)) {

        $es = new EtudiantService();
        $etudiant = new Etudiant(0, $nom, $prenom, $ville, $sexe);

        $es->create($etudiant);

        header('Content-Type: application/json');
        echo json_encode($es->findAllApi());

    } else {
        echo json_encode(["error" => "Champs manquants"]);
    }

} else {
    echo json_encode(["message" => "API fonctionne - utilisez POST"]);
}
?>