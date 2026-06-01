<?php
include("conexao.php");

// Total de produtos
$totalProdutos = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT COUNT(*) AS total FROM produtos"
    )
);

// Volume total em estoque
$volumeTotal = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT SUM(quantidade) AS total FROM produtos"
    )
);

// Ticket médio
$ticketMedio = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT AVG(preco_venda) AS media FROM produtos"
    )
);

// Valor total do estoque
$valorTotal = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT SUM(preco_venda * quantidade) AS total
         FROM produtos"
    )
);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>S.A.G.E. | Relatórios</title>

<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/layout.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/pages.css">
</head>

<body data-page="relatorios" data-crumb="RELATÓRIOS">

<div id="sidebar-root"></div>

<main class="sage-app">

<div id="topbar-root"></div>

<section class="sage-content sage-content-center page-enter">

<div class="sage-page-title">
    <h1>Relatórios Gerenciais</h1>
    <p>Análise financeira e operacional do estoque.</p>
</div>

<div class="summary-grid">

    <div class="summary-card summary-blue">
        <span>Produtos Cadastrados</span>
        <strong>
            <?php echo $totalProdutos['total']; ?>
        </strong>
    </div>

    <div class="summary-card summary-green">
        <span>Volume Total</span>
        <strong>
            <?php echo $volumeTotal['total'] ?? 0; ?>
        </strong>
    </div>

    <div class="summary-card summary-purple">
        <span>Ticket Médio</span>
        <strong>
            R$
            <?php
            echo number_format(
                $ticketMedio['media'] ?? 0,
                2,
                ',',
                '.'
            );
            ?>
        </strong>
    </div>

    <div class="summary-card summary-orange">
        <span>Valor em Estoque</span>
        <strong>
            R$
            <?php
            echo number_format(
                $valorTotal['total'] ?? 0,
                2,
                ',',
                '.'
            );
            ?>
        </strong>
    </div>

</div>

<!-- ESTOQUE BAIXO -->

<article class="sage-panel">

<header class="sage-panel-header">

<div class="panel-title">

<h2>Produtos com Estoque Baixo</h2>

</div>

</header>

<div class="table-responsive">

<table class="sage-table">

<thead>

<tr>
<th>Produto</th>
<th>Atual</th>
<th>Mínimo</th>
</tr>

</thead>

<tbody>

<?php

$sqlBaixo = mysqli_query(
    $conexao,
    "SELECT *
     FROM produtos
     WHERE quantidade <= quantidade_minima"
);

while($produto = mysqli_fetch_assoc($sqlBaixo)){
?>

<tr>

<td>
<?php echo $produto['nome']; ?>
</td>

<td>
<?php echo $produto['quantidade']; ?>
</td>

<td>
<?php echo $produto['quantidade_minima']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</article>

<br>

<!-- PRODUTOS MAIS MOVIMENTADOS -->

<article class="sage-panel">

<header class="sage-panel-header">

<div class="panel-title">

<h2>Produtos Mais Movimentados</h2>

</div>

</header>

<div class="table-responsive">

<table class="sage-table">

<thead>

<tr>
<th>Produto</th>
<th>Total Movimentado</th>
</tr>

</thead>

<tbody>

<?php

$sqlMov = mysqli_query(
$conexao,
"
SELECT
p.nome,
SUM(m.quantidade) AS total_movimentado

FROM movimentacoes m

INNER JOIN produtos p
ON p.id = m.produto_id

GROUP BY p.id

ORDER BY total_movimentado DESC

LIMIT 10
"
);

while($mov = mysqli_fetch_assoc($sqlMov)){
?>

<tr>

<td>
<?php echo $mov['nome']; ?>
</td>

<td>
<?php echo $mov['total_movimentado']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</article>

<br>

<!-- ÚLTIMAS MOVIMENTAÇÕES -->

<article class="sage-panel">

<header class="sage-panel-header">

<div class="panel-title">

<h2>Últimas Movimentações</h2>

</div>

</header>

<div class="table-responsive">

<table class="sage-table">

<thead>

<tr>
<th>Data</th>
<th>Tipo</th>
<th>Produto</th>
<th>Quantidade</th>
</tr>

</thead>

<tbody>

<?php

$sqlUltimas = mysqli_query(
$conexao,
"
SELECT
m.*,
p.nome

FROM movimentacoes m

INNER JOIN produtos p
ON p.id = m.produto_id

ORDER BY m.id DESC

LIMIT 10
"
);

while($mov = mysqli_fetch_assoc($sqlUltimas)){
?>

<tr>

<td>
<?php echo date('d/m/Y', strtotime($mov['data_movimentacao'])); ?>
</td>

<td>
<?php echo $mov['tipo']; ?>
</td>

<td>
<?php echo $mov['nome']; ?>
</td>

<td>
<?php echo $mov['quantidade']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</article>

</section>

</main>

<script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
<script src="assets/js/core/utils.js"></script>
<script src="assets/js/components/icons.js"></script>
<script src="assets/js/components/sidebar.js"></script>
<script src="assets/js/components/topbar.js"></script>
<script src="assets/js/components/emptyState.js"></script>
<script src="assets/js/components/modal.js"></script>
<script src="assets/js/core/api.js"></script>
<script src="assets/js/core/app.js"></script>

</body>
</html>