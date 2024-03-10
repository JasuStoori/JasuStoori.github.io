<?php
// Tarkista, että viesti on lähetetty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    // Tietokantayhteys
    $servername = "localhost";
    $username = "kayttajanimi";
    $password = "salasana";
    $dbname = "viestit";

    // Luo tietokantayhteys
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Tarkista yhteys
    if ($conn->connect_error) {
        die("Yhteyden muodostaminen epäonnistui: " . $conn->connect_error);
    }

    // Hae lähettäjän nimi, jos annettu
    $name = isset($_POST["name"]) ? $_POST["name"] : "";

    // Viestin sisältö
    $message = $_POST["message"];

    // Lisää viesti tietokantaan
    $sql = "INSERT INTO messages (name, message) VALUES ('$name', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Viesti lähetetty onnistuneesti.";
    } else {
        echo "Virhe: " . $sql . "<br>" . $conn->error;
    }

    // Sulje tietokantayhteys
    $conn->close();
}
?>