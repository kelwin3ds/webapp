<?php
session_start();
include('conexao_db.php');

if (!isset($_SESSION['login'])) {
    $_SESSION['msg_alert'] = ['danger', "Acesso negado!"];
    header('Location: index.php');
    exit;
}

$login = $_SESSION['login'];

// Handle form submission (create event + upload image)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize inputs
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $local = trim($_POST['local'] ?? '');
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $duracao = $_POST['duracao'] ?? '';
    $capacidade = intval($_POST['capacidade'] ?? 0);

    // Basic validation (all fields required)
    if ($nome === '' || $descricao === '' || $local === '' || $data === '' || $hora === '' || $duracao === '' || $capacidade <= 0) {
        $_SESSION['msg_alert'] = ['danger', 'Preencha todos os campos corretamente.'];
        header('Location: criar-evento.php');
        exit;
    }

    // Require image upload
    if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['msg_alert'] = ['danger', 'Adicione uma imagem para o evento.'];
        header('Location: criar-evento.php');
        exit;
    }

    // Prepare upload directory
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Default image path (empty string allowed if your DB accepts it)
    $imagePath = '';

    // Handle image upload
    $file = $_FILES['imagem'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        // continue
    } else {
        $_SESSION['msg_alert'] = ['danger', 'Erro no upload da imagem.'];
        header('Location: criar-evento.php');
        exit;
    }
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed)) {
        $_SESSION['msg_alert'] = ['danger', 'Formato de imagem não suportado. Use JPG/PNG/GIF/WebP.'];
        header('Location: criar-evento.php');
        exit;
    }
    // Limit to 5MB
    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['msg_alert'] = ['danger', 'Imagem muito grande. Máx 5MB.'];
        header('Location: criar-evento.php');
        exit;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('evt_', true) . '.' . $ext;
    $target = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        $imagePath = $target; // save relative path to DB
    } else {
        $_SESSION['msg_alert'] = ['danger', 'Erro ao mover a imagem.'];
        header('Location: criar-evento.php');
        exit;
    }

    // Insert into eventos table using prepared statement
    $stmt = mysqli_prepare($conexao, "INSERT INTO eventos (nome, descricao, `local`, `data`, `hora`, duracao, capacidade, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        $_SESSION['msg_alert'] = ['danger', 'Erro no banco: ' . mysqli_error($conexao)];
        header('Location: criar-evento.php');
        exit;
    }

    // types: s - string, i - integer; order: nome, descricao, local, data, hora, duracao, capacidade, imagem
    mysqli_stmt_bind_param($stmt, 'ssssssis', $nome, $descricao, $local, $data, $hora, $duracao, $capacidade, $imagePath);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        $_SESSION['msg_alert'] = ['success', 'Evento criado com sucesso.'];
        header('Location: homepage.php');
        exit;
    } else {
        $err = mysqli_error($conexao);
        mysqli_stmt_close($stmt);
        $_SESSION['msg_alert'] = ['danger', 'Erro ao salvar evento: ' . $err];
        header('Location: criar-evento.php');
        exit;
    }
}

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
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

        /* Placeholder overlay in the image area */
        .image-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            /* allow clicks to pass through to container */
            color: rgba(0, 0, 0, 0.6);
        }

        /* hide buttons initially */
        #imageButtons {
            display: none !important;
        }
    </style>
</head>

