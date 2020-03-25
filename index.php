<?php
//@TODO insert your code here
    require_once('includes/classes/Database.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'aufgabe6.1');
define('DB_USER', 'Michael2');
define('DB_PASS', '1234');

$db = new Database();

/*$username =  "test";
$password =  "testpasswort;*/
// password_hash("testpasswort");

$cryptedPassword = password_hash('testpassword', PASSWORD_BCRYPT);
$username = "test";

$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

//$sql = "INSERT INTO user(name,`password`) VALUES('". $username ."','".$cryptedPassword."')";
//$db->query($sql);

$sql = "SELECT * FROM user WHERE name='".$username."'";
$result = $db->query($sql);
if($db->numRows($result) > 0) //anzahl zeilen mehr als 0
{
//kein while nötig – wir wissen es gibt nur einen Wert. Mehre Zeilen könnte man
//mit while($row = $db->fetchAssoc($result)) //herausholen
    $row = $db->fetchAssoc($result);
//fetch Assoc heißt man greift auf die Spalten wie folgt zu:
//$row['spaltenname'];
//fetchObject würde heißen man greift auf die Spalten so zu:
//$row->spaltenname;
//In Java und JavaScript greifen Sie Objektorientiert mittels . zu
//z.B. row.spaltenname. Das ist in PHP anders.
    if(password_verify("testpassword", $row['password'])) // wenn falsches Passwort steht: Nutzer gefunden aber falsches Passwort!
    {
        echo "Der Nutzer ".$username." mit der ID ".$row['id']." hat";
        echo " das Passwort testpassword";
    }
    else
    {
        echo "Nutzer gefunden aber falsches Passwort!";
    }
}
else
{
    echo "Keinen Nutzer gefunden";
}

