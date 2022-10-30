<?php include 'procrastinatorKiller.php'; ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css" />
    <title>Procrastinator Killer</title>
</head>

<body class="container">
    <h1>On fait le point !</h1>

    <form action="/index.php" method="post">
        <div class="mb-3 w-25">
            <label for="dateNaissance" class="form-label">Votre date de naissance</label>
            <input type="date" value="27/05/1978" name="dateNaissance" class="form-control" id="dateNaissance" aria-describedby="dateNaissance">
        </div>
        <div class="mb-3 w-25">
            <label for="dateFin" class="form-label">Votre date visée</label>
            <input type="date" name="dateFin" class="form-control" id="dateFin" aria-describedby="dateFin">
        </div>
        <button type="submit" class="btn btn-primary">Calculer !</button>
    </form>

    <div>
        <?= "Il reste " . $tempsRestant . " semaines avant la retraite !" . "<br>"; ?>
        <?= "Cela revient à dire qu'il reste " . 100 - $pourcentageEcoulé . "% du temps alloué..."; ?>
        <?= "Nombre d'années : " . $nombreLignesTotal; ?>
        <?= dessinerCarres($nombreCarresVides, "vide") ?>
        <?= anneEnCours($tempsRestantAnnee) ?>
        <?= dessinerCarres($nombreCarreNoirs, "plein") ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>