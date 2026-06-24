<?php
/**
 * arena.php — Neo Química Arena
 * História, informações, capacidade, localização e galeria
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'arena';
$pageTitle = 'Neo Química Arena — ' . SITE_NAME;
$pageDescription = 'História e informações da Neo Química Arena, estádio do Corinthians em Itaquera, São Paulo.';

$galeriaArena = getGaleria('arena');
$galeriaEstadio = getGaleria('estadio');
$imagens = array_merge($galeriaArena, $galeriaEstadio);

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero--arena">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Nossa Casa</span>
        <h1 class="page-hero__title">Neo Química Arena</h1>
        <p>O estádio que abrigou a Copa do Mundo 2014</p>
    </div>
</section>

<section class="section arena">
    <div class="container">
        <div class="arena__grid">
            <div class="arena__text reveal">
                <h2 class="section__title section__title--sm">História do Estádio</h2>
                <p>A <strong>Neo Química Arena</strong>, popularmente conhecida como Arena Corinthians, é o estádio oficial do Sport Club Corinthians Paulista, localizado na zona leste de São Paulo, no bairro de <strong>Itaquera</strong>.</p>
                <p>Inaugurada em <strong>18 de maio de 2014</strong>, a arena foi palco da abertura da Copa do Mundo FIFA Brasil 2014 e tornou-se símbolo da modernização do clube.</p>
                <p>Para a Fiel Torcida, a Arena representa orgulho, pertencimento e a realização do sonho de ter um estádio próprio à altura da grandeza do Corinthians.</p>

                <ul class="arena__stats">
                    <li>
                        <i class="fas fa-users"></i>
                        <div>
                            <strong>49.205</strong>
                            <span>Capacidade (futebol)</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-calendar"></i>
                        <div>
                            <strong>2014</strong>
                            <span>Ano de inauguração</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Itaquera</strong>
                            <span>Zona Leste — São Paulo, SP</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-futbol"></i>
                        <div>
                            <strong>Copa 2014</strong>
                            <span>Abertura do Mundial FIFA</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="arena__image reveal reveal--delay">
                <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a9?w=1200&q=80"
                     alt="Neo Química Arena" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Galeria da Arena -->
<?php if (!empty($imagens)): ?>
<section class="section galeria">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Imagens</span>
            <h2 class="section__title">Galeria da Arena</h2>
        </header>
        <div class="galeria__grid">
            <?php foreach ($imagens as $i => $item): ?>
            <figure class="galeria__item reveal" data-index="<?= $i ?>">
                <img src="<?= e($item['imagem']) ?>" alt="<?= e($item['titulo']) ?>"
                     data-caption="<?= e($item['titulo']) ?>" loading="lazy">
                <figcaption><?= e($item['titulo']) ?></figcaption>
                <div class="galeria__zoom"><i class="fas fa-search-plus"></i></div>
            </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
