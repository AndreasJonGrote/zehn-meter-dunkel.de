<?php
header('Content-Type: application/json');

if (!isset($_GET['analyze']) || empty($_GET['analyze'])) {
	http_response_code(400);
	echo json_encode(['error' => 'Kein Text zum Analysieren übergeben.']);
	exit;
}

$text = $_GET['analyze'];
$apiUrl = 'https://www.j014.de/hochschule-bielefeld/ceres-forschung/nccm-3/?extended=true&analyze=' . urlencode($text);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
	http_response_code(500);
	echo json_encode(['error' => 'cURL Fehler: ' . $curlError]);
	exit;
}

if ($httpCode !== 200) {
	http_response_code($httpCode);
	echo json_encode(['error' => 'API-Fehler: HTTP ' . $httpCode]);
	exit;
}

echo $response;
?>

