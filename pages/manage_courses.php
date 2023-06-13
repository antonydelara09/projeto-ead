<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(1);

$sql_cursos = "SELECT * FROM cursos";
$sql_query = $mysqli->query($sql_cursos) or die($mysqli->error);
$num_cursos = $sql_query->num_rows;


?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-computer bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Manage courses</h4>
                    <span>Administrate the courses registered in the system</span>
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
                    <li class="breadcrumb-item"><a href="#!">Manage courses</a>
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
                    <h5>All the Courses</h5>
                    <span><a href="index.php?p=register_courses">Click here</a> to register course</span>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($num_cursos == 0) { ?>
                                    <tr>
                                        <td colspan="5">No courses have been registered.</td>
                                    </tr>
                                <?php } else {
                                    while ($curso = $sql_query->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $curso['id']; ?>
                                            </th>
                                            <td>
                                                <img src="<?php echo $curso['imagem']; ?>" alt="" height="50">
                                            </td>
                                            <td>
                                                <?php echo $curso['titulo']; ?>
                                            </td>
                                            <td>
                                                US$
                                                <?php echo number_format($curso['preco'], 2, '.', ','); ?>
                                            </td>
                                            <td>
                                                <a href="index.php?p=edit_courses&id=<?php echo $curso['id']; ?>">Editar</a> |
                                                <a href="index.php?p=delete_courses&id=<?php echo $curso['id']; ?>">Deletar</a>
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