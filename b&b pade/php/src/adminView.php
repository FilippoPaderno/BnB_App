<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    if (isset($_POST["id"])) {
    $id = $_POST["id"];

    $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    $deleteSoggiorni = "DELETE FROM Soggiorni WHERE Prenotazione = $id";
    $deletePrenotazioni = "DELETE FROM Prenotazioni WHERE id = $id";
    $resultSoggiorni = mysqli_query($con, $deleteSoggiorni);
    $resultPrenotazioni = mysqli_query($con, $deletePrenotazioni);

    mysqli_close($con);
    }
    ?>

    <div class="flex flex-col justify-center items-center h-screen">
        <div class="flex flex-col items-center justify-center h-fill mb-32">
      <div class="flex flex-col gap-y-2 bg-base-300 p-8 rounded-lg items-center">
        <h1 class="text-5xl font-extrabold text-center text-primary-content mb-8">
          Prenotazioni effettuate
        </h1>
        <?php
        $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }

        $query = "SELECT Nome, Cognome, Descrizione, DataArrivo, DataPartenza, Disdetta FROM Prenotazioni
                    JOIN Clienti ON Prenotazioni.Cliente = Clienti.codice
                    JOIN Camere ON Prenotazioni.Camera = Camere.Numero";
        $result = mysqli_query($con, $query);

        if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
        }

        echo "<table class='table table-zebra text-center'>
            <thead>
              <tr class='text-center'>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Stanza</th>
                <th>Data Arrivo</th>
                <th>Data Partenza</th>
              </tr>
            </thead>
            <tbody>";

        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row['Cognome'] . "</td>";
          echo "<td>" . $row['Nome'] . "</td>";
          echo "<td>" . $row['Descrizione'] . "</td>";
          echo "<td>" . $row['DataArrivo'] . "</td>";
          echo "<td>" . $row['DataPartenza'] . "</td>";
          echo "</tr>";
        }

        echo "</tbody>
          </table>";

        mysqli_close($con);
        ?>

        <div>
            <a href="admin.php">
                <button class="btn btn-accent btn-md mt-8">Home</button>
            </a>
            <a href="adminDisdetta.php">
                <button class="btn btn-accent btn-md mt-8">Disdici</button>
            </a>
            <a href="login.php">
                <button class="btn btn-accent btn-md mt-8">Logout</button>
            </a>
        </div>
      </div>
    </div>
    </div>
</body>
</html>