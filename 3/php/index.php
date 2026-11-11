<?php
header('Content-Type: text/html; charset=utf-8');

$results = [];

try {
    $mysql = new PDO('mysql:host=mysql;dbname=testdb', 'dbuser', 'dbpassword');
    $version = $mysql->query('SELECT VERSION()')->fetchColumn();
    $results['MySQL (MariaDB)'] = ['status' => 'Успешно', 'info' => "Версия: $version", 'ok' => true];
} catch (Throwable $e) {
    $results['MySQL (MariaDB)'] = ['status' => 'Ошибка', 'info' => $e->getMessage(), 'ok' => false];
}

try {
    $pg = new PDO('pgsql:host=postgres;dbname=testdb', 'dbuser', 'dbpassword');
    $version = $pg->query('SELECT version()')->fetchColumn();
    $results['PostgreSQL'] = ['status' => 'Успешно', 'info' => $version, 'ok' => true];
} catch (Throwable $e) {
    $results['PostgreSQL'] = ['status' => 'Ошибка', 'info' => $e->getMessage(), 'ok' => false];
}

try {
    $redis = new Redis();
    $redis->connect('redis', 6379);
    $info = $redis->info();
    $visits = $redis->incr('page_views');
    $results['Redis'] = [
        'status' => 'Успешно',
        'info' => 'Версия: ' . ($info['redis_version'] ?? 'unknown') . " (Просмотров: $visits)",
        'ok' => true
    ];
} catch (Throwable $e) {
    $results['Redis'] = ['status' => 'Ошибка', 'info' => $e->getMessage(), 'ok' => false];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лаба №3</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background: #fafafa; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: left; }
        th { background: #eee; }
        .ok { color: green; font-weight: bold; }
        .err { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Статус подключения к базам данных (PHP + Docker Compose)</h2>
    <table>
        <tr>
            <th>Сервис</th>
            <th>Статус</th>
            <th>Результат / Версия</th>
        </tr>
        <?php foreach ($results as $service => $data): ?>
        <tr>
            <td><?= htmlspecialchars($service) ?></td>
            <td class="<?= $data['ok'] ? 'ok' : 'err' ?>"><?= htmlspecialchars($data['status']) ?></td>
            <td><?= htmlspecialchars($data['info']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>