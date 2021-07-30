<?php

namespace App\Core;

class Form
{
    private $formCode = '';

    /**
     * Génére un formulaire HTML
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Valide si tous les champs proposés sont remplis
     * @param array $form Tableau contenant les champs à vérifier (en général issu de $_POST ou $_GET)
     * @param array $fields Tableau listant les champs à vérifier
     * @return bool
     */
    public static function validate(array $form, array $fields)
    {
        // Parcourt chaque champ
        foreach($fields as $field) {
            // Si le champ est absent ou vide dans le tableau
            if (!isset($form[$field]) || empty($form[$field])) {
                // Sortir en retournant false
                return false;
            }
        }
        // Ici le formulaire est 'valide'
        return true;
    }

    /**
     * Ajout des attributs envoyés à la balise
     *
     * @param array $attributs Tableau associatif ['class' => 'form-control', 'required' => true]
     * @return string Chaîne de caractères générée
     */
    private function ajoutAttributs (array $attributs)
    {
        // initialisation d'une chaîne de caractères
        $str = '';

        // Liste des attributs "courts"
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // Boucle sur le tableau d'attributs
        foreach($attributs as $attribut => $value) {
            // Si l'attribut est dans la liste des attributs courts
            if(in_array($attribut, $courts) && $value == true) {
                $str .= " $attribut";
            } else {
                // Ajout attribut = 'valeur'
                $str .= " $attribut=\"$value\"";
            }
        }
        return $str;
    }

    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $methode Méthode du formulaire (post ou get)
     * @param string $action Action du formulaire
     * @param array $attributs Attributs
     * @return Form
     */
    public function debutForm(string $methode = 'post', string $action ='#', array $attributs = []): self
    {
        // Création de la balise form
        $this->formCode .= "<form action='$action' method='$methode'";

        // Ajout des attributs éventuels
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';

        return $this;
    }

    public function finForm()
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Ajout d'un label
     *
     * @param string $for
     * @param string $texte
     * @param array $attributs
     * @return Form
     */
    public function ajoutLabelFor(string $for, string $texte, array $attributs = [])
    {
        // Ouverture de la balise
        $this->formCode .= "<label for='$for'";

        // Ajout des attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // Ajout d'un texte
        $this->formCode .= ">$texte</label>";

        return $this;
    }

    /**
     * Ajout d'un input
     *
     * @param string $type
     * @param string $nom
     * @param array $attributs
     * @return Form
     */
    public function ajoutInput(string $type, string $nom, array $attributs = [])
    {
        // Ouverture de la balise
        $this->formCode .= "<input type='$type' name='$nom'";

        // Ajout des attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';

        return $this;
    }

    /**
     * Ajout d'un champ textarea
     *
     * @param string $nom
     * @param string $value
     * @param array $attributs
     * @return Form
     */
    public function ajoutTextarea (string $nom, string $value, array $attributs = [])
    {
        // Ouverture de la balise
        $this->formCode .= "<textarea name='$nom'";

        // Ajout des attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // Ajout de texte
        $this->formCode .= ">$value</textarea>";

        return $this;
    }

    /**
     * Liste déroulante
     * @param string $nom
     * @param array $options Liste des options (tableau associatif)
     * @param array $attributs
     * @return Form
     */
    public function ajoutSelect(string $nom, array $options, array $attributs = [])
    {
        // Création de select
        $this->formCode .= "<select name='$nom'";

        // Ajout des attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';

        // Ajout d'options
        foreach ($options as $value => $texte) {
            $this->formCode .= "<option value=\"$value\">$texte</option>";
            
        }

        // Fermeture de la balise
        $this->formCode .= "</select>";

        return $this;
    }

    /**
     * Ajout d'un bouton
     *
     * @param string $texte
     * @param array $attributs
     * @return Form
     */
    public function ajoutBouton(string $texte, array $attributs = [])
    {
        // Ouverture de la balise
        $this->formCode .= "<button";

        // Ajout des attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // Ajout du texte
        $this->formCode .= ">$texte</button>";

        return $this;
    }

    /**
     * Ajout d'une div
     *
     * @param array $attributs
     * @return Form
     */
    public function debutDiv(array $attributs = [])
    {
        $this->formCode .= "<div";

        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';

        return $this;
    }

    public function finDiv()
    {
        $this->formCode .= "</div>";
        return $this;
    }
}