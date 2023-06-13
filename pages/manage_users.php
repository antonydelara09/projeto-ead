<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(1);

$sql_users = "SELECT * FROM usuarios";
$sql_query = $mysqli->query($sql_users) or die($mysqli->error);
$num_users = $sql_query->num_rows;

?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-user bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Manage users</h4>
                    <span>Administrate the users registered in the system</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Manage users</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>All the users</h5>
                    <span><a href="index.php?p=register_users">Click here</a> to register user</span>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Credits</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($num_users == 0) { ?>
                                    <tr>
                                        <td colspan="5">No users have been registered.</td>
                                    </tr>
                                <?php } else {
                                    while ($user = $sql_query->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $user['id']; ?>
                                            </th>
                                            <td>
                                                <?php echo $user['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['email']; ?>
                                            </td>
                                            <td>
                                                US$
                                                <?php echo number_format($user['creditos'], 2, '.', ','); ?>
                                            </td>
                                            <td>
                                                <a href="index.php?p=edit_users&id=<?php echo $user['id']; ?>">Editar</a> |
                                                <a href="index.php?p=delete_users&id=<?php echo $user['id']; ?>">Deletar</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>