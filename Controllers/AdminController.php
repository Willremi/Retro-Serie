<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class AdminController extends Controller
{
    public function index()
    {
        // Vérification si l'utilisateu est admin
        if ($this->isAdmin()) {
            $this->render('admin/index', [], 'admin');
        }
    }

    /**
     * Affichage de la liste des utilisateurs sous forme de tableau
     * @return void
     */
    public function users()
    {
        if ($this->isAdmin()) {
            $usersModel = new UsersModel;

            $users = $usersModel->findAll();

            $this->render('admin/users', compact('users'), 'admin');
        }
    }


    public function actifUser(int $id)
    {
        if($this->isAdmin()){
            $usersModel = new UsersModel;
            $userArray = $usersModel->find($id);

            if($userArray) {
                $user = $usersModel->hydrate($userArray);
                
                // if($user->getActif()) {
                //     $user->setActif(1);

                // } else {
                //     $user->setActif(0);
                // }
                
                $user->setActif($user->getActif() ? 0 : 1);
                $user->update();
                
                
            }
        }
    }

    /**
     * Vérification si on est admin
     * @return boolean
     */
    private function isAdmin()
    {
        // Vérification si on est connecté et si "ROLE_ADMIN" est dans le roles de BDD
        if (isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
            // Admin OK
            return true;
        } else {
            $_SESSION['error'] = "Vous n'avez pas accès à cette zone";
            header('Location: /');
            exit;
        }
    }
}
