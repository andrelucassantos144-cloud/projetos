<?php
/**
 * contato.php — Página de contato
 * Formulário com validação e mensagem de sucesso
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'contato';
$pageTitle = 'Contato — ' . SITE_NAME;
$pageDescription = 'Entre em contato conosco. Envie sua mensagem sobre o site do Corinthians.';

$enviado = false;
$erros = [];

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (strlen($nome) < 3) $erros[] = 'Nome deve ter pelo menos 3 caracteres.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'E-mail inválido.';
    if (strlen($assunto) < 5) $erros[] = 'Assunto deve ter pelo menos 5 caracteres.';
    if (strlen($mensagem) < 10) $erros[] = 'Mensagem deve ter pelo menos 10 caracteres.';

    if (empty($erros)) {
        // Em produção, enviaria e-mail. Aqui simula sucesso para o trabalho.
        $enviado = true;
        setFlash('sucesso', 'Mensagem enviada com sucesso! Obrigado pelo contato.');
    }
}

$flash = getFlash();

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Fale Conosco</span>
        <h1 class="page-hero__title">Contato</h1>
        <p>Envie sua mensagem ou dúvida</p>
    </div>
</section>

<section class="section contato">
    <div class="container">
        <div class="contato__grid">
            <div class="contato__info reveal">
                <h2>Informações</h2>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> São Paulo, SP — Brasil</li>
                    <li><i class="fas fa-envelope"></i> contato@corinthians-historia.local</li>
                    <li><i class="fas fa-clock"></i> Seg–Sex, 9h às 18h</li>
                </ul>
                <p class="contato__note">Este é um site acadêmico sobre a história do Corinthians.</p>
            </div>

            <div class="contato__form-wrap reveal reveal--delay">
                <?php if ($flash): ?>
                <div class="alert alert--<?= e($flash['tipo']) ?>"><?= e($flash['mensagem']) ?></div>
                <?php endif; ?>

                <?php if (!empty($erros)): ?>
                <div class="alert alert--erro">
                    <ul><?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?></ul>
                </div>
                <?php endif; ?>

                <?php if ($enviado): ?>
                <div class="alert alert--sucesso">
                    <i class="fas fa-check-circle"></i>
                    Sua mensagem foi recebida com sucesso!
                </div>
                <?php else: ?>
                <form method="POST" class="form" novalidate>
                    <div class="form__group">
                        <label for="nome">Nome completo</label>
                        <input type="text" id="nome" name="nome" required
                               value="<?= e($_POST['nome'] ?? '') ?>" placeholder="Seu nome">
                    </div>
                    <div class="form__group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required
                               value="<?= e($_POST['email'] ?? '') ?>" placeholder="seu@email.com">
                    </div>
                    <div class="form__group">
                        <label for="assunto">Assunto</label>
                        <input type="text" id="assunto" name="assunto" required
                               value="<?= e($_POST['assunto'] ?? '') ?>" placeholder="Assunto da mensagem">
                    </div>
                    <div class="form__group">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="5" required
                                  placeholder="Escreva sua mensagem..."><?= e($_POST['mensagem'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--full">
                        <i class="fas fa-paper-plane"></i> Enviar Mensagem
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
