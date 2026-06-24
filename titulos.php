<?php
/**
 * titulos.php — Títulos e conquistas do clube
 * Exibição em cards modernos a partir do MySQL
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'titulos';
$pageTitle = 'Títulos e Conquistas — ' . SITE_NAME;
$pageDescription = 'Todos os títulos do Corinthians: Paulista, Brasileiro, Copa do Brasil, Libertadores e Mundial de Clubes.';

$titulos = getTitulos();

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Palmarés</span>
        <h1 class="page-hero__title">Títulos e Conquistas</h1>
        <p>As glórias que eternizaram o Timão</p>
    </div>
</section>

<section class="section titulos">
    <div class="container">
        <header class="section__header reveal">
            <h2 class="section__title">Nosso Palmarés</h2>
            <p class="section__desc">Dados carregados do banco de dados MySQL</p>
        </header>

        <div class="cards-grid">
            <?php foreach ($titulos as $titulo): ?>
            <article class="card card--titulo reveal <?= $titulo['internacional'] ? 'card--gold' : '' ?>">
                <div class="card__icon">
                    <i class="fas <?= e($titulo['icone']) ?>"></i>
                </div>
                <h3><?= e($titulo['competicao']) ?></h3>
                <span class="card__number"><?= (int) $titulo['quantidade'] ?></span>
                <p class="card__label">título(s)</p>
                <p><?= e($titulo['descricao']) ?></p>
                <?php if ($titulo['ano_destaque']): ?>
                <span class="badge <?= $titulo['internacional'] ? 'badge--gold' : 'badge--red' ?>">
                    <?= e($titulo['ano_destaque']) ?>
                </span>
                <?php endif; ?>
                <?php if ($titulo['internacional']): ?>
                <span class="card__tag">Internacional</span>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
