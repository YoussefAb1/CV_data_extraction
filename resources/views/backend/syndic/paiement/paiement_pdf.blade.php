{{-- resources/views/backend/paiement/paiement_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .header {
            margin-bottom: 40px;
        }
        .header h2 {
            margin: 0;
        }

        .noble-ui-logo span {
    color: #727cf5;
    font-weight: 200;
    font-family: "Segoe UI", "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
        }

    </style>
</head>
<body>
    <div class="header">
        <h1 class="noble-ui-logo logo-light d-block mb-2" > Digi<span>Syndic</span> </h1>
<br>
        <h2>Détails du Paiement</h2>
        <p>Date de génération : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $paiement->id }}</td>
        </tr>
        <tr>

            <th>Montant</th>
            <td>{{ $paiement->montant }}</td>
        </tr>
        <tr>
            <th>Date de Paiement</th>
            <td>{{ $paiement->date_paiement }}</td>
        </tr>
        <tr>
            <th>Méthode de Paiement</th>
            <td>{{ $paiement->methode_paiement }}</td>
        </tr>
        <tr>
            <th>Appartement</th>
            <td>{{ $paiement->coproprietaireHistory->appartement->nom_appartement ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Immeuble</th>
            <td>{{ $paiement->syndicHistory->immeuble->nom_immeuble ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Résidence</th>
            <td>{{ $paiement->syndicHistory->immeuble->residence->nom_residence ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Propriétaire</th>
            <td>{{ $paiement->coproprietaireHistory->coproprietaire->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Syndic</th>
            <td>{{ $paiement->cotisation->memberSyndic->user->name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>ID Cotisation</th>
            <td>{{ $paiement->cotisation->id ?? 'N/A' }}</td>
        </tr>
    </table>
</body>
</html>
