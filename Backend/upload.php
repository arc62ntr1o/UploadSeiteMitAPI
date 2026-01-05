<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["error" => "Ungültiges JSON"]);
    exit;
}

// Zeitstempel ergänzen
$data["timestamp"] = date("c");

// Datei speichern
$filename = "../data_" . time() . ".json";
file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode([
    "status" => "ok",
    "message" => "Datensatz gespeichert",
    "file" => basename($filename)
]);
