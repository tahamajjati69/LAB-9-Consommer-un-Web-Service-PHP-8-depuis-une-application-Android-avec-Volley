<?php
require_once __DIR__ . '/../dao/IDao.php';
require_once __DIR__ . '/../connexion/Connexion.php';
require_once __DIR__ . '/../classes/Etudiant.php';

class EtudiantService implements IDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    
     
    public function create($o) {
        try {
            if (empty($o->getNom()) || empty($o->getPrenom()) || empty($o->getVille()) || empty($o->getSexe())) {
                return false; // ne pas insérer si un champ est vide
            }

            $queryCheck = "SELECT COUNT(*) FROM Etudiant 
                           WHERE nom=:nom AND prenom=:prenom AND ville=:ville AND sexe=:sexe";
            $stmtCheck = $this->connexion->getConnexion()->prepare($queryCheck);
            $stmtCheck->execute([
                ':nom' => $o->getNom(),
                ':prenom' => $o->getPrenom(),
                ':ville' => $o->getVille(),
                ':sexe' => $o->getSexe()
            ]);

            if ($stmtCheck->fetchColumn() > 0) {
                // Étudiant déjà existant
                return false;
            }

            // Insertion
            $query = "INSERT INTO Etudiant (nom, prenom, ville, sexe)
                      VALUES (:nom, :prenom, :ville, :sexe)";
            $stmt = $this->connexion->getConnexion()->prepare($query);
            return $stmt->execute([
                ':nom' => $o->getNom(),
                ':prenom' => $o->getPrenom(),
                ':ville' => $o->getVille(),
                ':sexe' => $o->getSexe()
            ]);

        } catch (PDOException $e) {
            error_log("Erreur PDO: " . $e->getMessage());
            return false;
        }
    }

   
    public function findAllApi() {
        $req = $this->connexion->getConnexion()->query("SELECT * FROM Etudiant");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($o) {}
    public function findAll() {}
    public function findById($id) {}
    public function update($o) {}
}
?>