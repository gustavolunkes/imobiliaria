<?php
// Fuso horário correto
date_default_timezone_set('America/Sao_Paulo');
$pdo->exec("SET time_zone = '-03:00'");

$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$dataAgora = date('Y-m-d H:i:s');
$limiteTempo = date('Y-m-d H:i:s', strtotime('-5 minutes'));

// --- Função para obter localização pelo IP usando ip-api.com ---
function getLocationFromIP($ip) {
    $url = "http://ip-api.com/json/{$ip}?fields=status,country,regionName,city,lat,lon,message";
    $response = @file_get_contents($url);
    if ($response === FALSE) {
        return null;
    }
    $data = json_decode($response, true);
    if ($data['status'] !== 'success') {
        return null;
    }
    return [
        'pais' => $data['country'],
        'estado' => $data['regionName'],
        'cidade' => $data['city'],
        'latitude' => $data['lat'],
        'longitude' => $data['lon']
    ];
}

// Verifica se já teve acesso recente desse IP + navegador nos últimos X minutos
$stmt = $pdo->prepare("SELECT COUNT(*) FROM acessos 
                       WHERE ip = :ip 
                         AND user_agent = :user_agent 
                         AND data_acesso > :limite");
$stmt->execute([
    ':ip' => $ip,
    ':user_agent' => $userAgent,
    ':limite' => $limiteTempo
]);
$existe = $stmt->fetchColumn();

if ($existe == 0) {
    $localizacao = getLocationFromIP($ip);
    $cidade = $localizacao['cidade'] ?? null;
    $estado = $localizacao['estado'] ?? null;
    $pais = $localizacao['pais'] ?? null;
    $latitude = $localizacao['latitude'] ?? null;
    $longitude = $localizacao['longitude'] ?? null;

    $stmt = $pdo->prepare("INSERT INTO acessos (ip, data_acesso, user_agent, cidade, estado, pais, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$ip, $dataAgora, $userAgent, $cidade, $estado, $pais, $latitude, $longitude]);
}

// Total de acessos salvos no banco
$totalAcessos = $pdo->query("SELECT COUNT(*) FROM acessos")->fetchColumn();


?>