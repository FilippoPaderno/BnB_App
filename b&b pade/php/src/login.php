<?php
  session_start();
  $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

  if (isset($_POST['username']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $user = explode(" ", $username);
    $email = $_POST['email'];

    if (count($user) == 1) {
      $user[1] = "";
    }

    $query = "SELECT * FROM Clienti WHERE Nome = '$user[0]' AND Cognome = '$user[1]' AND Email = '$email'";

    if ($username == "admin" && $email == "admin") {
      header("Location: admin.php");
    } else if ($username != "admin" && $email != "admin" && $username != "" && $email != "") {
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);

      if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['codice'] = $row['Codice'];
        header("Location: user.php");
      } else {
        echo "<script>alert('Username o email errati!')</script>";
      }
      
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <div class="flex flex-col h-screen mt-4">
    <div class="flex flex-col items-center justify-center h-full mb-48">
      <div class="flex flex-col gap-y-2 bg-base-300 rounded-lg p-8 items-center w-96">
        <h1 class="text-5xl text-primary-content font-extrabold text-center mb-8">
          Accedi ora!
        </h1>
        <form action="login.php" method="post">
          <div class="flex flex-col gap-y-2 items-center text-primary-content w-72">
            <label for="username" class="font-bold">Nome e Cognome</label>
            <input type="text" name="username" id="username" placeholder="Nome Cognome" required class="input bg-base-100 text-base-content w-72">
            <label for="email" class="font-bold">Email</label>
            <input type="text" name="email" id="email" placeholder="mariorossi@mail.com" required class="input bg-base-100 text-base-content w-72">
            <div class="flex w-full justify-center">
              <button type="submit" class="btn btn-accent btn-outline btn-wide btn-active mt-4 px-4">Login</button>
            </div>
          </div>
        </form>
        <div class="mt-4">
          <a href="register.php">
            <p class="text-primary-content">Non sei registrato?Registrati ora</p>
          </a>
        </div>
        
      </div>
    </div>
  </div>

</body>

</html>