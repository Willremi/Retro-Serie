<?php

namespace App\Controllers;

use App\Core\Form;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller
{
    public function index()
    {
        
        $form = new Form;

        $form->debutForm($methode="post", $action = "contact/traitement", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('nom', 'Nom : ')
            ->ajoutInput('text', 'nom', ['class' => 'form-control', 'id' => 'nom'])
            ->finDiv()
            ->debutDiv(['class' => 'col-md-6'])
            ->ajoutLabelFor('prenom', 'Prénom : ')
            ->ajoutInput('text', 'prenom', ['class' => 'form-control', 'id' => 'prenom'])
            ->finDiv()
            ->ajoutLabelFor('email', 'E-mail : ')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('sujet', 'Sujet : ')
            ->ajoutInput('text', 'sujet', ['class' => 'form-control', 'id' => 'sujet'])
            ->ajoutLabelFor('message', 'Message : ')
            ->ajoutTextarea('message', '', ['class' => 'form-control', 'id' => 'message'])
            ->ajoutBouton('Envoyer', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('contact/index', ['contactForm' => $form->create()], 'default');
    }

    public function traitement()
    {
        // Vérification si le formulaire est complet
        if (Form::validate($_POST, ['nom', 'prenom', 'email', 'sujet', 'message'])) {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars(trim($_POST['email']));
            } else {
                $_SESSION['error'] = "Votre saisie de mail non conforme";
            }
            $sujet = htmlspecialchars(trim($_POST['sujet']));
            $message = htmlspecialchars(trim($_POST['message']));

            $mail = new PHPMailer(true);

            try {
                // Configuration de SMTP
                $mail->isSMTP();
                $mail->Host = "localhost";
                $mail->Port = 1025;

                // Charset
                $mail->CharSet = "utf-8";

                // Destinataires
                $mail->addAddress("contact@retroTv.fr");
                $mail->addCC("copie@retroTv.fr");

                // Expéditeur
                $mail->setFrom("$email");

                // Contenus
                $mail->isHTML();

                $mail->Subject = $sujet;
                $mail->Body = <<<EOT
                <style>
                    body { font-family: Arial, sans-serif;}
                </style>
                <h1>Formulaire de contact du site Rétro TV : </h1>
                <h3>Message de $nom $prenom</h3>
                <p><u>Sujet :</u> $sujet</p>
                <p><u>Message :</u></p><p>$message</p>
EOT;
                // Envoie
                $mail->send();
                $_SESSION['message'] = "Message envoyé";
            } catch (Exception $e) {
                $_SESSION['error'] = "Le message n'a pas pu être envoyé. Le message d'erreur : {$mail->ErrorInfo}";
            }
            header("Location: /contact");
            exit;
        } else {
            // Formulaire incomplet
            $_SESSION['error'] = !empty($_POST) ? "Le formulaire est incomplet" : '';

            header("Location: /contact");
            exit;
        }
    }
}
