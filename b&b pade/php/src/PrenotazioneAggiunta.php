<?php
session_start();

$userId = $_SESSION['codice'];
$con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

if (mysqli_connect_errno()) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
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
    <div class="flex flex-col h-screen">
        <div class="flex flex-col items-center justify-center h-full mb-32">
        <div class="flex flex-col gap-y-2 bg-base-300 p-8 rounded-lg items-center">
          <?php
          //se è stato premuto il pulsante di prenotazione
            if (isset($_POST['room'])) {
                $room = $_POST['room'];
                $arrivalDate = $_POST['arrivalDate'];
                $departureDate = $_POST['departureDate'];
                
                //controlla che le date non siano già occupate per la camera selezionata se no inserisci la prenotazione
                $query = "SELECT * FROM Prenotazioni WHERE Camera = '$room' AND DataArrivo <= '$arrivalDate' AND DataPartenza >= '$arrivalDate' OR Camera = '$room' AND DataArrivo <= '$departureDate' AND DataPartenza >= '$departureDate'";
                $result = mysqli_query($con, $query);
                if (!$result) {
                    echo "Error: " . $query . "<br>" . mysqli_error($con);
                    exit();
                } else {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<h1 class='text-3xl font-extrabold text-center text-primary-content mb-8'>La camera è già occupata per le date selezionate</h1>";
                    } else {
                        $query = "INSERT INTO Prenotazioni (Cliente, Camera, DataArrivo, DataPartenza) VALUES ('$userId', '$room', '$arrivalDate', '$departureDate')";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            echo "Error: " . $query . "<br>" . mysqli_error($con);
                            exit();
                        } else {
                            echo "<h1 class='text-3xl font-extrabold text-center text-primary-content mb-8'>Prenotazione effettuata con successo</h1>";
                        }
                    }
                }
                
                mysqli_close($con);
            }

          ?>
          <div>
            <a href="viewCamere.php">
                <button class="btn btn-accent btn-md mt-8">Le tue prenotazioni</button>
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