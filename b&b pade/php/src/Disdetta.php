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
    <div class="flex flex-col h-screen">
        <div class="flex flex-col items-center justify-center h-full mb-32">
      <div class="flex flex-col gap-y-2 bg-base-300 p-8 rounded-lg items-center">
        <?php
        $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }

        if (isset($_POST['user']) && isset($_POST['room']) && isset($_POST['arrivalDate']) && isset($_POST['departureDate'])) {
          $userId = $_POST['user'];
          $roomId = $_POST['room'];
          $arrivalDate = $_POST['arrivalDate'];
          $departureDate = $_POST['departureDate'];

          //query per eliminare la prenotazione
            $query = "DELETE FROM Prenotazioni WHERE Cliente = '$userId' AND Camera = '$roomId' AND DataArrivo = '$arrivalDate' AND DataPartenza = '$departureDate'";
            $result = mysqli_query($con, $query);
            if (!$result) {
                    echo "Error: " . $query . "<br>" . mysqli_error($con);
                    exit();
            }else{
                echo "<h1 class='text-3xl font-extrabold text-center text-primary-content mb-8'>Prenotazione eliminata con successo</h1>";
            }
        } else {
            echo "<h1 class='text-3xl font-extrabold text-center text-primary-content mb-8'>Errore</h1>";
        }
        ?>
        <div>
            <a href="adminView.php">
                <button class="btn btn-accent btn-md mt-8">torna alle prenotazioni</button>
            </a>
            <a href="user.php">
                <button class="btn btn-accent btn-md mt-8">Home</button>
            </a>
          </div>
      </div>
    </div>
    </div>
</body>
</html>