<?php
include __DIR__ . '/../library/config.php';

$authUser = 'zmd-admin';
$authPass = 'ws2026';
$loggedIn = !empty($_SESSION['dashboard_auth']);

if (isset($_GET['logout'])) {
	unset($_SESSION['dashboard_auth']);
	header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
	exit;
}

if (!$loggedIn) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$user = $_POST['user'] ?? '';
		$pass = $_POST['pass'] ?? '';
		if ($user === $authUser && $pass === $authPass) {
			$_SESSION['dashboard_auth'] = true;
			header('Location: ' . $_SERVER['REQUEST_URI']);
			exit;
		}
	}
	?>
	<!DOCTYPE html>
	<html lang="de">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex">
		<title>Login | Analytics</title>
		<link href="<?php the_url(); ?>/dist/css/main.css?v=<?php echo time(); ?>" rel="stylesheet">
	</head>
	<body class="bg-light text-dark">
		<div class="container-fluid py-10 flex items-center justify-center min-h-screen">
			<form method="post" class="w-full max-w-xs">
				<h1 class="text-xl font-heading uppercase mb-6">Analytics</h1>
				<div class="mb-4">
					<label for="user" class="block text-sm font-heading uppercase text-grey mb-2">Benutzer</label>
					<input type="text" id="user" name="user" required autofocus class="w-full border border-grey/30 rounded p-2 text-dark">
				</div>
				<div class="mb-6">
					<label for="pass" class="block text-sm font-heading uppercase text-grey mb-2">Passwort</label>
					<input type="password" id="pass" name="pass" required class="w-full border border-grey/30 rounded p-2 text-dark">
				</div>
				<button type="submit" class="border border-grey/30 rounded px-4 py-2 font-heading uppercase text-sm">Anmelden</button>
			</form>
		</div>
	</body>
	</html>
	<?php
	exit;
}

$datasetsDir = __DIR__ . '/datasets';
$botPatterns = ['bot', 'crawler', 'spider', 'googlebot', 'bingbot', 'yahoo', 'slurp', 'duckduckbot', 'baidu', 'yandex', 'facebookexternalhit', 'twitterbot', 'linkedinbot', 'whatsapp', 'telegrambot', 'ahrefs', 'semrush'];
$sessions = [];
$externByUrl = [];
$dirs = is_dir($datasetsDir) ? scandir($datasetsDir) : [];

