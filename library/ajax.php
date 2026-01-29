<?php
header('Content-Type: application/json');

include __DIR__ . '/config.php';

if (isset($_GET['tick']) && !empty($_GET['tick'])) {
	$tick = preg_replace('/[^a-z0-9\-_]/', '', strtolower($_GET['tick']));
	if (strlen($tick) < 2 || strlen($tick) > 80) {
		http_response_code(400);
		echo json_encode(['error' => 'Ungültiger tick']);
		exit;
	}
	$sid = session_id();
	if (!$sid) {
		http_response_code(500);
		echo json_encode(['error' => 'Keine Session']);
		exit;
	}
	$baseDir = dirname(__DIR__) . '/analytics/datasets/' . $sid;
	if (!is_dir($baseDir)) {
		mkdir($baseDir, 0755, true);
	}
	$now = time();
	$isModal = strpos($tick, 'modal-') === 0;
	$isExtern = strpos($tick, 'extern-') === 0;
	if ($tick === 'scroll') {
		if (!empty($_SESSION['tick_scroll_done'])) {
			echo json_encode(['ok' => true]);
			exit;
		}
		$_SESSION['tick_scroll_done'] = true;
	}
	if (!file_exists($baseDir . '/meta.json')) {
		$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
		$secMobile = $_SERVER['HTTP_SEC_CH_UA_MOBILE'] ?? '';
		$mobileFromSec = stripos($secMobile, '?1') !== false;
		$mobileFromUa = preg_match('/mobile|android|iphone|ipod|webos|blackberry|iemobile|opera mini/i', $ua);
		$client = [
			'ua' => $ua,
			'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
			'mobile' => $mobileFromSec || $mobileFromUa,
			'platform' => preg_replace('/"/', '', $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] ?? ''),
			'sec_dest' => $_SERVER['HTTP_SEC_FETCH_DEST'] ?? '',
			'sec_mode' => $_SERVER['HTTP_SEC_FETCH_MODE'] ?? '',
			'sec_site' => $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '',
			'dnt' => !empty($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] === '1',
		];
		$ref = $_SERVER['HTTP_REFERER'] ?? '';
		if ($ref) {
			$parsed = parse_url($ref);
			$client['referer_domain'] = $parsed['host'] ?? '';
		}
		file_put_contents($baseDir . '/meta.json', json_encode([
			'created' => $now,
			'client' => $client,
		], JSON_UNESCAPED_UNICODE));
	}
	$data = ['t' => $now];
	if ($tick === 'load') {
		$page = $_GET['page'] ?? '';
		if ($page && preg_match('/^[a-z0-9\-_]+$/i', $page) && strlen($page) <= 64) {
			$data['page'] = $page;
		}
	}
	if ($isModal) {
		$file = $baseDir . '/modals.json';
		$arr = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
		$arr[] = ['k' => substr($tick, 6), 't' => $now];
		file_put_contents($file, json_encode($arr, JSON_UNESCAPED_UNICODE));
	} elseif ($isExtern) {
		$url = $_GET['url'] ?? '';
		if ($url && preg_match('#^https?://[^\s]+$#', $url) && strlen($url) <= 2048) {
			$data['url'] = $url;
		}
		$file = $baseDir . '/' . $tick . '.json';
		$arr = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
		$arr[] = $data;
		file_put_contents($file, json_encode($arr, JSON_UNESCAPED_UNICODE));
	} else {
		$file = $baseDir . '/' . $tick . '.json';
		$content = $data;
		if ($tick === 'load' && file_exists($file)) {
			$existing = json_decode(file_get_contents($file), true);
			$arr = isset($existing['t']) ? [$existing] : (is_array($existing) ? $existing : []);
			$arr[] = $content;
			file_put_contents($file, json_encode($arr, JSON_UNESCAPED_UNICODE));
		} else {
			file_put_contents($file, json_encode($content, JSON_UNESCAPED_UNICODE));
		}
	}
	echo json_encode(['ok' => true]);
	exit;
}

if (isset($_GET['analyze']) && !empty($_GET['analyze'])) {
	$sid = session_id();
	if ($sid) {
		$baseDir = dirname(__DIR__) . '/analytics/datasets/' . $sid;
		if (is_dir($baseDir) || mkdir($baseDir, 0755, true)) {
			$now = time();
			if (!file_exists($baseDir . '/meta.json')) {
				$client = [
					'ua' => $_SERVER['HTTP_USER_AGENT'] ?? '',
					'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
					'mobile' => (stripos($_SERVER['HTTP_SEC_CH_UA_MOBILE'] ?? '', '?1') !== false),
					'platform' => preg_replace('/"/', '', $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] ?? ''),
					'sec_dest' => $_SERVER['HTTP_SEC_FETCH_DEST'] ?? '',
					'sec_mode' => $_SERVER['HTTP_SEC_FETCH_MODE'] ?? '',
					'sec_site' => $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '',
					'dnt' => !empty($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] === '1',
				];
				$ref = $_SERVER['HTTP_REFERER'] ?? '';
				if ($ref) {
					$parsed = parse_url($ref);
					$client['referer_domain'] = $parsed['host'] ?? '';
				}
				file_put_contents($baseDir . '/meta.json', json_encode(['created' => $now, 'client' => $client], JSON_UNESCAPED_UNICODE));
			}
			$file = $baseDir . '/ceres.json';
			$arr = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
			$arr[] = ['t' => $now];
			file_put_contents($file, json_encode($arr, JSON_UNESCAPED_UNICODE));
		}
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
	exit;
}

/* Weitere Abschnitte hier ergaenzen, z.B.:
if (isset($_GET['stats']) && ...) {
	...
	exit;
}
*/

http_response_code(400);
echo json_encode(['error' => 'Nichts zu tun.']);

