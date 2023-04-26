<?php
session_start();
$con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['address']) && isset($_POST['telephone']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    $query = "SELECT * FROM Clienti WHERE Nome = '$name' AND Cognome = '$surname' AND Email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1) {
        echo "<script>alert('Utente già registrato!')</script>";
    } else {
        $query = "INSERT INTO Clienti (Nome, Cognome, Indirizzo, Telefono, Email) VALUES ('$name', '$surname', '$address', '$telephone', '$email')";
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Utente registrato!')</script>";
            header("Location: login.php");
        } else {
            echo "<script>alert('Errore durante la registrazione!')</script>";
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="flex flex-col h-screen mt-4">
    <div class="flex flex-col items-center justify-center h-full mb-48">
      <div class="flex flex-col gap-y-2 bg-base-300 rounded-lg p-8 items-center w-96">
        <h1 class="text-5xl text-primary-content font-extrabold text-center mb-8">
          Registrati ora!
        </h1>
        <form action="register.php" method="POST">
          <div class="flex flex-col gap-y-2 items-center text-primary-content w-72">
            <label for="name" class="font-bold">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome" required class="input bg-base-100 text-base-content w-72">

            <label for="surname" class="font-bold">Cognome</label>
            <input type="text" name="surname" id="surname" placeholder="Cognome" required class="input bg-base-100 text-base-content w-72">

            <label for="address" class="font-bold">Indirizzo</label>
            <input type="text" name="address" id="address" placeholder="Via Roma, 1" required class="input bg-base-100 text-base-content w-72">

            <label for="telephone" class="font-bold">Telefono</label>
            <input type="tel" name="telephone" id="telephone" placeholder="3331234567" required class="input bg-base-100 text-base-content w-72">

            <label for="email" class="font-bold">Email</label>
            <input type="email" name="email" id="email" placeholder="mariorossi@mail.com" required class="input bg-base-100 text-base-content w-72">
            <div class="flex w-full justify-center">
              <button type="submit" class="btn btn-accent btn-outline btn-wide btn-active mt-4 px-4">Register</button>
            </div>
          </div>
        </form>
        <div class="mt-4">
            <a href="index.php">
                <p class="text-primary-content">Torna alla home</p>
            </a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>