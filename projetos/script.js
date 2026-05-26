/**
 * script.js — Front-end do site Corinthians
 * Carrega dados da API PHP e controla interatividade
 */

(function () {
    'use strict';

    // URL da API relativa à pasta atual (funciona em localhost e subpastas)
    const API_URL = new URL('api/index.php', window.location.href).href;

    /* ---------- Estado global ---------- */
    let siteData = null;
    let galleryImages = [];
    let currentGalleryIndex = 0;

    /* ---------- Elementos DOM (atualizados após render) ---------- */
    let loader, header, navToggle, navMenu, navLinks, backToTop;
    let lightbox, lightboxImg, lightboxCaption, lightboxClose, lightboxPrev, lightboxNext;

    /* ---------- Utilitários ---------- */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function sectionHeader(tag, title, desc, light) {
        const lightClass = light ? ' section__title--light' : '';
        const descClass = light ? ' section__desc--light' : '';
        return `
            <header class="section__header reveal">
                <span class="section__tag">${escapeHtml(tag)}</span>
                <h2 class="section__title${lightClass}">${escapeHtml(title)}</h2>
                <p class="section__desc${descClass}">${escapeHtml(desc)}</p>
            </header>
        `;
    }

    /* ---------- Busca dados na API PHP ---------- */
    async function fetchSiteData() {
        const response = await fetch(API_URL);

        if (!response.ok) {
            throw new Error('Falha na requisição à API');
        }

        const json = await response.json();

        if (!json.success || !json.data) {
            throw new Error(json.message || 'Dados inválidos');
        }

        return json.data;
    }

    /* ---------- Renderização das seções ---------- */
    function renderHero(hero) {
        return `
            <section class="hero" id="hero">
                <div class="hero__overlay"></div>
                <div class="hero__content container">
                    <span class="hero__badge">${escapeHtml(hero.badge)}</span>
                    <h1 class="hero__title">${escapeHtml(hero.title)}</h1>
                    <p class="hero__subtitle">${escapeHtml(hero.subtitle)}</p>
                    <a href="#historia" class="btn btn--primary hero__btn">
                        <span>${escapeHtml(hero.btnText)}</span>
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </div>
                <div class="hero__scroll">
                    <span>${escapeHtml(hero.scrollText)}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </section>
        `;
    }

    function renderHistoria(h) {
        const paragraphs = h.paragraphs.map((p) => `<p>${p}</p>`).join('');
        return `
            <section class="section historia" id="historia">
                <div class="container">
                    ${sectionHeader(h.tag, h.title, h.desc)}
                    <div class="historia__grid">
                        <div class="historia__text reveal">${paragraphs}</div>
                        <div class="historia__image reveal reveal--delay">
                            <img src="${escapeHtml(h.image)}" alt="${escapeHtml(h.imageAlt)}" loading="lazy">
                            <div class="historia__image-badge">
                                <span class="historia__year">${escapeHtml(h.year)}</span>
                                <span>${escapeHtml(h.badge)}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    function renderTimeline(t) {
        const cards = t.items.map((marco, index) => {
            const side = index % 2 === 0 ? 'left' : 'right';
            return `
                <article class="timeline__card reveal timeline__card--${side}">
                    <div class="timeline__icon">
                        <i class="fas ${marco.icone}"></i>
                    </div>
                    <div class="timeline__content">
                        <span class="timeline__year">${escapeHtml(marco.ano)}</span>
                        <h3>${escapeHtml(marco.titulo)}</h3>
                        <p>${escapeHtml(marco.desc)}</p>
                    </div>
                </article>
            `;
        }).join('');

        return `
            <section class="section timeline-section" id="timeline">
                <div class="container">
                    ${sectionHeader(t.tag, t.title, t.desc)}
                    <div class="timeline">${cards}</div>
                </div>
            </section>
        `;
    }

    function renderIdolos(i) {
        const cards = i.items.map((idolo) => `
            <article class="idolo-card reveal">
                <div class="idolo-card__image">
                    <img src="${escapeHtml(idolo.img)}" alt="${escapeHtml(idolo.nome)}" loading="lazy">
                    <div class="idolo-card__overlay"></div>
                </div>
                <div class="idolo-card__body">
                    <h3>${escapeHtml(idolo.nome)}</h3>
                    <p>${escapeHtml(idolo.desc)}</p>
                </div>
            </article>
        `).join('');

        return `
            <section class="section idolos" id="idolos">
                <div class="container">
                    ${sectionHeader(i.tag, i.title, i.desc)}
                    <div class="idolos__grid">${cards}</div>
                </div>
            </section>
        `;
    }

    function renderTitulos(t) {
        const rows = t.items.map((item) => {
            const highlightClass = item.highlight ? ' titulos__row--highlight' : '';
            const destaque = item.badge
                ? `<span class="badge badge--gold">${escapeHtml(item.destaque)}</span>`
                : escapeHtml(item.destaque);

            return `
                <tr class="${highlightClass.trim()}">
                    <td><i class="fas ${item.icone}"></i> ${escapeHtml(item.competicao)}</td>
                    <td><span class="titulos__count">${item.quantidade}</span></td>
                    <td>${destaque}</td>
                </tr>
            `;
        }).join('');

        return `
            <section class="section titulos" id="titulos">
                <div class="container">
                    ${sectionHeader(t.tag, t.title, t.desc)}
                    <div class="titulos__wrapper reveal">
                        <table class="titulos__table">
                            <thead>
                                <tr>
                                    <th>Competição</th>
                                    <th>Quantidade</th>
                                    <th>Destaque</th>
                                </tr>
                            </thead>
                            <tbody>${rows}</tbody>
                        </table>
                    </div>
                </div>
            </section>
        `;
    }

    function renderGaleria(g) {
        const items = g.items.map((item, index) => `
            <figure class="galeria__item reveal" data-index="${index}">
                <img src="${escapeHtml(item.src)}" alt="${escapeHtml(item.alt)}"
                     data-caption="${escapeHtml(item.caption)}" loading="lazy">
                <figcaption>${escapeHtml(item.caption)}</figcaption>
                <div class="galeria__zoom"><i class="fas fa-search-plus"></i></div>
            </figure>
        `).join('');

        return `
            <section class="section galeria" id="galeria">
                <div class="container">
                    ${sectionHeader(g.tag, g.title, g.desc)}
                    <div class="galeria__grid">${items}</div>
                </div>
            </section>
        `;
    }

    function renderCuriosidades(c) {
        const cards = c.items.map((item) => {
            const delayClass = item.delay ? ' reveal--delay' : '';
            return `
                <article class="curio-card reveal${delayClass}">
                    <div class="curio-card__icon">
                        <i class="fas ${item.icone}"></i>
                    </div>
                    <h3>${escapeHtml(item.titulo)}</h3>
                    <p>${escapeHtml(item.texto)}</p>
                </article>
            `;
        }).join('');

        return `
            <section class="section curiosidades" id="curiosidades">
                <div class="container">
                    ${sectionHeader(c.tag, c.title, c.desc)}
                    <div class="curiosidades__grid">${cards}</div>
                </div>
            </section>
        `;
    }

    function renderArena(a) {
        const paragraphs = a.paragraphs.map((p) => `<p>${p}</p>`).join('');
        const stats = a.stats.map((s) => `
            <li>
                <i class="fas ${s.icone}"></i>
                <div>
                    <strong>${escapeHtml(s.valor)}</strong>
                    <span>${escapeHtml(s.label)}</span>
                </div>
            </li>
        `).join('');

        return `
            <section class="section arena" id="arena">
                <div class="arena__bg"></div>
                <div class="container arena__content">
                    ${sectionHeader(a.tag, a.title, a.desc, true)}
                    <div class="arena__grid">
                        <div class="arena__text reveal">
                            ${paragraphs}
                            <ul class="arena__stats">${stats}</ul>
                        </div>
                        <div class="arena__image reveal reveal--delay">
                            <img src="${escapeHtml(a.image)}" alt="${escapeHtml(a.imageAlt)}" loading="lazy">
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    function renderApp(data) {
        const app = document.getElementById('app');
        app.innerHTML =
            renderHero(data.hero) +
            renderHistoria(data.historia) +
            renderTimeline(data.timeline) +
            renderIdolos(data.idolos) +
            renderTitulos(data.titulos) +
            renderGaleria(data.galeria) +
            renderCuriosidades(data.curiosidades) +
            renderArena(data.arena);

        document.title = data.site.title;
        document.querySelector('meta[name="description"]').setAttribute('content', data.site.description);
        document.getElementById('footer-copyright').textContent =
            '© ' + data.site.year + ' ' + data.footer.copyright;
        document.getElementById('footer-cheer').innerHTML =
            '<strong>' + escapeHtml(data.footer.cheer) + '</strong>';
        document.getElementById('footer-tagline').textContent = data.footer.tagline;
    }

    function showApiError() {
        const app = document.getElementById('app');
        app.innerHTML = `
            <div id="api-error" class="api-error">
                <i class="fas fa-triangle-exclamation"></i>
                <h2>Não foi possível carregar o conteúdo</h2>
                <p>Dê duplo clique em <strong>iniciar-servidor.bat</strong> nesta pasta.</p>
                <p>Ou no terminal: <code>php -S localhost:8000 router.php</code></p>
                <p>Depois acesse: <code>http://localhost:8000/</code></p>
                <button type="button" id="btn-retry" class="btn btn--primary">Tentar novamente</button>
            </div>
        `;
        document.getElementById('btn-retry').addEventListener('click', loadAndInit);
        hideLoader();
    }

    /* ---------- Cache de seletores DOM ---------- */
    function cacheDomElements() {
        loader = document.getElementById('loader');
        header = document.getElementById('header');
        navToggle = document.getElementById('nav-toggle');
        navMenu = document.getElementById('nav-menu');
        navLinks = document.querySelectorAll('.nav__link');
        backToTop = document.getElementById('back-to-top');
        lightbox = document.getElementById('lightbox');
        lightboxImg = document.getElementById('lightbox-img');
        lightboxCaption = document.getElementById('lightbox-caption');
        lightboxClose = document.getElementById('lightbox-close');
        lightboxPrev = document.getElementById('lightbox-prev');
        lightboxNext = document.getElementById('lightbox-next');
    }

    function hideLoader() {
        setTimeout(function () {
            loader.classList.add('hidden');
            document.body.classList.remove('no-scroll');
        }, 800);
    }

    /* ---------- Módulos de interatividade ---------- */
    function initLoader() {
        document.body.classList.add('no-scroll');
    }

    function initMobileMenu() {
        navToggle.addEventListener('click', function () {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });

        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });
    }

    function initHeaderScroll() {
        function updateHeader() {
            header.classList.toggle('scrolled', window.scrollY > 80);
        }
        window.addEventListener('scroll', updateHeader);
        updateHeader();
    }

    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    const offset = parseInt(
                        getComputedStyle(document.documentElement).scrollPaddingTop || 72,
                        10
                    );
                    window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
                }
            });
        });
    }

    function initActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');

        function highlightNav() {
            const scrollPos = window.scrollY + 120;
            sections.forEach(function (section) {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    navLinks.forEach(function (link) {
                        link.classList.toggle('active', link.getAttribute('href') === '#' + sectionId);
                    });
                }
            });
        }

        window.addEventListener('scroll', highlightNav);
        highlightNav();
    }

    function initScrollAnimations() {
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { root: null, rootMargin: '0px 0px -80px 0px', threshold: 0.15 });

        revealElements.forEach(function (el) {
            observer.observe(el);
        });
    }

    function initBackToTop() {
        window.addEventListener('scroll', function () {
            backToTop.classList.toggle('visible', window.scrollY > 500);
        });
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    function buildGalleryData() {
        galleryImages = [];
        document.querySelectorAll('.galeria__item').forEach(function (item) {
            const img = item.querySelector('img');
            if (img) {
                galleryImages.push({
                    src: img.src,
                    alt: img.alt,
                    caption: img.getAttribute('data-caption') || img.alt,
                });
            }
        });
    }

    function openLightbox(index) {
        if (!galleryImages.length) return;
        currentGalleryIndex = index;
        const current = galleryImages[currentGalleryIndex];
        lightboxImg.src = current.src;
        lightboxImg.alt = current.alt;
        lightboxCaption.textContent = current.caption;
        lightbox.classList.add('active');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
    }

    function showPrevImage() {
        currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
        openLightbox(currentGalleryIndex);
    }

    function showNextImage() {
        currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
        openLightbox(currentGalleryIndex);
    }

    function initLightbox() {
        buildGalleryData();
        document.querySelectorAll('.galeria__item').forEach(function (item) {
            item.addEventListener('click', function () {
                openLightbox(parseInt(item.getAttribute('data-index'), 10) || 0);
            });
        });
        lightboxClose.addEventListener('click', closeLightbox);
        lightboxPrev.addEventListener('click', showPrevImage);
        lightboxNext.addEventListener('click', showNextImage);
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });
        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') showPrevImage();
            if (e.key === 'ArrowRight') showNextImage();
        });
    }

    function initUI() {
        initMobileMenu();
        initHeaderScroll();
        initSmoothScroll();
        initActiveNavLink();
        initScrollAnimations();
        initBackToTop();
        initLightbox();
    }

    /* ---------- Fluxo principal: API → render → UI ---------- */
    async function loadAndInit() {
        cacheDomElements();
        initLoader();

        try {
            siteData = await fetchSiteData();
            renderApp(siteData);
            initUI();
            hideLoader();
        } catch (err) {
            console.error('Erro ao carregar API:', err);
            showApiError();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadAndInit);
    } else {
        loadAndInit();
    }
})();
