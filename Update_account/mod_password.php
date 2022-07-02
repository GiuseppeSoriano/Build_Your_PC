<?php
session_start();
require_once('../PHP/database.php');

if (isset($_POST['modifica'])) {
    $new_password = $_POST['new_password'] ?? '';
    $password = $_POST['password'] ?? '';

    $pwdLength = mb_strlen($new_password);
    
    if (empty($new_password) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } elseif ($pwdLength < 8 || $pwdLength > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {

        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $old_password_hash = password_hash($password, PASSWORD_BCRYPT);

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
                SET password = :new_password
                WHERE username = :username
            ";
            
            $check = $pdo->prepare($query);
            $check->bindParam(':username', $username, PDO::PARAM_STR);
            $check->bindParam(':new_password', $new_password_hash, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                $msg = 'Modifica eseguita con successo';
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }
            }
        }

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
