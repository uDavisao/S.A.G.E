<?php

include("conexao.php");

$sql = "SELECT * FROM produtos";

$resultado = mysqli_query($conexao, $sql);

?>

<h1>Estoque</h1>

<?php

while($produto = mysqli_fetch_assoc($resultado)){

    echo "<hr>";

    echo "Produto: ".$produto['nome']."<br>";

    echo "Quantidade: ".$produto['quantidade']."<br>";

    echo "Preço: R$ ".$produto['preco']."<br>";
}

?>

```php
<?php
include("conexao.php");

if(isset($_POST['name'])){

    $nome = $_POST['name'];
    $sku = $_POST['sku'];
    $categoria = $_POST['category'];
    $marca = $_POST['brand'];
    $fornecedor = $_POST['supplier'];
    $preco_custo = $_POST['cost_price'];
    $preco_venda = $_POST['unit_price'];
    $quantidade = $_POST['quantity'];
    $quantidade_minima = $_POST['minimum_quantity'];
    $localizacao = $_POST['location'];

    $sql = "INSERT INTO produtos
    (
        nome,
        sku,
        categoria,
        marca,
        fornecedor,
        preco_custo,
        preco_venda,
        quantidade,
        quantidade_minima,
        localizacao
    )

    VALUES
    (
        '$nome',
        '$sku',
        '$categoria',
        '$marca',
        '$fornecedor',
        '$preco_custo',
        '$preco_venda',
        '$quantidade',
        '$quantidade_minima',
        '$localizacao'
    )";

    mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>S.A.G.E. | Estoque & Produtos</title>

<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/layout.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/pages.css">
<link rel="stylesheet" href="assets/css/auth.css">


</head>

<body data-page="estoque" data-crumb="ESTOQUE & PRODUTOS">

    <div id="sidebar-root"></div>

    <main class="sage-app">

        <div id="topbar-root"></div>

        <section class="sage-content sage-content-center page-enter">

            <div class="sage-page-title sage-page-title-row">

                <div>
                    <h1>Estoque de Peças</h1>

                    <p>
                        Cadastre e gerencie os itens disponíveis na sua oficina.
                    </p>
                </div>

                <button class="sage-btn sage-btn-primary"
                type="button"
                data-modal-open="#partModal">

                    + Nova Peça

                </button>

            </div>

            <article class="sage-panel">

                <div class="sage-toolbar">

                    <label class="sage-search">

                        <span data-icon="search"></span>

                        <input
                        type="search"
                        data-empty-search="[data-stock-table]"
                        placeholder="Buscar por código, nome ou categoria...">

                    </label>

                    <span class="toolbar-count">

                        <strong data-catalog-count>
                            0
                        </strong>

                        itens no catálogo

                    </span>

                </div>

                <div class="table-responsive">

                    <table class="sage-table">

                        <thead>

                            <tr>
                                <th>Código (SKU)</th>
                                <th>Nome da Peça</th>
                                <th>Categoria / Marca</th>
                                <th>Estoque</th>
                                <th>Preço (R$)</th>
                                <th>Ações</th>
                            </tr>

                        </thead>

                        <tbody data-stock-table data-colspan="6">

                        <?php

                        $sql = "SELECT * FROM produtos";

                        $resultado = mysqli_query($conexao, $sql);

                        while($produto = mysqli_fetch_assoc($resultado)){

                        ?>

                        <tr>

                            <td>
                                <?php echo $produto['sku']; ?>
                            </td>

                            <td>
                                <?php echo $produto['nome']; ?>
                            </td>

                            <td>

                                <?php echo $produto['categoria']; ?>

                                /

                                <?php echo $produto['marca']; ?>

                            </td>

                            <td>
                                <?php echo $produto['quantidade']; ?>
                            </td>

                            <td>

                                R$

                                <?php
                                echo number_format(
                                    $produto['preco_venda'],
                                    2,
                                    ',',
                                    '.'
                                );
                                ?>

                            </td>

                            <td>

                                <button class="sage-btn sage-btn-ghost">

                                    Editar

                                </button>

                            </td>

                        </tr>

                        <?php
                        }
                        ?>

                        </tbody>

                    </table>

                </div>

            </article>

            <div class="sage-modal-layer"
            id="partModal"
            aria-hidden="true">

                <div class="sage-modal-backdrop"
                data-modal-close></div>

                <form class="sage-modal-dialog modal-lg"
                method="POST"
                novalidate>

                    <header class="sage-modal-header">

                        <div class="panel-title">

                            <span class="panel-icon panel-icon-orange"
                            data-icon="box"></span>

                            <div>

                                <h2>
                                    Cadastrar Nova Peça
                                </h2>

                                <p>
                                    Preencha os dados do novo item.
                                </p>

                            </div>

                        </div>

                        <button class="sage-modal-close"
                        type="button"
                        data-modal-close
                        aria-label="Fechar">

                            ×

                        </button>

                    </header>

                    <div class="sage-modal-body">

                        <h3 class="form-section">
                            Identificação
                        </h3>

                        <label class="sage-field">

                            <span>
                                Nome da Peça *
                            </span>

                            <input
                            name="name"
                            type="text"
                            placeholder="Ex: Pastilha de Freio Dianteira"
                            required>

                        </label>

                        <div class="sage-form-grid-2">

                            <label class="sage-field">

                                <span>
                                    Código (SKU) *
                                </span>

                                <input
                                name="sku"
                                type="text"
                                placeholder="EX: PT-FR-02"
                                required>

                            </label>

                            <label class="sage-field">

                                <span>
                                    Categoria
                                </span>

                                <select name="category">

                                    <option value="">
                                        Outros
                                    </option>

                                    <option value="oleos_fluidos">
                                        Óleos e Fluidos
                                    </option>

                                    <option value="filtros">
                                        Filtros
                                    </option>

                                    <option value="freios">
                                        Freios
                                    </option>

                                    <option value="eletrica">
                                        Elétrica
                                    </option>

                                    <option value="injecao_eletronica">
                                        Injeção Eletrônica
                                    </option>

                                    <option value="outros">
                                        Outros
                                    </option>

                                </select>

                            </label>

                        </div>

                        <label class="sage-field">

                            <span>
                                Marca / Fabricante
                            </span>

                            <input
                            name="brand"
                            type="text"
                            placeholder="Ex: Bosch, NGK, Petronas...">

                        </label>

                        <label class="sage-field">

                            <span>
                                Fornecedor Principal
                            </span>

                            <input
                            name="supplier"
                            type="text"
                            placeholder="Ex: Auto Peças Brasil">

                        </label>

                        <h3 class="form-section form-section-money">
                            Valores
                        </h3>

                        <div class="sage-form-grid-2">

                            <label class="sage-field sage-field-with-prefix">

                                <span>
                                    Custo (R$)
                                </span>

                                <span class="sage-field-prefix">
                                    R$
                                </span>

                                <input
                                name="cost_price"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0,00">

                            </label>

                            <label class="sage-field sage-field-with-prefix">

                                <span>
                                    Preço de Venda (R$) *
                                </span>

                                <span class="sage-field-prefix">
                                    R$
                                </span>

                                <input
                                name="unit_price"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0,00"
                                required>

                            </label>

                        </div>

                        <h3 class="form-section form-section-location">
                            Estoque e Localização
                        </h3>

                        <div class="sage-form-grid-3">

                            <label class="sage-field">

                                <span>
                                    Qtd. Atual *
                                </span>

                                <input
                                name="quantity"
                                type="number"
                                min="0"
                                placeholder="0"
                                required>

                            </label>

                            <label class="sage-field">

                                <span>
                                    Qtd. Mínima
                                </span>

                                <input
                                name="minimum_quantity"
                                type="number"
                                min="0"
                                placeholder="0">

                            </label>

                            <label class="sage-field">

                                <span>
                                    Localização
                                </span>

                                <input
                                name="location"
                                type="text"
                                placeholder="Ex: Prateleira A4">

                            </label>

                        </div>

                    </div>

                    <footer class="sage-modal-footer">

                        <button type="button"
                        class="sage-btn sage-btn-ghost"
                        data-modal-close>

                            Cancelar

                        </button>

                        <button type="submit"
                        class="sage-btn sage-btn-primary">

                            Salvar Peça

                        </button>

                    </footer>

                </form>

            </div>

        </section>

    </main>

<script src="/oficina/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

<script src="/oficina/assets/js/core/utils.js"></script>
<script src="/oficina/assets/js/components/icons.js"></script>
<script src="/oficina/assets/js/components/sidebar.js"></script>
<script src="/oficina/assets/js/components/topbar.js"></script>
<script src="/oficina/assets/js/components/emptyState.js"></script>
<script src="/oficina/assets/js/components/modal.js"></script>
<script src="/oficina/assets/js/core/api.js"></script>
<script src="/oficina/assets/js/core/app.js"></script>

</body>
</html>
```
