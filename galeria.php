<?php
/**
 * galeria.php — Galeria de imagens com lightbox
 * Fotos históricas, estádio, jogadores e torcida
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'galeria';
$pageTitle = 'Galeria de Imagens — ' . SITE_NAME;
$pageDescription = 'Galeria de fotos históricas do Corinthians: torcida, estádio, jogadores e comemorações.';

$categoria = $_GET['categoria'] ?? null;
$galeria = getGaleria($categoria);
$categorias = ['historica', 'estadio', 'jogadores', 'torcida', 'arena'];

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Memórias</span>
        <h1 class="page-hero__title">Galeria de Imagens</h1>
        <p>Clique nas fotos para ampliar</p>
    </div>
</section>

<section class="section galeria">
    <div class="container">
        <!-- Filtro por categoria -->
        <nav class="galeria__filtros reveal" aria-label="Filtrar galeria">
            <a href="<?= url('galeria.php') ?>" class="filtro-btn <?= !$categoria ? 'active' : '' ?>">Todas</a>
            <?php foreach ($categorias as $cat): ?>
            <a href="<?= url('galeria.php?categoria=' . $cat) ?>"
               class="filtro-btn <?= $categoria === $cat ? 'active' : '' ?>">
                <?= nomeCategoria($cat) ?>
            </a>
            <?php endforeach; ?>
        </nav>

        <?php if (empty($galeria)): ?>
        <p class="empty-msg reveal">Nenhuma imagem encontrada nesta categoria.</p>
        <?php else: ?>
        <div class="galeria__grid">
            <?php foreach ($galeria as $i => $item): ?>
            <figure class="galeria__item reveal" data-index="<?= $i ?>">
                <img src="<?= e($item['imagem']) ?>" alt="<?= e($item['titulo']) ?>"
                     data-caption="<?= e($item['titulo']) ?>" loading="lazy">
                <figcaption>
                    <span class="galeria__cat"><?= nomeCategoria($item['categoria']) ?></span>
                    <?= e($item['titulo']) ?>
                </figcaption>
                <div class="galeria__zoom"><i class="fas fa-search-plus"></i></div>
            </figure>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
