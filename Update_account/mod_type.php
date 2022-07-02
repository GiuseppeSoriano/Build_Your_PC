<?php
session_start();
require_once('../PHP/database.php');

if (isset($_POST['modifica'])) {
    $tipo_utente = $_POST['tipo_utente'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($tipo_utente) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } else {
        $username = $_SESSION['session_user'];

        $query = "
            SELECT username, password
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'PASSWORD ERRATA!';
        } else {
            $query = "
                UPDATE users
                SET tipo_utente = :tipo
                WHERE username = :username
            ";
            
            $check = $pdo->prepare($query);
            $check->bindParam(':username', $username, PDO::PARAM_STR);
            $check->bindParam(':tipo', $tipo_utente, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                $msg = 'Modifica eseguita con successo';
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }
        }
    }

    //printf($msg);

    // EFFETTUO IL LOGOUT
    unset($_SESSION['session_id']);

    //ESEGUO NUOVAMENTE IL LOGIN
    $_SESSION['session_id'] = session_id();
    $_SESSION['session_user'] = $username;
    $_SESSION['errorMessage'] = $msg;
    
    header('Location: ../PHP/HOME.php');

    exit;
}

?>



