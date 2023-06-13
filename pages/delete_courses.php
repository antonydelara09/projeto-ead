<?php

include("lib/conexao.php");
include('lib/protect.php');
protect(1);
$id = intval($_GET['id']);

$mysql_query = $mysqli->query("SELECT imagem FROM cursos WHERE id = '$id'") or die($mysqli->error);
$course = $mysql_query->fetch_assoc();

if (unlink($course['imagem'])) {
    $mysqli->query("DELETE FROM cursos WHERE id = '$id'") or die($mysqli->error);
}

die("<script>location.href=\"index.php?p=manage_courses\";</script>");