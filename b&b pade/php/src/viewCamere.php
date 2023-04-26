<?php
session_start();
        $id = $_SESSION['codice'];
        $username = $_SESSION['username'];
        $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

        // Connection check
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }

        $query = "SELECT id, Descrizione, DataArrivo, DataPartenza FROM Prenotazioni
                  JOIN Camere ON Prenotazioni.Camera = Camere.Numero
                  WHERE Cliente = '$id'
                  ORDER BY Cliente";
        $result = mysqli_query($con, $query);

        // Query check
        if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
        }

?>

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
    
    <div class="flex flex-col items-center justify-center h-fill mb-32">
      <div class="flex flex-col gap-y-2 bg-base-300 p-8 rounded-lg items-center">
        <h1 class="text-5xl font-extrabold text-center text-primary-content mb-8">
          Le tue prenotazioni
        </h1>

        <?php
        echo "<h1 class='text-3xl text-primary-content font-extrabold text-center mb-8'>$username</h1>";
        
        echo "<table class='table table-zebra text-center'>
            <thead>
              <tr class='text-center'>
                <th>Room</th>
                <th>Arrival Date</th>
                <th>Departure Date</th>
              </tr>
            </thead>
            <tbody>";

        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
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
            <a href="user.php">
                <button class="btn btn-accent btn-md mt-8">Home</button>
            </a>
            <a href="login.php">
                <button class="btn btn-accent btn-md mt-8">Logout</button>
            </a>
        </div>
        
      </div>
    </div>

</body>

</html>