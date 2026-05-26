<?php
/**
 * data.php — Dados do site Corinthians
 * Centraliza todo o conteúdo consumido pela API
 */

/**
 * Retorna todos os dados do site em um array associativo
 */
function getSiteData(): array
{
    return [
        'site' => [
            'title' => 'Sport Club Corinthians Paulista — A História do Time do Povo',
            'description' => 'A história completa do Sport Club Corinthians Paulista — o time do povo.',
            'year' => (int) date('Y'),
        ],
        'hero' => [
            'badge' => 'Fundado em 1910',
            'title' => 'Sport Club Corinthians Paulista',
            'subtitle' => 'A história do time do povo',
            'btnText' => 'Conheça a História',
            'scrollText' => 'Role para explorar',
        ],
        'historia' => [
            'tag' => 'Nossa Origem',
            'title' => 'História do Clube',
            'desc' => 'Mais de um século de paixão, luta e glórias no futebol brasileiro',
            'paragraphs' => [
                'O <strong>Sport Club Corinthians Paulista</strong> foi fundado em <strong>1º de setembro de 1910</strong>, no bairro do Bom Retiro, em São Paulo, por um grupo de operários inspirados no time inglês Corinthian-Casuals.',
                'Desde o início, o clube representou a origem popular do futebol paulista — o time das ruas, das fábricas e do povo. Essa identidade moldou uma torcida apaixonada e combativa, que acompanhou o crescimento do Timão no cenário nacional.',
                'Ao longo das décadas, o Corinthians consolidou-se como um dos maiores clubes do Brasil, conquistando títulos estaduais, nacionais e internacionais, sempre com a fiel ao lado, em momentos de glória e de superação.',
                'Para milhões de corinthianos, o clube é mais que futebol: é identidade, resistência e orgulho. O lema <em>"O time do povo"</em> resume uma história única no esporte brasileiro.',
            ],
            'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&q=80',
            'imageAlt' => 'Torcida em estádio de futebol',
            'year' => '1910',
            'badge' => 'Time do Povo',
        ],
        'timeline' => [
            'tag' => 'Marcos Históricos',
            'title' => 'Linha do Tempo',
            'desc' => 'Os momentos que definiram a história alvinegra',
            'items' => [
                ['ano' => '1910', 'titulo' => 'Fundação do Clube', 'desc' => 'Nascimento do Sport Club Corinthians Paulista no Bom Retiro, São Paulo.', 'icone' => 'fa-flag'],
                ['ano' => '1977', 'titulo' => 'Fim do Jejum', 'desc' => 'Após 23 anos, o Timão conquista o Campeonato Paulista e encerra o jejum de títulos.', 'icone' => 'fa-trophy'],
                ['ano' => '1990', 'titulo' => 'Primeiro Brasileiro', 'desc' => 'Corinthians vence o primeiro Campeonato Brasileiro da história do clube.', 'icone' => 'fa-medal'],
                ['ano' => '2000', 'titulo' => 'Primeiro Mundial', 'desc' => 'Conquista histórica da Copa do Mundo de Clubes da FIFA em 2000.', 'icone' => 'fa-globe'],
                ['ano' => '2012', 'titulo' => 'Libertadores Invicta', 'desc' => 'Campeão da Libertadores sem perder nenhuma partida na campanha.', 'icone' => 'fa-star'],
                ['ano' => '2012', 'titulo' => 'Bicampeão Mundial', 'desc' => 'Segundo título mundial da FIFA, confirmando a era dourada do clube.', 'icone' => 'fa-crown'],
                ['ano' => '2015', 'titulo' => 'Hexacampeonato', 'desc' => 'Sexto título do Campeonato Brasileiro, consolidando o domínio nacional.', 'icone' => 'fa-fire'],
            ],
        ],
        'idolos' => [
            'tag' => 'Lendas Alvinegras',
            'title' => 'Ídolos do Corinthians',
            'desc' => 'Jogadores que marcaram eternamente a história do Timão',
            'items' => [
                ['nome' => 'Sócrates', 'desc' => 'Médico, capitão e símbolo da Democracia Corinthiana. Liderança dentro e fora de campo.', 'img' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?w=600&q=80'],
                ['nome' => 'Marcelinho Carioca', 'desc' => 'O "Pequeno Gigante". Drible, gols e paixão que eternizaram a camisa 10.', 'img' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&q=80'],
                ['nome' => 'Ronaldo Fenômeno', 'desc' => 'Um dos maiores atacantes do mundo. Passagem vitoriosa e gols inesquecíveis no Parque.', 'img' => 'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?w=600&q=80'],
                ['nome' => 'Cássio', 'desc' => 'Goleiro histórico, líder de vestiário e protagonista das conquistas da era moderna.', 'img' => 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=600&q=80'],
            ],
        ],
        'titulos' => [
            'tag' => 'Conquistas',
            'title' => 'Títulos Importantes',
            'desc' => 'O palmarés que consolida o Corinthians entre os gigantes',
            'items' => [
                ['competicao' => 'Campeonato Brasileiro', 'icone' => 'fa-trophy', 'quantidade' => 7, 'destaque' => 'Hexa em 2015', 'highlight' => false],
                ['competicao' => 'Copa do Brasil', 'icone' => 'fa-trophy', 'quantidade' => 3, 'destaque' => 'Tricampeão', 'highlight' => false],
                ['competicao' => 'Copa Libertadores', 'icone' => 'fa-globe-americas', 'quantidade' => 1, 'destaque' => 'Invicta 2012', 'highlight' => true, 'badge' => true],
                ['competicao' => 'Mundial de Clubes', 'icone' => 'fa-earth-americas', 'quantidade' => 2, 'destaque' => '2000 e 2012', 'highlight' => true, 'badge' => true],
                ['competicao' => 'Campeonato Paulista', 'icone' => 'fa-trophy', 'quantidade' => 30, 'destaque' => 'Maior campeão estadual', 'highlight' => false],
            ],
        ],
        'galeria' => [
            'tag' => 'Memórias',
            'title' => 'Galeria',
            'desc' => 'Imagens que contam a paixão alvinegra',
            'items' => [
                ['src' => 'https://images.unsplash.com/photo-1459865269677-1af658c7796d?w=800&q=80', 'alt' => 'Torcida vibrante no estádio', 'caption' => 'Torcida'],
                ['src' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a9?w=800&q=80', 'alt' => 'Estádio de futebol moderno', 'caption' => 'Estádio'],
                ['src' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&q=80', 'alt' => 'Jogadores em campo', 'caption' => 'Jogadores'],
                ['src' => 'https://images.unsplash.com/photo-1518609878373-06d740f0d4b6?w=800&q=80', 'alt' => 'Comemoração de gol', 'caption' => 'Comemorações'],
                ['src' => 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=800&q=80', 'alt' => 'Futebol em estádio lotado', 'caption' => 'Arena lotada'],
                ['src' => 'https://images.unsplash.com/photo-1551958219-ac31c4c53e19?w=800&q=80', 'alt' => 'Torcida com bandeiras', 'caption' => 'Fiel Torcida'],
            ],
        ],
        'curiosidades' => [
            'tag' => 'Você Sabia?',
            'title' => 'Curiosidades',
            'desc' => 'Fatos fascinantes sobre o maior clube do povo',
            'items' => [
                ['titulo' => 'Maior Torcida de SP', 'texto' => 'O Corinthians possui a maior torcida do estado de São Paulo e uma das maiores do Brasil, com milhões de apaixonados em todo o país.', 'icone' => 'fa-users', 'delay' => false],
                ['titulo' => 'Democracia Corinthiana', 'texto' => 'Movimento dos anos 1980 em que jogadores participavam das decisões do clube, liderado por Sócrates, Wladimir e Casagrande.', 'icone' => 'fa-hand-peace', 'delay' => true],
                ['titulo' => 'Arena Corinthians', 'texto' => 'A Neo Química Arena foi construída para a Copa do Mundo de 2014 e é um dos estádios mais modernos da América Latina.', 'icone' => 'fa-building', 'delay' => false],
                ['titulo' => 'Recordes Históricos', 'texto' => 'Único campeão mundial invicto em 2012, maior campeão paulista e um dos clubes com mais títulos nacionais do Brasil.', 'icone' => 'fa-chart-line', 'delay' => true],
            ],
        ],
        'arena' => [
            'tag' => 'Nossa Casa',
            'title' => 'Neo Química Arena',
            'desc' => 'O estádio que abrigou a Copa do Mundo e a nova era do Timão',
            'paragraphs' => [
                'A <strong>Neo Química Arena</strong>, popularmente conhecida como Arena Corinthians, é o estádio oficial do Sport Club Corinthians Paulista, localizado na zona leste de São Paulo, no bairro de Itaquera.',
                'Inaugurada em <strong>2014</strong>, a arena foi palco da abertura da Copa do Mundo FIFA Brasil 2014 e tornou-se símbolo da modernização do clube, oferecendo estrutura de ponta para torcedores e atletas.',
                'Para a Fiel Torcida, a Arena representa orgulho, pertencimento e a realização do sonho de ter um estádio próprio à altura da grandeza do Corinthians.',
            ],
            'stats' => [
                ['valor' => '49.205', 'label' => 'Capacidade (futebol)', 'icone' => 'fa-users'],
                ['valor' => '2014', 'label' => 'Ano de inauguração', 'icone' => 'fa-calendar'],
                ['valor' => 'Copa 2014', 'label' => 'Abertura do Mundial', 'icone' => 'fa-futbol'],
            ],
            'image' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a9?w=1200&q=80',
            'imageAlt' => 'Vista panorâmica de estádio de futebol',
        ],
        'footer' => [
            'tagline' => 'O time do povo desde 1910',
            'cheer' => 'Vai Corinthians!',
            'copyright' => 'Sport Club Corinthians Paulista — Site educacional.',
        ],
    ];
}
