<?php
include("lib/conexao.php");
include("lib/sendArchive.php");
include('lib/protect.php');
protect(1);

if (isset($_POST['send'])) {
    $title = $mysqli->escape_string($_POST['titulo']);
    $short_description = $mysqli->escape_string($_POST['descricao_curta']);
    $price = $mysqli->escape_string($_POST['preco']);
    $content = $mysqli->escape_string($_POST['conteudo']);

    $error = array();
    if (empty($title))
        $error[] = "Fill the title";
    if (empty($short_description))
        $error[] = "Fill the description";
    if (empty($price))
        $error[] = "Fill the price";
    if (empty($content))
        $error[] = "Fill the content";

    if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0)
        $error[] = "Select an image for the content";

    if (count($error) == 0) {
        $works = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
        if ($works !== false) {
            $sql_code = "INSERT INTO cursos (titulo, descricao_curta, conteudo, data_cadastro, preco, imagem) VALUES (
                '$title', '$short_description', '$content', NOW(), '$price', '$works'
            )";
            $insert = $mysqli->query($sql_code);
            if (!$insert)
                $error[] = "Failed to insert on Database:   " . $mysqli->error;
            else
                die("<script>location.href=\"index.php?p=manage_courses\";</script>");
        } else {
            $error[] = "Failed to send image";
        }

    }

    //var_dump($_FILES);
}

?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-page bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Register Courses</h4>
                    <span>Fill the informations and click to save</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="index.php?=manage_courses">
                            Manage Courses
                        </a>
                    </li>
                    <li class="breadcrumb-item">Register Courses</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($error) && count($error) > 0) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($error as $e) {
                        echo "<p>$e</p>";
                    } ?>
                </div>
                <?php
            } ?>
            <div class="card">
                <div class="card-header">
                    <h5>Register Form</h5>
                </div>
                <div class="card-block">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <input type="text" class="form-control" name="descricao_curta" id="descricao_curta">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="imagem" id="imagem">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" name="preco" id="preco">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea class="form-control" name="conteudo" id="conteudo" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a type="button" href="index.php?p=manage_courses" class="btn btn-primary btn-round"><i
                                        class="ti-arrow-left">
                                        Back</i></a>
                                <button type="submit" name="send" value="1"
                                    class="btn btn-success btn-round float-right"><i class="ti-save">
                                        Save</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>