foreach ($dirs as $sid) {
	if ($sid === '.' || $sid === '..' || !is_dir($datasetsDir . '/' . $sid)) {
		continue;
	}
	$metaFile = $datasetsDir . '/' . $sid . '/meta.json';
	$loadFile = $datasetsDir . '/' . $sid . '/load.json';
	if (!file_exists($metaFile) || !file_exists($loadFile)) {
		continue;
	}
	$meta = json_decode(file_get_contents($metaFile), true);
	$ua = strtolower($meta['client']['ua'] ?? '');
	$isBot = false;
	foreach ($botPatterns as $p) {
		if (strpos($ua, $p) !== false) {
			$isBot = true;
			break;
		}
	}
	if ($isBot || !empty($meta['client']['dnt'])) {
		continue;
	}
	$load = json_decode(file_get_contents($loadFile), true);
	$loads = isset($load['t']) ? [$load] : (is_array($load) ? $load : []);
	$firstTick = $loads[0]['t'] ?? $load['t'] ?? $meta['created'] ?? 0;
	$pages = array_map(fn($l) => $l['page'] ?? 'index', $loads);
	$hasScroll = file_exists($datasetsDir . '/' . $sid . '/scroll.json');
	$hasTime = file_exists($datasetsDir . '/' . $sid . '/time.json');
	if (!$hasScroll && !$hasTime) {
		continue;
	}
	$lastTick = $firstTick;
	$modals = [];
	$externs = [];
	$externUrls = [];
	$ceresCount = 0;
	foreach (glob($datasetsDir . '/' . $sid . '/*.json') as $f) {
		$name = basename($f, '.json');
		if ($name === 'meta') continue;
		$data = json_decode(file_get_contents($f), true);
		if ($name === 'modals') {
			$arr = is_array($data) ? $data : [];
			foreach ($arr as $m) {
				$modals[] = $m['k'] ?? '';
				$t = $m['t'] ?? 0;
				if ($t > $lastTick) $lastTick = $t;
			}
		} elseif (strpos($name, 'extern-') === 0) {
			$key = substr($name, 7);
			$arr = is_array($data) ? (isset($data['t']) ? [$data] : $data) : [];
			foreach ($arr as $e) {
				$externs[] = $key;
				$url = $e['url'] ?? '';
				if ($url) {
					$externUrls[] = ['url' => $url, 'key' => $key];
					if (!isset($externByUrl[$url])) {
						$externByUrl[$url] = ['key' => $key, 'count' => 0];
					}
					$externByUrl[$url]['count']++;
				} else {
					if (!isset($externByUrl[$key])) {
						$externByUrl[$key] = ['key' => $key, 'count' => 0];
					}
					$externByUrl[$key]['count']++;
				}
				$t = $e['t'] ?? 0;
				if ($t > $lastTick) $lastTick = $t;
			}
		} elseif ($name === 'ceres') {
			$arr = is_array($data) ? (isset($data['t']) ? [$data] : $data) : [];
			$ceresCount = count($arr);
			foreach ($arr as $e) {
				$t = $e['t'] ?? 0;
				if ($t > $lastTick) $lastTick = $t;
			}
		} else {
			$t = $data['t'] ?? 0;
			if ($t > $lastTick) $lastTick = $t;
		}
	}
	$mobile = !empty($meta['client']['mobile']);
	$sessions[] = [
		'sid' => $sid,
		'first' => $firstTick,
		'last' => $lastTick,
		'duration' => max(0, $lastTick - $firstTick),
		'pages' => $pages,
		'modals' => $modals,
		'externs' => $externs,
		'externUrls' => $externUrls,
		'ceres' => $ceresCount,
		'mobile' => $mobile,
	];
}

usort($sessions, fn($a, $b) => $b['first'] - $a['first']);
$totalVisitors = count($sessions);
$totalDuration = array_sum(array_column($sessions, 'duration'));
$avgDuration = $totalVisitors > 0 ? round($totalDuration / $totalVisitors) : 0;
$modalCounts = [];
$externCounts = [];
$totalCeres = 0;
$mobileCount = 0;
$desktopCount = 0;
foreach ($sessions as $s) {
	foreach ($s['modals'] as $k) {
		$modalCounts[$k] = ($modalCounts[$k] ?? 0) + 1;
	}
	foreach ($s['externs'] as $k) {
		$externCounts[$k] = ($externCounts[$k] ?? 0) + 1;
	}
	$totalCeres += $s['ceres'] ?? 0;
	if (!empty($s['mobile'])) {
		$mobileCount++;
	} else {
		$desktopCount++;
	}
}
arsort($modalCounts);
arsort($externCounts);
uasort($externByUrl, fn($a, $b) => $b['count'] - $a['count']);

$pageCounts = [];
foreach ($dirs as $sid) {
	if ($sid === '.' || $sid === '..' || !is_dir($datasetsDir . '/' . $sid)) continue;
	$loadFile = $datasetsDir . '/' . $sid . '/load.json';
	if (!file_exists($loadFile)) continue;
	$load = json_decode(file_get_contents($loadFile), true);
	$loads = isset($load['t']) ? [$load] : (is_array($load) ? $load : []);
	foreach ($loads as $l) {
		$p = $l['page'] ?? 'index';
		$pageCounts[$p] = ($pageCounts[$p] ?? 0) + 1;
	}
}
arsort($pageCounts);
$maxPages = !empty($pageCounts) ? max($pageCounts) : 1;

