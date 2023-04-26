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
            <h1 class="text-5xl font-extrabold text-center text-primary-content mb-8">
            Prenota una camera
            </h1>

            <form action="PrenotazioneAggiunta.php" method="post" class="gap-y-4">
            <div class="flex flex-col gap-y-3">

                <?php
                $con = mysqli_connect("mariadb", "root", "pippo", "DB_Bed_and_Breakfast");

                // Connection check
                if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
                }

                
                $query = "SELECT Numero, Descrizione FROM Camere WHERE Numero NOT IN (SELECT Camera FROM Prenotazioni WHERE DataArrivo <= CURDATE() AND DataPartenza >= CURDATE())";

                $result = mysqli_query($con, $query);

                if (!$result) {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
                exit();
                } else {
                echo "<label for='room' class='font-bold text-primary-content'>Room</label>";
                echo "<select name='room' id='room' class='select bg-base-100 text-base-content select-bordered w-96' required>";
                while ($row = $result -> fetch_assoc()) {
                    echo "<option value='" . $row['Numero'] . "'>" . $row['Descrizione'] . "</option>";
                }
                echo "</select>";
                }

                mysqli_close($con);
                ?>

            </div>

            <div class="flex flex-col gap-y-1 mt-4 mb-4">
                <label for="arrivalDate" class="font-bold text-primary-content">Data di arrivo</label>
                <input type="date" name="arrivalDate" id="arrivalDate" class="input bg-base-100 text-base-content input-bordered w-96" required>
            </div>

            <div class="flex flex-col gap-y-1">
                <label for="departureDate" class="font-bold text-primary-content
                ">Data di partenza</label>
                <input type="date" name="departureDate" id="departureDate" class="input bg-base-100 text-base-content input-bordered w-96" required>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="btn btn-accent btn-active btn-md">Add</button>
            </div>
            </form>
            
            <a href="user.php">
                <button class="btn btn-accent btn-wide btn-active">Home</button>
            </a>
            
        </div>
        </div>
    </div>

</body>

</html>