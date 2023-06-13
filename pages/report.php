<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(1);

$sql_reports = "SELECT r.id, u.nome, c.titulo, r.data_compra, r.valor FROM relatorio r, usuarios u, cursos c 
                    WHERE u.id = r.id_usuario AND c.id = r.id_curso";
$sql_query = $mysqli->query($sql_reports) or die($mysqli->error);
$num_reports = $sql_query->num_rows;

?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-page bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Reports</h4>
                    <span>View user spends within the system</span>
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
                    <li class="breadcrumb-item"><a href="#!">Report</a>
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
                    <h5>Report</h5>
                    <span>Scan the system purchases report</span>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Course</th>
                                    <th>Date</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($num_reports == 0) { ?>
                                    <tr>
                                        <td colspan="5">No report was found.</td>
                                    </tr>
                                <?php } else {
                                    while ($report = $sql_query->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $report['id']; ?>
                                            </th>
                                            <td>
                                                <?php echo $report['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $report['titulo']; ?>
                                            </td>
                                            <td>
                                                <?php echo date("d/m/Y H:i", strtotime($report['data_compra'])); ?>
                                            </td>
                                            <td>
                                                US$
                                                <?php echo number_format($report['valor'], 2, '.', ','); ?>
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