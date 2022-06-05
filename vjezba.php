<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vježba</title>
 
</head>
<body>

    <form method="post" action="vjezba.php" name="prijava">
<label for="login">Unesite korisničko ime:</label>
<br>
<input type="text" name="login" id="login">
<br>
<label for="pass">Unesite lozinku:</label>
<br>
<input type="password" name="pass" id="pass">
<br>
<input type="submit" id="butt" value="Pošalji">
    </form>

    <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vjezba_4";

if(isset($_POST['login'])){
    #mysqli_report(MYSQLI_REPORT_OFF);
    $dbc = mysqli_connect($servername, $username, $password, $dbname);
    if (!$dbc) {
        die("Connection failed: " . mysqli_connect_error());
      }
    $userExist = false;
    $switchAdmin = false;
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $passH = password_hash($pass, CRYPT_BLOWFISH);
    $passVerify;
    $dozvole = "user";
    
    
    $query1 = "SELECT * FROM users";
   # $query2 = "INSERT INTO users (id, login, password, rola) VALUES ('', '$login','$passH','$dozvole')";

    $result = mysqli_query($dbc, $query1) or die('Can not connect');
    while ($row = mysqli_fetch_array($result)){
        if($row['login'] == "$login" ){
            $userExist = true;
            $passVerify = $row['password'];
            $_SESSION['username'] = "$login";  
            if ($row['rola'] == "administrator" ) {
                $switchAdmin = true;
                $_SESSION['level'] = 1;
            }else {
                $_SESSION['level'] = 0;
            }
        }
    }
    if ($userExist && $switchAdmin && password_verify($pass, $passVerify)) {
        echo "Dobro došli. Vaša razina je administrator. <br>";
        echo "<a href='drugaStr.php'>NEXT</a>";
    } else if ($userExist && !$switchAdmin && password_verify($pass, $passVerify)) {
        echo "Dobro došli. <br>";
        echo "<a href='drugaStr.php'>NEXT</a>";
    }
    
    mysqli_close($dbc);
}



?>
</body>
</html>
