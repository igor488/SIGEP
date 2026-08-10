<?php

include("../../config/conexao.php");

require_once("../../vendor/autoload.php");

$id = $_GET['id'] ?? 0;

$sql = $pdo->prepare("
    SELECT
        e.*,
        t.nome AS tipo
    FROM equipamentos e
    INNER JOIN tipos t
        ON t.id = e.tipo_id
    WHERE e.id = ?
");

$sql->execute([$id]);

$equipamento = $sql->fetch(PDO::FETCH_ASSOC);

if (!$equipamento) {
    die("Equipamento não encontrado.");
}

$patrimonio = $equipamento['patrimonio'];

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

$barcode = $generator->getBarcode(
    $patrimonio,
    $generator::TYPE_CODE_128
);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Etiqueta <?= htmlspecialchars($patrimonio) ?></title>

    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .etiqueta {

            width: 380px;
            min-height: 180px;

            border: 2px solid #000;

            padding: 15px;

            box-sizing: border-box;

            text-align: center;

        }

        .empresa {

            font-size: 18px;

            font-weight: bold;

            margin-bottom: 5px;

        }

        .tipo {

            font-size: 14px;

            margin-bottom: 10px;

        }

        .patrimonio {

            font-size: 30px;

            font-weight: bold;

            margin: 10px 0;

        }

        .codigo {

            margin-top: 10px;

        }

        button {

            margin-top: 20px;

            padding: 10px 20px;

            cursor: pointer;

        }

        @media print {
            button {
                display: none;
            }
        }
    </style>

</head>

<body>

    <div class="etiqueta">

        <div class="empresa">
            SIGEP
        </div>

        <div class="tipo">

            <?= htmlspecialchars($equipamento['tipo']) ?>

        </div>

        <div class="patrimonio">

            <?= htmlspecialchars($patrimonio) ?>

        </div>

        <div class="codigo">

            <?= $barcode ?>

        </div>

    </div>

    <button onclick="window.print()">

        Imprimir etiqueta

    </button>

</body>

</html>