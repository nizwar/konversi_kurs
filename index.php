<?php
include "konversi.php";

$getJumlah = isset($_GET["val"]) ? $_GET["val"] : null;
$getKurs = isset($_GET["kurs"]) ? $_GET["kurs"] : null;
$nizKurs = new NizwarKurs;

if ($getJumlah == null || $getKurs == null) {
    echo json_encode([
        "success" => true,
        "data" => $nizKurs->getListOfKurs()
    ]);
    return;
}
try {
    $kurs = $nizKurs->getKurs(strtolower($getKurs));
    $value = $nizKurs->convertKurs($getJumlah, $getKurs);
    echo json_encode([
        "success" => true,
        "kurs" => $kurs,
        "result" => $value
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "kurs" => null,
        "result" => null
    ]);
}
