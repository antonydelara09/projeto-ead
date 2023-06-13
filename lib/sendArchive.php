<?php
function enviarArquivo($error, $size, $name, $tmp_name)
{


    include('conexao.php');

    if ($error)
        die("Falha ao enviar o arquivo");

    if ($size > 2097152)
        die("Arquivo muito grande!! Max: 2MB");

    $pasta = "upload/";
    $nomeArquivo = $name;
    $novoNomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if ($extensao != "jpg" && $extensao != 'png' && $extensao != 'gif')
        die("Tipo de arquivo não aceito");

    $path = $pasta . $novoNomeArquivo . "." . $extensao;
    $pronto = move_uploaded_file($tmp_name, $path);
    if ($pronto)
        return $path;
    else
        return false;

}