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
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yhteydenottolomake</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Yhteydenottolomake</h1>
        <form action="submit_message.php" method="post">
            <label for="name">Nimi/nimimerkki:</label>
            <input type="text" id="name" name="name"><br><br>
            <label for="message">Viesti:</label><br>
            <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>
            <input type="submit" value="Lähetä">
        </form>
    </div>
    <div class="container">
        <h2>Viimeisimmät viestit:</h2>
        <?php include 'display_messages.php'; ?>
    </div>
    <div class="navbar">
        <a href="Esittely&yhteydenotto.html">Esittely&Yhteydenotto</a>
    </div>
</body>
</html>