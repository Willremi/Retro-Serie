<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    // Table de la base de données
    protected $table;

    // Instance de connexion
    private $db;

    /**
     * Sélection de tous les enregistrements de la table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * Sélection de plusieurs enregistrement suivant un tableau de critères
     * @param array $criteres Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        // Boucler pour "éclater le tableau"
        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // Transformation du tableau en chaîne de caractères séparée par des AND
        $liste_champs = implode(' AND ', $champs);

        // Exécution de la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    /**
     * Sélection d'un enregistrement suivant son id
     * @param integer $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        // Exécution de la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    /**
     * Insertion d'un enregistrement suivant un tableau de données
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        // Boucler pour "éclater le tableau"
        foreach($this as $champ => $valeur) {
            // INSERT INTO users (email, pseudo, password) VALUES (?, ?, ?)
            if($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        // Transformation du tableau en chaîne de caractères séparée par des AND
        $liste_champs = implode(', ', $champs);
        $liste_inter= implode(', ', $inter);

        // Exécution de la requête
        return $this->requete("INSERT INTO {$this->table} ($liste_champs) VALUES ($liste_inter)", $valeurs);
    }

    /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        // Boucler pour "éclater le tableau"
        foreach($this as $champ => $valeur) {
            // UPDATE users SET email = ?, pseudo = ?, password = ? WHERE id = ?
            if($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $this->id;

        // Transformation du tableau en chaîne de caractères séparée par des AND
        $liste_champs = implode(', ', $champs);

        // Exécution de la requête
        return $this->requete("UPDATE {$this->table} SET {$liste_champs} WHERE id = ?", $valeurs);
    }

    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Méthode qui exécutera les requêtes
     * @param string $sql Requête SQL à exécuter
     * @param array $attributs Attributs à ajouter à la requêtr
     * @return PDOStatement|false
     */
    public function requete(string $sql, array $attributs = null)
    {
        // Récupération de l'instance de Db
        $this->db = Db::getInstance();

        // Vérification si il y a des attributs
        if ($attributs !== null) {
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }

    /**
     * Hydratation des données
     */
    public function hydrate($donnees)
    {
        foreach($donnees as $key => $value) {
            // Récupération le nom du setter correspond à l'attribut
            $setter = 'set'. ucfirst($key);

            // Vérification de l'existence du setter
            if(method_exists($this, $setter)) {
                // Appel du setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}
