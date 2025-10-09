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
    <?php include 'estrutura/navbar/navbar.php';?>
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
        <div class="d-flex flex-column mb-5">
            <div class="row mb-3 px-4">
                <h3>Eventos músicais</h3>
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
        <div class="d-flex flex-column mb-5">
            <div class="row mb-3 px-4">
                <h3>Eventos </h3>
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
            let area = $(this).parents('.d-flex.flex-column');
            area.on('mouseenter', function() {
                $(this).find('button').show();
            }).on('mouseleave', function() {
                $(this).find('button').hide();
            });
        })
    });
</script>

</html>