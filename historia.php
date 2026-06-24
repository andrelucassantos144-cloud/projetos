<?php
/**
 * historia.php — História completa do clube
 * Fundação, origem do nome, evolução e curiosidades
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'historia';
$pageTitle = 'História do Clube — ' . SITE_NAME;
$pageDescription = 'A história do Corinthians desde a fundação em 1910, origem do nome, primeiros anos e evolução ao longo das décadas.';

$timeline = getTimeline();

require_once __DIR__ . '/includes/header.php';
?>

<!-- Cabeçalho da página -->
<section class="page-hero">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Nossa Origem</span>
        <h1 class="page-hero__title">História do Clube</h1>
        <p>Mais de um século de paixão alvinegra</p>
    </div>
</section>

<!-- Fundação e origem -->
<section class="section historia">
    <div class="container">
        <div class="historia__grid">
            <div class="historia__text reveal">
                <h2 class="section__title section__title--sm">Fundação em 1910</h2>
                <p>O <strong>Sport Club Corinthians Paulista</strong> foi fundado em <strong>1º de setembro de 1910</strong>, no bairro do Bom Retiro, em São Paulo. Um grupo de operários, liderados por Miguel Battaglia e Sebastião Pereira Neves, decidiu criar um clube de futebol após assistir a uma partida do Corinthians FC da Inglaterra.</p>

                <h2 class="section__title section__title--sm">Origem do Nome</h2>
                <p>O nome foi inspirado no <strong>Corinthian-Casuals Football Club</strong>, time inglês que realizava uma excursão pelo Brasil em 1910. Os fundadores, trabalhadores da região central de São Paulo, escolheram o nome "Corinthians" como símbolo de organização, disciplina e amor ao futebol.</p>

                <h2 class="section__title section__title--sm">Primeiros Anos</h2>
                <p>Nos primeiros anos, o clube disputou campeonatos locais e construiu sua identidade popular. Em <strong>1915</strong>, conquistou o primeiro Campeonato Paulista, iniciando uma trajetória de glórias que se estende por mais de um século.</p>
            </div>
            <div class="historia__image reveal reveal--delay">
                <img src="https://images.unsplash.com/photo-1459865269677-1af658c7796d?w=800&q=80"
                     alt="História do futebol brasileiro" loading="lazy">
                <div class="historia__image-badge">
                    <span class="historia__year">1910</span>
                    <span>Bom Retiro, SP</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Evolução ao longo das décadas -->
<section class="section section--dark">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Evolução</span>
            <h2 class="section__title">Décadas de Conquistas</h2>
        </header>
        <div class="decadas-grid">
            <article class="curio-card reveal">
                <div class="curio-card__icon"><i class="fas fa-industry"></i></div>
                <h3>1910–1950</h3>
                <p>Consolidação como clube popular. Primeiros títulos paulistas e formação da maior torcida de São Paulo.</p>
            </article>
            <article class="curio-card reveal reveal--delay">
                <div class="curio-card__icon"><i class="fas fa-star"></i></div>
                <h3>1950–1980</h3>
                <p>Era dos ídolos como Rivellino. O jejum de 23 anos e a conquista histórica de 1977.</p>
            </article>
            <article class="curio-card reveal">
                <div class="curio-card__icon"><i class="fas fa-hand-peace"></i></div>
                <h3>1980–2000</h3>
                <p>Democracia Corinthiana com Sócrates. Primeiro Brasileiro (1990) e primeiro Mundial (2000).</p>
            </article>
            <article class="curio-card reveal reveal--delay">
                <div class="curio-card__icon"><i class="fas fa-crown"></i></div>
                <h3>2000–Hoje</h3>
                <p>Libertadores invicta (2012), bicampeonato mundial, Hexa brasileiro (2015) e a Neo Química Arena.</p>
            </article>
        </div>
    </div>
</section>

<!-- Curiosidades históricas -->
<section class="section curiosidades">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Você Sabia?</span>
            <h2 class="section__title">Curiosidades Históricas</h2>
        </header>
        <div class="curiosidades__grid">
            <article class="curio-card reveal">
                <div class="curio-card__icon"><i class="fas fa-users"></i></div>
                <h3>Maior Torcida de SP</h3>
                <p>O Corinthians possui a maior torcida do estado de São Paulo, com milhões de apaixonados em todo o Brasil.</p>
            </article>
            <article class="curio-card reveal reveal--delay">
                <div class="curio-card__icon"><i class="fas fa-hand-peace"></i></div>
                <h3>Democracia Corinthiana</h3>
                <p>Movimento dos anos 1980 em que jogadores participavam das decisões do clube, liderado por Sócrates.</p>
            </article>
            <article class="curio-card reveal">
                <div class="curio-card__icon"><i class="fas fa-hourglass-half"></i></div>
                <h3>O Jejum</h3>
                <p>De 1954 a 1977, o Corinthians ficou 23 anos sem conquistar o Campeonato Paulista.</p>
            </article>
            <article class="curio-card reveal reveal--delay">
                <div class="curio-card__icon"><i class="fas fa-shield-halved"></i></div>
                <h3>Libertadores Invicta</h3>
                <p>Em 2012, o Timão conquistou a Libertadores sem perder nenhuma partida na campanha.</p>
            </article>
        </div>
    </div>
</section>

<!-- Timeline completa -->
<section class="section timeline-section" id="timeline-completa">
    <div class="container">
        <header class="section__header reveal">
            <span class="section__tag">Linha do Tempo</span>
            <h2 class="section__title">Principais Acontecimentos</h2>
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>
