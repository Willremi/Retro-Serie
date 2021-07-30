<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{
    /**
     * Inscription (ou création) des utilisateurs
     * @return void
     */
    public function register()
    {
        // Vérification du formulaire
        if (Form::validate($_POST, ['email', 'pseudo', 'password'])) {
            // Nettoyage de l'e-mail et pseudo puis chiffrage du mot de passe
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars(trim($_POST['email']));
            } else {
                $_SESSION['error'] = "Votre saisie de mail non conforme";
            }
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);

            // Hydratation de l'utilisateur
            $user = new UsersModel;
            $userVerif = $user->findOneByEmail($email);
            $roles = json_encode($user->getRoles());
            // $actif = $user->getActif();
            // $roles = json_encode(['ROLE_USER']);
            
            // var_dump($userVerif);
            if(!$userVerif) {
            $user->setEmail($email)
            ->setPseudo($pseudo)
            ->setPassword($pass)
            // ->setRoles(json_encode($roles))
            ->setActif(1);
            
            // Stockage de l'utilisateur dans la BDD
                // var_dump($user);
                $user->create();

            } else {
                $_SESSION['error'] = "Compte déjà existant, veuillez saisir une autre adresse mail";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $_SESSION['message'] = "Votre compte a bien été enregistré";
        }

        $form = new Form;

        $form->debutForm($method="post", $action="#", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('email', 'E-mail')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->finDiv()
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('pseudo', 'Pseudo')
            ->ajoutInput('text', 'pseudo', ['class' => 'form-control', 'id' => 'pseudo'])
            ->finDiv()
            ->ajoutLabelFor('password', 'Mot de passe')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->ajoutBouton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('users/register', ['registerForm' => $form->create()]);
    }

    /**
     * Connexion de l'utilisateur
     * @return void
     */
    public function login()
    {
        // Vérification si le formulaire est complet
        if (Form::validate($_POST, ['email', 'password'])) {
            // Le formulaire est complet
            // Recherche dans la BDD, l'utilisation avec l'email entré
            $userModel = new UsersModel;
            $userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));

            // Si l'utilisateur n'existe pas
            if (!$userArray) {
                // http_response_code(404);
                // On envoie un message de session
                $_SESSION['error'] = "L'adresse mail et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }

            // L'utilisateur existe
            $user = $userModel->hydrate($userArray);

            // Vérification du Mdp 
            if (password_verify($_POST['password'], $user->getPassword())) {
                // Mdp OK
                $user->setSession();
                header('Location: /');
            } else {
                // Mauvais Mdp
                $_SESSION['error'] = "L'adresse mail et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }
        }

        $form = new Form;

        $form->debutForm($method="post", $action="#", ['class' => 'row g-3'])
        ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('email', 'E-mail')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('password', 'Mot de passe')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Me connecter', ['class' => 'btn btn-primary'])
            ->finDiv()
            ->finForm();

        $this->render('users/login', ['loginForm' => $form->create()]);
    }

    /**
     * Déconnexion de l'utilisateur
     * @return exit
     */
    public function logout()
    {
        unset($_SESSION['user']);
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        header('Location: /');
        exit;
    }

    /**
     * Méthode permettant d'afficher le profil de l'utilisateur à partir d'un slug
     *
     * @param integer $id
     * @return void
     */
    public function profil(int $id)
    {
        $model = new UsersModel;
        $user = $model->find($id);
        $this->render('users/profil', compact('user'));
    }

    /**
     * Modifier un utilisateur
     * @param integer $id
     * @return void
     */
    public function modifier(int $id) {
        // Vérification de la connexion de l'utlisateur
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            // Instancie le modèle
            $userModel = new UsersModel;

            // Recherche de l'utilisateur avec l'id $id
            $user = $userModel->find($id);

            //Traitemant du formulaire
            if(Form::validate($_POST, ['email', 'pseudo'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = htmlspecialchars(trim($_POST['email']));
                } else {
                    $_SESSION['error'] = "Votre saisie de mail non conforme";
                }
                $pseudo = htmlspecialchars(trim($_POST['pseudo']));
                // $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);

                $userModif = new UsersModel;
                
                $userModif->setId($user->id)
                    ->setEmail($email)
                    ->setPseudo($pseudo);
                    
                // Mettre à jour le profil
                $userModif->update();
                // var_dump($userModif->update());

                // Redirection
                $_SESSION['message'] = "Votre profil a été modifié avec succès";
                unset($_SESSION['user']);
                header('Location: /');
                exit;
            }

            $form = new Form;

            $form->debutForm($method="post", $action="#", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('email', 'E-mail')
            ->ajoutInput('email', 'email', [
                'class' => 'form-control', 
                'id' => 'email', 
                'value' => $user->email
                ])
            ->finDiv()
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('pseudo', 'Pseudo')
            ->ajoutInput('text', 'pseudo', [
                'class' => 'form-control', 
                'id' => 'pseudo', 
                'value' => $user->pseudo
                ])
            ->finDiv()
            // ->ajoutLabelFor('password', 'Mot de passe')
            // ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->debutDiv()
            ->ajoutBouton('Modifier', ['class' => 'btn btn-primary'])
            ->finDiv()
            ->finForm();

            $this->render('users/modifier', ['form' => $form->create()]);
        } else {
            $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page";

            header('Location: /users/login');
            exit;
        }
    }

    /**
     * Supprimer un utilisateur
     * @param integer $id
     * @return void
     */
    public function supprimeUser(int $id)
    {
        // On vérifie si l'utilisateur est connecté
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            // Instancie le modèle
            $userModel = new UsersModel;
            $user = $userModel->find($id);
            $userModel->setId($user->id)
                    ->setActif(0);
            $userModel->update();
            // $userModel->delete($id);
            // var_dump($userModel);

            // Redirection
            $_SESSION['message'] = "Votre profil a été supprimé avec succès";
            unset($_SESSION['user']);
            header('Location: /');
        } else {
            $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page";

            header('Location: /users/login');
            exit;
        }
    }
}
