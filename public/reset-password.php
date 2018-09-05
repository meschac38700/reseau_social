<?php
    require(__DIR__.'/../vendor/autoload.php');
    require(__DIR__.'/../config/app.php');
    use \Database\Mysql\PDO\UserTable;
    if( !empty( $_GET['token'] ) )
    {
        //if form has been sumited
        if( isset($_POST['reset-password']))
        {
            $error_fields = [];
            //if all fields are not empty
            if( not_empty($_POST) )
            {
                extract($_POST);
                $user = new UserTable(null);
            }
            else
            {
                $error_fields['fields'] = "S'il vous plait, veuillez remplir tous les champs obligatoires.";    
            }
        }

    }
    include(__DIR__.'/../views/reset-password.view.php');