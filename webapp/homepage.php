<?php
session_start();
include('conexao_db.php');

if (!isset($_SESSION['login'])) {
    $_SESSION['msg_alert'] = ['danger', "Acesso negado!"];
    header('Location: index.php');
    exit;
}

$login = $_SESSION['login'];

$sql = "UPDATE usuarios SET acesso = acesso + 1 WHERE login = '$login'";

if (mysqli_query($conexao, $sql)) {
    // echo "Registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
};

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<style>
    .d-flex.flex-row.gap-3 {
        overflow-x: auto;
        scrollbar-width: none;
    }

    /* hide webkit scrollbar */
    .d-flex.flex-row.gap-3::-webkit-scrollbar {
        display: none;
    }

    .category-item {
        min-width: 110px;
        flex: 0 0 auto;
        text-align: center;
    }

    .category-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        margin: 0 auto 8px;
        font-size: 28px;
    }

    .category-item:hover .category-circle {
        transform: translateY(-4px);
        transition: transform 180ms ease;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-body-tertiary">
    <?php include 'estrutura/navbar/navbar.php'; ?>
    <?php if (isset($_SESSION['msg_alert'])): ?>
        <div class="position-fixed d-flex justify-content-center start-50 translate-middle-x mb-5 z-3 bottom-0">
            <div id="alert-mensagem" class="alert alert-<?= $_SESSION['msg_alert'][0] ?> alert-dismissible small h-100" role="alert"">
                <div><span><i class=" bi <?php if ($_SESSION['msg_alert'][0] == 'danger') {
                                                echo 'bi-exclamation-triangle';
                                            } else {
                                                echo 'bi-check';
                                            } ?>"></i></span> <?= $_SESSION['msg_alert'][1] ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        <?php unset($_SESSION['msg_alert']); ?>
    <?php endif; ?>
    <div class="container-fluid py-4">
        <div class="d-flex mb-5 justify-content-center align-items-center p-4">
            <div class="col">
                <h1 class="fs-semibold">Ache o seu evento,<br><span class="text-primary">e já combina com os amigos</span></h1>
            </div>
            <div class="col">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="ratio ratio-16x9">
                                <img src="https://conteudo.imguol.com.br/c/entretenimento/37/2024/09/12/o-show-de-travis-scott-na-noite-de-quarta-11-no-allianz-parque-em-sao-paulo-ele-se-apresenta-na-sexta-13-no-rock-in-rio-1726174238313_v2_900x506.jpg" class="rounded-5 shadow-sm d-block w-100 object-fit-cover" alt="...">
                            </div>
                        </div>
                        <div class="carousel-item active">
                            <div class="ratio ratio-16x9">
                                <img src="https://s2-g1.glbimg.com/_hhdPIOLtDKQDWRznDU63dCzqlc=/0x0:1920x1080/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2022/9/F/xB56tLRnCsOzYCnoHlUw/frame-00-44-32.431.jpg" class="rounded-5 shadow-sm d-block w-100 object-fit-cover" alt="...">
                            </div>
                        </div>
                        <div class="carousel-item active">
                            <div class="ratio ratio-16x9">
                                <img src="https://horacampinas.com.br/wp-content/uploads/2021/12/89f2d813-6682-4032-82ce-d2fa427bb08b.jpg" class="rounded-5 shadow-sm d-block w-100 object-fit-cover" alt="...">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows mb-5">
            <div class="position-relative w-100 h-100 mx-0 px-5
            ">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-categories" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-categories" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-categories" class="d-flex flex-row gap-3">
                    <div class="d-flex gap-5">
                        <a href="#scroll-1" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-music-note"></i></div>
                            <div class="category-label">Música</div>
                        </a>
                        <a href="#scroll-2" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-bicycle"></i></div>
                            <div class="category-label">Esportes</div>
                        </a>
                        <a href="#scroll-3" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-film"></i></div>
                            <div class="category-label">Teatro</div>
                        </a>
                        <a href="#scroll-4" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-book"></i></div>
                            <div class="category-label">Palestras</div>
                        </a>
                        <a href="#scroll-5" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-laptop"></i></div>
                            <div class="category-label">Tecnologia</div>
                        </a>
                        <a href="#scroll-6" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-joystick"></i></div>
                            <div class="category-label">Crianças</div>
                        </a>
                        <a href="#scroll-7" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-palette"></i></div>
                            <div class="category-label">Arte & Exposições</div>
                        </a>
                        <a href="#scroll-8" class="category-item text-primary-emphasis text-decoration-none">
                            <div class="category-circle"><i class="bi bi-egg-fried"></i></div>
                            <div class="category-label">Gastronomia</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Músicais</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-1" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-1" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-1" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Esportes</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-2" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-2" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-2" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Teatro</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-3" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-3" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-3" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Palestras</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-4" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-4" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-4" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Tecnologia</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-5" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-5" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-5" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Crianças</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-6" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-6" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-6" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Arte & Exposições</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-7" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-7" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-7" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column shows my-5">
            <div class="row mb-3 px-4">
                <h3>Gastronomia</h3>
            </div>
            <div class="position-relative w-100 h-100 mx-0 px-4">
                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-8" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y z-1 shadow rounded-circle" data-scroll="#scroll-8" style="display: none;"><i class="bi bi-chevron-right"></i></button>
                <div id="scroll-8" class="d-flex flex-row gap-3">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="col-3">
                            <?php include 'estrutura/card/card.php' ?>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    $(function() {
        const alt = $('#alert-mensagem').parent();

        if (alt.length) {
            alt.show();
            alt.delay(1500).fadeOut(1500, function() {
                alt.remove();
            });
        }

        const btns = $('button[data-scroll]');
        btns.on('click', function() {
            const direction = $(this).find('i').hasClass('bi-chevron-right') ? 1 : -1;
            const toScroll = $($(this).data('scroll'));
            toScroll.animate({
                scrollLeft: toScroll.scrollLeft() + (direction * toScroll.width() / 3)
            }, 200);
        });

        btns.each(function() {
            let area = $(this).parents('.shows');
            area.on('mouseenter', function() {
                $(this).find('button').show();
            }).on('mouseleave', function() {
                $(this).find('button').hide();
            });
        })
        
        // clicking a category should scroll to its parent .shows block (not the inner .d-flex)
        $('#scroll-categories').on('click', 'a.category-item', function(e) {
            e.preventDefault();
            const $link = $(this);
            const href = $link.attr('href') || $link.data('target');
            if (!href) return;

            // find the element referenced by the href (carousel inner d-flex)
            let $target = $(href);
            if (!$target.length) {
                const idName = String(href).replace(/^#/, '');
                $target = $('#' + idName);
            }
            if (!$target.length) return;

            // find the nearest .shows parent that contains the target
            let $shows = $target.closest('.shows');
            if (!$shows.length) $shows = $('.shows').has($target).first();
            if (!$shows.length) return;

            const $nav = $('nav, .navbar').first();
            const navH = $nav.length ? $nav.outerHeight() : 60;
            const offsetTop = Math.max(0, $shows.offset().top - navH - 10);

            $('html, body').animate({ scrollTop: offsetTop }, 450);

            // optional: mark active
            $('#scroll-categories a.category-item').removeClass('active');
            $link.addClass('active');
        });
    });
</script>

</html>