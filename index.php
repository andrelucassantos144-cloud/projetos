<?php
/**
 * index.php — Página inicial do site
 * Banner, apresentação, destaques de títulos, notícias e timeline
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'home';
$pageTitle = SITE_NAME . ' — História do Time do Povo';
$pageDescription = 'Site institucional sobre a história do Sport Club Corinthians Paulista. Títulos, ídolos, Arena e muito mais.';

$titulos = getTitulos();
$noticias = getNoticias(3);
$timeline = getTimeline();

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero / Banner principal -->
<section class="hero" id="hero">
    <div class="hero__overlay"></div>
    <div class="hero__content container">
        <span class="hero__badge">Fundado em 1910</span>
        <h1 class="hero__title">Sport Club Corinthians Paulista</h1>
        <p class="hero__subtitle">A história do time do povo</p>
        <a href="<?= url('historia.php') ?>" class="btn btn--primary hero__btn">
            <span>Conheça a História</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <div class="hero__scroll">
        <span>Role para explorar</span>
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Apresentação do clube -->
<section class="section" id="apresentacao">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">O Timão</span>
            <h2 class="section__title">O Time do Povo</h2>
            <p class="section__desc">Mais de um século de paixão, luta e glórias no futebol brasileiro</p>
        </header>
        <div class="historia__grid">
            <div class="historia__text reveal">
                <p>O <strong>Sport Club Corinthians Paulista</strong> foi fundado em <strong>1º de setembro de 1910</strong>, no bairro do Bom Retiro, em São Paulo, por um grupo de operários inspirados no time inglês Corinthian-Casuals.</p>
                <p>Desde o início, o clube representou a origem popular do futebol paulista — o time das ruas, das fábricas e do povo. Essa identidade moldou a maior torcida de São Paulo e uma das maiores do Brasil.</p>
                <a href="<?= url('historia.php') ?>" class="btn btn--primary">Ler história completa</a>
            </div>
            <div class="historia__image reveal reveal--delay">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&q=80"
                     alt="Torcida corinthiana no estádio" loading="lazy">
                <div class="historia__image-badge">
                    <span class="historia__year">1910</span>
                    <span>Time do Povo</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Destaques de títulos (cards do banco) -->
<section class="section titulos" id="destaques">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Conquistas</span>
            <h2 class="section__title">Principais Títulos</h2>
            <p class="section__desc">O palmarés que consolida o Corinthians entre os gigantes</p>
        </header>
        <div class="cards-grid">
            <?php foreach ($titulos as $titulo): ?>
            <article class="card card--titulo reveal <?= $titulo['internacional'] ? 'card--gold' : '' ?>">
                <div class="card__icon"><i class="fas <?= e($titulo['icone']) ?>"></i></div>
                <h3><?= e($titulo['competicao']) ?></h3>
                <span class="card__number"><?= (int) $titulo['quantidade'] ?></span>
                <p><?= e($titulo['descricao']) ?></p>
                <?php if ($titulo['ano_destaque']): ?>
                <span class="badge badge--gold"><?= e($titulo['ano_destaque']) ?></span>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="section__cta reveal">
            <a href="<?= url('titulos.php') ?>" class="btn btn--outline">Ver todos os títulos</a>
        </div>
    </div>
</section>

<!-- Linha do tempo resumida -->
<section class="section timeline-section" id="timeline">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Marcos</span>
            <h2 class="section__title">Linha do Tempo</h2>
            <p class="section__desc">Os momentos que definiram a história alvinegra</p>
        </header>
        <div class="timeline">
            <?php foreach ($timeline as $i => $marco):
                $side = $i % 2 === 0 ? 'left' : 'right';
            ?>
            <article class="timeline__card reveal timeline__card--<?= $side ?>">
                <div class="timeline__icon"><i class="fas <?= e($marco['icone']) ?>"></i></div>
                <div class="timeline__content">
                    <span class="timeline__year"><?= e($marco['ano']) ?></span>
                    <h3><?= e($marco['titulo']) ?></h3>
                    <p><?= e($marco['descricao']) ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Notícias do banco (admin) -->
<?php if (!empty($noticias)): ?>
<section class="section noticias" id="noticias">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Notícias</span>
            <h2 class="section__title">Últimas Notícias</h2>
            <p class="section__desc">Conteúdo atualizado pela área administrativa</p>
        </header>
        <div class="cards-grid cards-grid--3">
            <?php foreach ($noticias as $noticia): ?>
            <article class="card card--noticia reveal">
                <?php if ($noticia['imagem']): ?>
                <div class="card__img">
                    <img src="<?= e($noticia['imagem']) ?>" alt="<?= e($noticia['titulo']) ?>" loading="lazy">
                </div>
                <?php endif; ?>
                <div class="card__body">
                    <time datetime="<?= e($noticia['criado_em']) ?>"><?= formatarData($noticia['criado_em']) ?></time>
                    <h3><?= e($noticia['titulo']) ?></h3>
                    <p><?= e($noticia['resumo']) ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
