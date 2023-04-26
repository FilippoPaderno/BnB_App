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
    <h1 class="text-8xl text-center font-extrabold mt-6">Pade's B&B</h1>
    <p class='text-3xl text-base-content font-bold text-center mt-8'>Benvenuto admin</p>
    <div class="flex flex-col items-center justify-center h-full mb-64">
        <div class="flex flex-col gap-y-2 items-center bg-base-300 rounded-lg p-8 ">
            <h1 class="text-4xl text-primary-content font-bold text-center mb-8">Cosa vuoi fare?</h1>
            <a href="adminView.php">
                <button class="btn btn-lg w-52 justify-center btn-accent">Prenotazioni</button>
            </a>
            <a href="PrenotazAdmin.php">
                <button class="btn btn-lg w-52 justify-center btn-success">Prenota</button>
            </a>
            <a href="login.php">
                <button class="btn btn-lg w-52 justify-center btn-error">Logout</button>
            </a>
        </div>
    </div>


   </div>

</body>

</html>