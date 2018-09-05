<?php
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../config/app.php');
use \Database\Mysql\PDO\UserTable;

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

            //sendEmailUTF_8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
        $emailSend = sendEmailUTF_8($to, $from_user, $from_email, $subject, $content);
        if ($emailSend) {

        }
    }
        //Si c'est le cas :
            //Sinon
                //Affichage d'un msg erreur "adresse email inconnu !"
}
include(__DIR__ . '/../views/password-lost.view.php');