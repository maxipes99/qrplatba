<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cisloPopisne = isset($_POST['cislo_popisne']) ? (int)$_POST['cislo_popisne'] : 0;
    $bezSlevy     = isset($_POST['bez_slevy']) ? (int)$_POST['bez_slevy'] : 0;
    $seSlevou     = isset($_POST['se_slevou']) ? (int)$_POST['se_slevou'] : 0;
    $studenci     = isset($_POST['studenci']) ? (int)$_POST['studenci'] : 0;

    $vs = $cisloPopisne + 5000;
    $amount = $bezSlevy * 800 + $seSlevou * 700 + $studenci * 550;
    $formattedAmount = number_format($amount, 2, '.', '');

    $apiUrl = "https://api.paylibo.com/paylibo/generator/czech/image?accountNumber=21220571&bankCode=0100&amount={$formattedAmount}&currency=CZK&vs={$vs}&message=Platba%20odpady%202025";
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <!-- Základní meta tag pro responzivitu -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platba svozu odpadu Albrechtice nad Orlicí</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 1.5rem;
        }
        form {
            margin-top: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            margin-bottom: 0.4rem;
            color: #555;
            font-size: 1rem;
        }
        input[type="number"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        button[type="submit"] {
            width: 100%;
            padding: 0.8rem;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        button[type="submit"]:hover {
            background: #0056b3;
        }
        .qr-code {
            text-align: center;
            margin-top: 2rem;
        }
        .qr-code h2 {
            margin-bottom: 1rem;
            color: #333;
            font-size: 1.2rem;
        }
        .qr-code img {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        /* Přizpůsobení pro menší obrazovky */
        @media (max-width: 480px) {
            .container {
                padding: 1.5rem 1rem;
            }
            h1 {
                font-size: 1.3rem;
            }
            label, input, button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Platba svozu odpadu Albrechtice nad Orlicí</h1>
        <form method="post">
            <div class="form-group">
                <label for="cislo_popisne">Zadejte číslo popisné:</label>
                <input type="number" name="cislo_popisne" id="cislo_popisne" required>
            </div>
            <div class="form-group">
                <label for="bez_slevy">Počet poplatníků bez slevy:</label>
                <input type="number" name="bez_slevy" id="bez_slevy" required>
            </div>
            <div class="form-group">
                <label for="se_slevou">Počet poplatníků se slevou (76 a více let věku, invalidní důchodci):</label>
                <input type="number" name="se_slevou" id="se_slevou" required>
            </div>
            <div class="form-group">
                <label for="studenci">Počet poplatníků se slevou (studující ubytovaní mimo obec):</label>
                <input type="number" name="studenci" id="studenci" required>
            </div>
            <button type="submit">Odeslat formulář</button>
        </form>
        <?php
        if (isset($apiUrl)) {
            echo "<div class='qr-code'>";
            echo "<h2>Hurá, tady je tvůj QR kód!</h2>";
            echo "<img src='{$apiUrl}' alt='QR kód pro platbu' />";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
