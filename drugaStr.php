<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vježba</title>
 
</head>
<body>
    <?php
    session_start(); 
        $korisnicko_ime = $_SESSION['username'];
        $level = $_SESSION['level'];
        if ($level) {
            echo "Dobro došli $korisnicko_ime. Vaša razina je administrator.";
        } else {
            echo "Dobro došli $korisnicko_ime.";
        }
    ?>
</body>
</html>
    

