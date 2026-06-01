<?php

include("conexao.php");

// ENTRADA
if(isset($_POST['tipo']) && $_POST['tipo'] == 'ENTRADA'){

    $produto_id = $_POST['part_id'];
    $quantidade = $_POST['quantity'];
    $motivo = $_POST['reason'];

    mysqli_query(
        $conexao,
        "INSERT INTO movimentacoes
        (produto_id, tipo, quantidade, observacao)
        VALUES
        ('$produto_id', 'ENTRADA', '$quantidade', '$motivo')"
    );

    mysqli_query(
        $conexao,
        "UPDATE produtos
        SET quantidade = quantidade + $quantidade
        WHERE id = $produto_id"
    );
}

// SAÍDA
if(isset($_POST['tipo']) && $_POST['tipo'] == 'SAIDA'){

    $produto_id = $_POST['part_id'];
    $quantidade = $_POST['quantity'];
    $motivo = $_POST['reason'];

    mysqli_query(
        $conexao,
        "UPDATE produtos
        SET quantidade = quantidade - $quantidade
        WHERE id = $produto_id"
    );

    mysqli_query(
        $conexao,
        "INSERT INTO movimentacoes
        (produto_id, tipo, quantidade, observacao)
        VALUES
        ('$produto_id', 'SAIDA', '$quantidade', '$motivo')"
    );
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>S.A.G.E. | Movimentações</title>

<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/layout.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/pages.css">

</head>

<body data-page="movimentacoes" data-crumb="MOVIMENTAÇÕES">

<div id="sidebar-root"></div>

<main class="sage-app">

<div id="topbar-root"></div>

<section class="sage-content sage-content-center page-enter">

<div class="sage-page-title sage-page-title-row">

<div>
<h1>Movimentações</h1>
<p>Registre entradas e saídas de peças no estoque.</p>
</div>

<div class="d-flex gap-2 flex-wrap">

<button class="sage-btn sage-btn-success-soft"
type="button"
data-modal-open="#entryModal">

↙ Nova Entrada

</button>

<button class="sage-btn sage-btn-danger-soft"
type="button"
data-modal-open="#exitModal">

↗ Nova Saída

</button>

</div>

</div>

<article class="sage-panel">

<div class="sage-toolbar">

<label class="sage-search">

<span data-icon="search"></span>

<input
type="search"
placeholder="Buscar movimentações...">

</label>

</div>

<div class="table-responsive">

<table class="sage-table">

<thead>

<tr>
<th>Data</th>
<th>Tipo</th>
<th>Produto</th>
<th>Quantidade</th>
<th>Motivo</th>
</tr>

</thead>

<tbody>

<?php

$sql = "
SELECT
m.*,
p.nome
FROM movimentacoes m
INNER JOIN produtos p
ON m.produto_id = p.id
ORDER BY m.id DESC
";

$resultado = mysqli_query($conexao, $sql);

while($mov = mysqli_fetch_assoc($resultado)){

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

<td>
<?php echo $mov['observacao']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</article>

<!-- MODAL ENTRADA -->

<div class="sage-modal-layer"
id="entryModal"
aria-hidden="true">

<div class="sage-modal-backdrop"
data-modal-close></div>

<form class="sage-modal-dialog"
method="POST">

<input
type="hidden"
name="tipo"
value="ENTRADA">

<header class="sage-modal-header">

<h2>Nova Entrada</h2>

</header>

<div class="sage-modal-body">

<label>

Produto

<select name="part_id" required>

<option value="">
Selecione
</option>

<?php

$produtos = mysqli_query(
$conexao,
"SELECT * FROM produtos ORDER BY nome"
);

while($produto = mysqli_fetch_assoc($produtos)){
?>

<option value="<?php echo $produto['id']; ?>">
<?php echo $produto['nome']; ?>
</option>

<?php } ?>

</select>

</label>

<br><br>

<label>

Quantidade

<input
type="number"
name="quantity"
min="1"
required>

</label>

<br><br>

<label>

Motivo

<input
type="text"
name="reason"
required>

</label>

</div>

<footer class="sage-modal-footer">

<button
type="submit"
class="sage-btn sage-btn-primary">

Salvar Entrada

</button>

</footer>

</form>

</div>

<!-- MODAL SAÍDA -->

<div class="sage-modal-layer"
id="exitModal"
aria-hidden="true">

<div class="sage-modal-backdrop"
data-modal-close></div>

<form class="sage-modal-dialog"
method="POST">

<input
type="hidden"
name="tipo"
value="SAIDA">

<header class="sage-modal-header">

<h2>Nova Saída</h2>

</header>

<div class="sage-modal-body">

<label>

Produto

<select name="part_id" required>

<option value="">
Selecione
</option>

<?php

$produtos = mysqli_query(
$conexao,
"SELECT * FROM produtos ORDER BY nome"
);

while($produto = mysqli_fetch_assoc($produtos)){
?>

<option value="<?php echo $produto['id']; ?>">
<?php echo $produto['nome']; ?>
</option>

<?php } ?>

</select>

</label>

<br><br>

<label>

Quantidade

<input
type="number"
name="quantity"
min="1"
required>

</label>

<br><br>

<label>

Motivo

<input
type="text"
name="reason"
required>

</label>

</div>

<footer class="sage-modal-footer">

<button
type="submit"
class="sage-btn sage-btn-primary">

Salvar Saída

</button>

</footer>

</form>

</div>

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