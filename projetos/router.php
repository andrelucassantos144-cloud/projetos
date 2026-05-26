<?php
/**
 * router.php — Roteador do servidor PHP embutido
 * Garante que http://localhost:8000/ abra o index.html
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// Executa arquivos PHP (API)
if (preg_match('/\.php$/i', $uri) && is_file($file)) {
    return false;
}

// Serve arquivos estáticos (css, js, imagens externas não passam aqui)
if ($uri !== '/' && is_file($file)) {
    return false;
}

// Página inicial
if ($uri === '/' || $uri === '/index.html') {
    header('Content-Type: text/html; charset=utf-8');
    readfile(__DIR__ . '/index.html');
    return true;
}

http_response_code(404);
header('Content-Type: text/html; charset=utf-8');
echo '<h1>404 — Página não encontrada</h1>';
echo '<p><a href="/">Voltar ao início</a></p>';
return true;