<body>
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
    <div class="container py-4 d-flex justify-content-center align-items-center">
        <div class="card border-0 p-2 shadow" style="min-width: 50%;">
            <form method="post" enctype="multipart/form-data">
                <div class="card-header border-0 bg-transparent d-flex justify-content-between">
                    <h5 class="mb-0 fw-semibold my-1">Criar Evento</h5>
                    <a href="homepage.php" class="btn border"><i class="bi bi-x-lg"></i></a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="evento" class="form-label small fw-semibold">Nome do Evento</label>
                        <input type="text" class="form-control border-0 bg-body-tertiary" id="evento" name="nome" placeholder="Insira o nome" required>
                    </div>
                    <div class="mb-4 d-flex gap-3">
                        <div class="col">
                            <label for="data" class="form-label small fw-semibold">Data</label>
                            <input type="date" class="form-control border-0 bg-body-tertiary" id="data" name="data" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col">
                            <label for="hora" class="form-label small fw-semibold">Horário</label>
                            <input type="time" class="form-control border-0 bg-body-tertiary" id="hora" name="hora" placeholder="12:00" required>
                        </div>
                        <div class="col">
                            <label for="duracao" class="form-label small fw-semibold">Duração</label>
                            <input type="time" class="form-control border-0 bg-body-tertiary" id="duracao" name="duracao" placeholder="05:00" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="form-label small fw-semibold">Descrição</label>
                        <textarea class="form-control border-0 bg-body-tertiary overflow-y-auto" placeholder="Insira a descrição" id="descricao" name="descricao" rows="3" maxlength="1000" style="max-height: calc(1.5em * 3 + 1rem);" required></textarea>
                    </div>
                    <div class="mb-4 d-flex gap-3">
                        <div class="col">
                            <label for="local" class="form-label small fw-semibold">Localização</label>
                            <input type="text" class="form-control border-0 bg-body-tertiary" id="local" name="local" placeholder="Insira a localização" required>
                        </div>
                        <div class="col-3">
                            <label for="capacidade" class="form-label small fw-semibold">Capacidade</label>
                            <input type="number" min="1" class="form-control border-0 bg-body-tertiary" id="capacidade" name="capacidade" placeholder="1" required>
                        </div>
                    </div>
                    <p class="form-label small fw-semibold">Imagem</p>
                    <div class="ratio ratio-16x9 bg-body-tertiary p-3 rounded-2 position-relative" id="imageArea" style="cursor:pointer;">
                        <!-- overlay buttons (hidden until image chosen) -->
                        <div class="d-flex position-absolute z-3 h-auto justify-content-end end-0 gap-2 p-2" id="imageButtons">
                            <button type="button" id="btnTrocar" class="btn btn-sm rounded-circle border bg-transparent text-white" title="Trocar imagem"><i class="bi bi-arrow-down-up"></i></button>
                            <button type="button" id="btnRemover" class="btn btn-sm rounded-circle border bg-transparent text-white" title="Remover imagem"><i class="bi bi-trash3"></i></button>
                        </div>

                        <!-- image preview (hidden by default) -->
                        <img id="previewImagem" src="" class="img-fluid rounded-2 d-none">

                        <!-- centered placeholder when no image selected -->
                        <div id="placeholder" class="image-placeholder text-center">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                <i class="bi bi-image" style="font-size:40px;opacity:0.7"></i>
                                <div class="small mt-2">Clique para adicionar imagem<br />(JPG/PNG)</div>
                            </div>
                        </div>

                        <!-- file input covers the whole area but is invisible so user clicks open the picker reliably -->
                        <input type="file" name="imagem" id="imagem" accept="image/*" required style="position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;z-index:3;border:0;padding:0;margin:0;">
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent mt-3 d-flex flex-row-reverse gap-3">
                    <button type="submit" class="btn btn-primary">Criar evento</button>
                    <a href="homepage.php" class="btn border">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
    $(function() {
        var $fileInput = $('#imagem');
        var $preview = $('#previewImagem');
        var $placeholder = $('#placeholder');
        var $imageArea = $('#imageArea');
        var $imageButtons = $('#imageButtons');
        var $btnTrocar = $('#btnTrocar');
        var $btnRemover = $('#btnRemover');

        if (!$fileInput.length) return;

        function setNoImage() {
            $placeholder.show();
            $imageButtons.hide();
            $preview.addClass('d-none').attr('src', '');
        }

        // initial state: no preview
        setNoImage();

        // Clicking the whole image area triggers file select (unless clicked on buttons)
        $imageArea.on('click', function(e) {
            if ($(e.target).closest('#imageButtons').length) return;
            $fileInput.trigger('click');
        });

        // Change button triggers file select
        $btnTrocar.on('click', function(e) {
            e.stopPropagation();
            $fileInput.trigger('click');
        });

        // Remove button clears selection and resets preview
        $btnRemover.on('click', function(e) {
            e.stopPropagation();
            $fileInput.val('');
            setNoImage();
        });

        // When a file is chosen
        $fileInput.on('change', function() {
            var file = this.files && this.files[0];
            if (file) {
                var url = URL.createObjectURL(file);
                $preview.removeClass('d-none').attr('src', url).on('load', function() {
                    URL.revokeObjectURL(url);
                });
                $placeholder.hide();
                // ensure buttons show as flex to respect layout
                $imageButtons.css('display', 'flex');
            } else {
                setNoImage();
            }
        });
    });
</script>

</html>