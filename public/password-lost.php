<?php
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../config/app.php');
require(__DIR__.'/../Utilities/include_lang_files.php');
use \Database\Mysql\PDO\UserTable;
$result = null;
$error_fields = null;

if (isset($_POST['reset-password'])) {
    $error_email = "";
    $email = $_POST['email'];
    $user = new UserTable(null);
    
    //Check si l'adresse email est connu de la base de données
    $user_found = $user->get($email);
    if ($user_found) {
        // Envoyer un mail contenant le lien pour la réinitialisation du mot de passe
        // function sendEmailUTF_8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
        $to = $email;
        $from_user = $config['app_name'];
        $from_email = $config['email'];
        $subject = $config['app_name'] . " - Réinitialisation du mot de passe";
        $pseudo = $user_found->pseudo;
        $reset_password_url = $config['web_url'] . '/reset-password.php?token='.$user_found->token;

        // mémoire temporaire de la vue email activation
        ob_start();
        require(__DIR__ . '/../views/emails/reset-password.view.php');
        $content = ob_get_clean();
        //Envoie d'email
        $emailSend = sendEmailUTF_8($to, $from_user, $from_email, $subject, $content);
        // Si le mail a bel et bien été envoyé, Affichage d'un message de succèss
        if ($emailSend) {
            $result['type'] = "success";
            $result['message'] = "Le mail est est envoyé !";
        }
        else
        {
            $result['type'] = "danger";
            $result['message'] = "erreur lors de l'envoie du mail ! Veuillez réésayer plus tard.";
        }
    }
    else
    {
        $error_fields['email'] = $lang['form']['message']['email_invalid'];
    }
        //Si c'est le cas :
            //Sinon
                //Affichage d'un msg erreur "adresse email inconnu !"
}
include(__DIR__ . '/../views/password-lost.view.php');