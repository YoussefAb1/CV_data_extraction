<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('backend/assets/css/index.css')}}">
    <title>Page d'accueil</title>

</head>
<body>
     <!-- <img id="im1" src="candrecru.jpg" alt="candidat vs recruteur"> -->
    <div class="container">

        <h1>Bienvenue!</h1>
        <div class="options">
            <div class="option">
                <a href="{{ route('coproprietaire.login') }}">Je suis Copropriétaire</a>
            </div>
            <div class="option">
                <a href="{{ route('syndic.login') }}">Je suis Syndic</a>
            </div>
            <div class="option">
                <a href="{{ route('admin.login') }}">Je suis Administrateur</a>
            </div>
        </div>
    </div>
</body>
</html>
