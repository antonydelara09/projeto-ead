<?php
include("lib/conexao.php");
include("lib/sendArchive.php");
include('lib/protect.php');
protect(1);

if (isset($_POST['send'])) {
    $name = $mysqli->escape_string($_POST['name']);
    $email = $mysqli->escape_string($_POST['email']);
    $credits = $mysqli->escape_string($_POST['credits']);
    $password = $mysqli->escape_string($_POST['password']);
    $repeat_pwrd = $mysqli->escape_string($_POST['repeat_pwrd']);
    $admin = $mysqli->escape_string($_POST['admin']);

    $error = array();
    if (empty($name))
        $error[] = "Fill the name";
    if (empty($email))
        $error[] = "Fill the email";
    if (empty($credits))
        $credits = 0;
    if (empty($password))
        $error[] = "Fill the password";

    if ($repeat_pwrd != $password) {
        $error[] = "The passwords isn't the same";
    }


    if (count($error) == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO usuarios (nome, email, senha, data_cadastro, creditos, admin) VALUES(
            '$name', '$email', '$password', now(), '$credits', '$admin'
        )");
        die("<script>location.href=\"index.php?p=manage_users\";</script>");
    }

    //var_dump($_FILES);
}

?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-user bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Register Users</h4>
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
                        <a href="index.php?=manage_users">
                            Manage Users
                        </a>
                    </li>
                    <li class="breadcrumb-item">Register Users</li>
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
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Credits</label>
                                    <input type="text" class="form-control" name="credits" id="credits">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Repeat Password</label>
                                    <input type="password" class="form-control" name="repeat_pwrd" id="repeat_pwrd">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">User Type</label>
                                    <select name="admin" id="admin" class="form-control">
                                        <option value="0">User</option>
                                        <option value="1">Adminstrator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a type="button" href="index.php?p=manage_users" class="btn btn-primary btn-round"><i
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