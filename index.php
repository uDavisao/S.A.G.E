<?php
include("conexao.php");

// Total de peças cadastradas
$totalProdutos = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT COUNT(*) AS total FROM produtos"
    )
);

// Estoque baixo
$estoqueBaixo = mysqli_fetch_assoc(
    mysqli_query(
        $conexao,
        "SELECT COUNT(*) AS total
         FROM produtos
         WHERE quantidade <= quantidade_minima"
    )
);

// Valor total em estoque
$valorEstoque = mysqli_fetch_assoc(
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
<title>S.A.G.E. | Visão Geral</title>

<link rel="stylesheet" href="/oficina/assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="/oficina/assets/css/base.css">
<link rel="stylesheet" href="/oficina/assets/css/layout.css">
<link rel="stylesheet" href="/oficina/assets/css/components.css">
<link rel="stylesheet" href="/oficina/assets/css/pages.css">
</head>

<body data-page="dashboard" data-crumb="VISÃO GERAL">

<div id="sidebar-root"></div>

<main class="sage-app">

    <div id="topbar-root"></div>

    <section class="sage-content sage-content-center page-enter">

        <div class="sage-page-title">
            <h1>Visão Geral do Estoque</h1>
            <p>Indicadores de desempenho e alertas de estoque da oficina.</p>
        </div>

        <div class="metrics-grid">

            <!-- Total de peças -->
            <article class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon metric-icon-blue" data-icon="box"></span>
                    <span class="trend-green">↗</span>
                </div>

                <p>Total de Peças Cadastradas</p>

                <strong>
                    <?php echo $totalProdutos['total']; ?>
                </strong>
            </article>

            <!-- Estoque baixo -->
            <article class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon metric-icon-orange" data-icon="alert"></span>
                    <span class="trend-danger">↗</span>
                </div>

                <p>Estoque Baixo</p>

                <strong>
                    <?php echo $estoqueBaixo['total']; ?>
                    <small> requer reposição</small>
                </strong>
            </article>

            <!-- Valor total -->
            <article class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon metric-icon-green" data-icon="dollar"></span>
                    <span class="trend-green">↗</span>
                </div>

                <p>Valor Total em Estoque</p>

                <strong>
                    R$
                    <?php
                    echo number_format(
                        $valorEstoque['total'] ?? 0,
                        2,
                        ',',
                        '.'
                    );
                    ?>
                </strong>
            </article>

            <!-- Movimentações -->
            <article class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon metric-icon-purple" data-icon="activity"></span>
                    <span class="trend-blue">↗</span>
                </div>

                <p>Itens Movimentados Hoje</p>

                <strong>
                    <?php

                    $movHoje = mysqli_fetch_assoc(
                        mysqli_query(
                            $conexao,
                            "SELECT COUNT(*) AS total
                             FROM movimentacoes
                             WHERE DATE(data_movimentacao)=CURDATE()"
                        )
                    );

                    echo $movHoje['total'] ?? 0;
                    ?>

                </strong>
            </article>

        </div>

        <div class="dashboard-grid">

            <!-- Estoque Baixo -->
            <article class="sage-panel">

                <header class="sage-panel-header">

                    <div class="panel-title">

                        <span class="panel-icon panel-icon-orange"
                        data-icon="alert"></span>

                        <div>
                            <h2>Atenção Necessária - Estoque Baixo</h2>
                            <p>Itens que atingiram a quantidade mínima.</p>
                        </div>

                    </div>

                </header>

                <div class="table-responsive">

                    <table class="sage-table">

                        <thead>
                            <tr>
                                <th>Peça</th>
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

            <!-- Últimas movimentações -->
            <article class="sage-panel">

                <header class="sage-panel-header sage-panel-header-soft">

                    <div class="panel-title">

                        <span class="panel-icon panel-icon-blue"
                        data-icon="save"></span>

                        <div>
                            <h2>Últimas Movimentações</h2>
                            <p>Entradas e saídas recentes.</p>
                        </div>

                    </div>

                </header>

                <div class="table-responsive">

                    <table class="sage-table">

                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Qtd.</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php

                        $sqlMov = mysqli_query(
                            $conexao,
                            "SELECT m.*, p.nome
                             FROM movimentacoes m
                             INNER JOIN produtos p
                             ON m.produto_id = p.id
                             ORDER BY m.id DESC
                             LIMIT 10"
                        );

                        while($mov = mysqli_fetch_assoc($sqlMov)){
                        ?>

                            <tr>

                                <td>
                                    <?php echo $mov['nome']; ?>
                                </td>

                                <td>
                                    <?php echo $mov['tipo']; ?>
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