<?php



spl_autoload_register(function ($class_name) {
    require ('classes/' . $class_name . '.class.php');
});

// Logger Instantiation:
$Logger = Logger::getInstance();
$Logger->setPath('logs/');

// Config Files Data Getting:
$configs = file_get_contents('configs.json');
$configs = json_decode($configs, TRUE);

// Config Files Constants Defining
foreach($configs as $array){
    foreach($array as $key => $value){
        define(strtoupper($key), $value);
    }
}

// DB Connection:
DBCon::connect(DBENGINE, DBHOST, DBUSER, DBPASS, DBNAME, DBPORT, DBSINGLE);

// $_POST['Ebook'] status check:
// if(!isset($_POST['ebook'])){
//     $_POST['ebook'] = 0;
// }

// Admin Instantiation:
$Admin = new Admin(ADMINNAME, ADMINEMAIL, ADMINREPLYEMAIL, ADMINREPLYTO);

// New User Creation on DB and User Instantiation:
$User   = new User(NULL, $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['company'], $_POST['service'], $_POST['industry'], $_POST['ebook']);

//  New Mailer Instantiation:
$MyMailer = new Mailer($User, $Admin, $configs['mailer']);

// Admin Email Sending:

$adminEmailAns = $MyMailer->sendAdminEmail('Este es el Mail para el admin', 'Este es el asunto del mail para el admin', 'Texto Alternativo para el admin.');

// User Email Sending With Ebook:
if($_POST['ebook'] == 1){
    $userEmailAns = $MyMailer->sendUserEmail('Este es el text body para el Usuario Con Ebook','Este es el asunto para el usuario Con Ebook','Alternative Text for user Con Ebook');

}else{  //User Email Sending Without PDF: 

    $userEmailAns = $MyMailer->sendAdminEmail('Este es el Mail para el Usuario Sin Ebook', 'Este es el asunto del mail para el Usuario Sin Ebook', 'Texto Alternativo para el Usuario Sin Ebook.');

}

if($adminEmailAns == TRUE && $userEmailAns == TRUE){

    header("Location: http://localhost:1234/gracias.html");

}else{

    $Logger->write('Error Sending Emails on Form-Action.php', 'ERROR');
    // TODO: ERROR VIEW;
}