$visitsByDay = [];
foreach ($sessions as $s) {
	$day = date('Y-m-d', $s['first']);
	$visitsByDay[$day] = ($visitsByDay[$day] ?? 0) + 1;
}
krsort($visitsByDay);
$visitsByDay = array_slice($visitsByDay, 0, 14, true);
$maxVisits = !empty($visitsByDay) ? max($visitsByDay) : 1;
$maxModals = !empty($modalCounts) ? max($modalCounts) : 1;
$maxExtern = !empty($externByUrl) ? max(array_column($externByUrl, 'count')) : 1;
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
	<title>Analytics | ZEHN METER DUNKEL</title>
	<link href="<?php the_url(); ?>/dist/css/main.css?v=<?php echo time(); ?>" rel="stylesheet">
	<style>
		.chart-bar { height: 20px; background: rgba(38,37,34,0.15); border-radius: 2px; overflow: hidden; }
		.chart-bar-fill { height: 100%; background: #262522; border-radius: 2px; transition: width 0.3s ease; }
		.chart-row { display: grid; grid-template-columns: minmax(0, 1fr) 1fr 32px; gap: 8px; align-items: center; }
		.chart-label { font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
	</style>
</head>
<body class="bg-light text-dark">
	<div class="container-fluid py-10">
		<div class="flex justify-between items-center mb-10">
			<h1 class="text-2xl font-heading uppercase">Analytics</h1>
			<a href="?logout=1" class="text-sm font-heading uppercase text-grey hover:underline">Abmelden</a>
		</div>

		<div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-10">
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Besucher</p>
				<p class="text-2xl font-heading"><?php echo $totalVisitors; ?></p>
			</div>
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Mobile</p>
				<p class="text-2xl font-heading"><?php echo $mobileCount; ?></p>
			</div>
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Desktop</p>
				<p class="text-2xl font-heading"><?php echo $desktopCount; ?></p>
			</div>
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Ø Verweildauer</p>
				<p class="text-2xl font-heading"><?php echo gmdate('i:s', $avgDuration); ?></p>
			</div>
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Gesamtzeit</p>
				<p class="text-2xl font-heading"><?php echo gmdate('H:i:s', $totalDuration); ?></p>
			</div>
			<div class="border border-grey/20 rounded p-4">
				<p class="text-xs font-heading uppercase text-grey mb-1">Ceres</p>
				<p class="text-2xl font-heading"><?php echo $totalCeres; ?></p>
			</div>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
			<div>
				<h2 class="text-xs font-heading uppercase text-grey mb-4">Seitenaufrufe</h2>
				<?php if (!empty($pageCounts)): ?>
				<div class="space-y-2">
					<?php foreach ($pageCounts as $page => $c): ?>
					<div class="chart-row">
						<span class="chart-label"><?php echo htmlspecialchars($page); ?></span>
						<div class="chart-bar flex-1 min-w-0">
							<div class="chart-bar-fill" style="width:<?php echo round(100 * $c / $maxPages); ?>%"></div>
						</div>
						<span class="text-xs tabular-nums w-8"><?php echo $c; ?></span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php else: ?>
				<p class="text-sm text-grey">—</p>
				<?php endif; ?>
			</div>
			<div>
				<h2 class="text-xs font-heading uppercase text-grey mb-4">Besuche pro Tag</h2>
				<?php if (!empty($visitsByDay)): ?>
				<div class="space-y-2">
					<?php foreach ($visitsByDay as $day => $c): ?>
					<div class="chart-row">
						<span class="chart-label"><?php echo date('d.m.', strtotime($day)); ?></span>
						<div class="chart-bar flex-1 min-w-0">
							<div class="chart-bar-fill" style="width:<?php echo round(100 * $c / $maxVisits); ?>%"></div>
						</div>
						<span class="text-xs tabular-nums w-8"><?php echo $c; ?></span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php else: ?>
				<p class="text-sm text-grey">—</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
			<div>
				<h2 class="text-xs font-heading uppercase text-grey mb-4">Modals geöffnet</h2>
				<?php if (!empty($modalCounts)): ?>
				<div class="space-y-2">
					<?php foreach ($modalCounts as $k => $c): ?>
					<div class="chart-row">
						<span class="chart-label"><?php echo htmlspecialchars($k); ?></span>
						<div class="chart-bar flex-1 min-w-0">
							<div class="chart-bar-fill" style="width:<?php echo round(100 * $c / $maxModals); ?>%"></div>
						</div>
						<span class="text-xs tabular-nums w-8"><?php echo $c; ?></span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php else: ?>
				<p class="text-sm text-grey">—</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="mb-10">
			<h2 class="text-xs font-heading uppercase text-grey mb-4">Externe Klicks (mit URL)</h2>
			<?php if (!empty($externByUrl)): ?>
			<div class="space-y-2 max-w-2xl">
				<?php foreach ($externByUrl as $urlOrKey => $item): ?>
				<div class="chart-row">
					<a href="<?php echo strpos($urlOrKey, 'http') === 0 ? htmlspecialchars($urlOrKey) : '#'; ?>" target="_blank" rel="noopener" class="chart-label truncate block text-dark <?php echo strpos($urlOrKey, 'http') === 0 ? 'hover:underline' : 'no-underline cursor-default'; ?>"><?php echo htmlspecialchars(strpos($urlOrKey, 'http') === 0 ? $urlOrKey : $item['key']); ?></a>
					<div class="chart-bar flex-1 min-w-0">
						<div class="chart-bar-fill" style="width:<?php echo round(100 * $item['count'] / $maxExtern); ?>%"></div>
					</div>
					<span class="text-xs tabular-nums w-8"><?php echo $item['count']; ?></span>
				</div>
				<?php endforeach; ?>
			</div>
			<?php else: ?>
			<p class="text-sm text-grey">—</p>
			<?php endif; ?>
		</div>

		<div>
			<h2 class="text-xs font-heading uppercase text-grey mb-4">Sessions</h2>
			<table class="w-full text-sm">
				<thead>
					<tr class="border-b border-grey/30">
						<th class="text-left py-2 font-heading">Zeit</th>
						<th class="text-left py-2 font-heading">Dauer</th>
						<th class="text-left py-2 font-heading">Seiten</th>
						<th class="text-left py-2 font-heading">Modals</th>
						<th class="text-left py-2 font-heading">Extern (URL)</th>
						<th class="text-left py-2 font-heading">Ceres</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($sessions as $s): ?>
					<tr class="border-b border-grey/20">
						<td class="py-2"><?php echo date('d.m. H:i', $s['first']); ?></td>
						<td class="py-2 tabular-nums"><?php echo gmdate('i:s', $s['duration']); ?></td>
						<td class="py-2"><?php echo implode(', ', array_unique($s['pages'] ?? [])) ?: '—'; ?></td>
						<td class="py-2"><?php echo implode(', ', array_unique($s['modals'])) ?: '—'; ?></td>
						<td class="py-2 max-w-[200px] truncate" title="<?php echo htmlspecialchars(implode(', ', array_column($s['externUrls'] ?? [], 'url'))); ?>"><?php
$extDisp = array_unique(array_filter(array_map(function($e) {
	$u = $e['url'] ?? '';
	$h = parse_url($u, PHP_URL_HOST);
	$p = parse_url($u, PHP_URL_PATH);
	return $h ? ($h . ($p ?: '')) : $u;
}, $s['externUrls'] ?? [])));
echo implode(', ', $extDisp) ?: (implode(', ', array_unique($s['externs'])) ?: '—');
?></td>
						<td class="py-2 tabular-nums"><?php echo $s['ceres'] ?? 0; ?></td>
					</tr>
					<?php endforeach; ?>
					<?php if (empty($sessions)): ?>
					<tr><td colspan="6" class="py-4 text-grey">Keine Sessions</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
