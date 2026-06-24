<?php
/**
 * idolos.php — Ídolos do Corinthians
 * Cards com foto, descrição e estatísticas do banco MySQL
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$currentPage = 'idolos';
$pageTitle = 'Ídolos do Corinthians — ' . SITE_NAME;
$pageDescription = 'Conheça os maiores ídolos do Corinthians: Sócrates, Rivellino, Marcelinho Carioca, Ronaldo e Cássio.';

$idolos = getIdolos();

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <span class="section__tag">Lendas</span>
        <h1 class="page-hero__title">Ídolos do Corinthians</h1>
        <p>Jogadores que marcaram eternamente a história alvinegra</p>
    </div>
</section>

<section class="section idolos">
    <div class="container">
        <div class="idolos__grid">
            <?php foreach ($idolos as $idolo): ?>
            <article class="idolo-card reveal">
                <div class="idolo-card__image">
                    <img src="<?= e($idolo['imagem']) ?>" alt="<?= e($idolo['nome']) ?>" loading="lazy">
                    <div class="idolo-card__overlay"></div>
                    <span class="idolo-card__pos"><?= e($idolo['posicao']) ?></span>
                </div>
                <div class="idolo-card__body">
                    <h3><?= e($idolo['nome']) ?></h3>
                    <p><?= e($idolo['descricao']) ?></p>
                    <ul class="idolo-card__stats">
                        <li><i class="fas fa-shirt"></i> <strong><?= (int) $idolo['jogos'] ?></strong> jogos</li>
                        <li><i class="fas fa-futbol"></i> <strong><?= (int) $idolo['gols'] ?></strong> gols</li>
                        <li><i class="fas fa-trophy"></i> <strong><?= (int) $idolo['titulos_clube'] ?></strong> títulos</li>
                    </ul>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
