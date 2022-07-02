<?php
session_start();
require_once('../PHP/database.php');

if (isset($_POST['modifica'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $isUsernameValid = filter_var(
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    
    $modififato = false;

    if (empty($username) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isUsernameValid) {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $old_username = $_SESSION['session_user'];

        $query = "
            SELECT username, password
            FROM users
            WHERE username = :old_username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':old_username', $old_username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'PASSWORD ERRATA!';
        } else {
            $modificato = true;
            $query = "
                SELECT id
                FROM users
                WHERE username = :username
            ";

            $check = $pdo->prepare($query);
            $check->bindParam(':username', $username, PDO::PARAM_STR);
            $check->execute();
            
            $user = $check->fetchAll(PDO::FETCH_ASSOC);

            if(count($user)===0){
                $query = "
                    UPDATE users
                    SET username = :username
                    WHERE username = :old_username
                ";
            
                $check = $pdo->prepare($query);
                $check->bindParam(':username', $username, PDO::PARAM_STR);
                $check->bindParam(':old_username', $old_username, PDO::PARAM_STR);
                $check->execute();
                
                $query = "
                    UPDATE configurazioni
                    SET username = :username
                    WHERE username = :old_username
                ";
            
                $check = $pdo->prepare($query);
                $check->bindParam(':username', $username, PDO::PARAM_STR);
                $check->bindParam(':old_username', $old_username, PDO::PARAM_STR);
                $check->execute();

                if ($check->rowCount() > 0) {
                    $msg = 'Modifica eseguita con successo';
                } else {
                    $msg = 'Problemi con l\'inserimento dei dati %s';
                }
            }
        }
    }

    if($modificato){
        // EFFETTUO IL LOGOUT
        unset($_SESSION['session_id']);

        //ESEGUO NUOVAMENTE IL LOGIN
        $_SESSION['session_id'] = session_id();
        $_SESSION['session_user'] = $username;
        
    }    
    $_SESSION['errorMessage'] = $msg;
    header('Location: ../PHP/HOME.php');

    exit;
}

?>
