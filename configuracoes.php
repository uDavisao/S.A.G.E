<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>S.A.G.E. | Configurações</title>
<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/layout.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/pages.css">
</head>
<body data-page="configuracoes" data-crumb="CONFIGURAÇÕES">
    <div id="sidebar-root"></div>

    <main class="sage-app">
        <div id="topbar-root"></div>

        <section class="sage-content sage-content-center page-enter">
            <div class="sage-page-title">
    <h1>Configurações do Sistema</h1>
    <p>Gerencie todos os aspectos do S.A.G.E. em um só lugar.</p>
</div>

<div class="settings-grid">
    <article class="sage-panel">
        <header class="sage-panel-header">
            <div class="panel-title">
                <span class="panel-icon panel-icon-orange" data-icon="sun"></span>
                <div>
                    <h2>Aparência</h2>
                    <p>Escolha o tema do sistema.</p>
                </div>
            </div>
        </header>

        <div class="theme-grid">
            <button class="theme-card" data-theme-option="light" type="button">
                <span class="theme-preview theme-preview-light"></span>
                <strong>Tema Claro</strong>
                <small>Cores claras e alto contraste. Ideal para uso diurno.</small>
            </button>

            <button class="theme-card" data-theme-option="dark" type="button">
                <span class="theme-preview theme-preview-dark"></span>
                <strong>Tema Escuro</strong>
                <small>Tons escuros para maior conforto visual.</small>
            </button>
        </div>
    </article>

    <article class="sage-panel">
        <header class="sage-panel-header">
            <div class="panel-title">
                <span class="panel-icon panel-icon-green" data-icon="cloud"></span>
                <div>
                    <h2>Backup Automático</h2>
                    <p>Sua nuvem segura de dados.</p>
                </div>
            </div>
        </header>

        <form class="settings-form" action="/settings/backup" method="post" data-sage-form="backup" novalidate>
            <div class="switch-row">
                <span>
                    <strong>Habilitar Backup na Nuvem</strong>
                    <small>Configuração será salva pelo back-end.</small>
                </span>

                <label class="switch">
                    <input name="backup_enabled" type="checkbox">
                    <span></span>
                </label>
            </div>

            <label class="sage-field">
                <span>Frequência do Backup</span>
                <select name="backup_frequency">
                    <option value="">Selecione uma frequência</option>
                    <option value="daily">Diariamente</option>
                    <option value="weekly">Semanalmente</option>
                    <option value="monthly">Mensalmente</option>
                </select>
            </label>

            <button class="sage-btn sage-btn-success" type="submit">
                <span data-icon="save"></span>
                Salvar Backup
            </button>
            <div class="sage-feedback" data-form-feedback></div>
        </form>
    </article>
</div>

<article class="sage-panel mb-4">
    <header class="sage-panel-header">
        <div class="panel-title">
            <span class="panel-icon panel-icon-orange" data-icon="building"></span>
            <div>
                <h2>Dados da Empresa</h2>
                <p>Informações que aparecerão em relatórios e documentos.</p>
            </div>
        </div>
    </header>

    <form class="company-form" action="/settings/company" method="post" data-sage-form="company" novalidate>
        <label class="sage-field">
            <span>Nome da Oficina / Razão Social</span>
            <input name="company_name" type="text" placeholder="Digite o nome da empresa">
        </label>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="sage-field">
                    <span>CNPJ / CPF</span>
                    <input name="company_document" type="text" placeholder="Digite o CNPJ ou CPF">
                </label>
            </div>

            <div class="col-md-6">
                <label class="sage-field">
                    <span>Telefone de Contato</span>
                    <input name="company_phone" type="text" placeholder="Digite o telefone">
                </label>
            </div>
        </div>

        <label class="sage-field">
            <span>Endereço Completo</span>
            <input name="company_address" type="text" placeholder="Digite o endereço completo">
        </label>

        <div class="d-flex justify-content-end mt-3">
            <button class="sage-btn sage-btn-primary" type="submit">
                <span data-icon="save"></span>
                Salvar Alterações
            </button>
        </div>

        <div class="sage-feedback" data-form-feedback></div>
    </form>
</article>

<article class="sage-panel">
    <header class="sage-panel-header sage-panel-header-between">
        <div class="panel-title">
            <span class="panel-icon panel-icon-purple" data-icon="users"></span>
            <div>
                <h2>Equipe</h2>
                <p>Gerencie os acessos ao S.A.G.E.</p>
            </div>
        </div>

        <button class="sage-btn sage-btn-primary" type="button" data-modal-open="#teamModal">
            + Novo Membro
        </button>
    </header>

    <div class="table-responsive">
        <table class="sage-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cargo / Função</th>
                    <th>Contato</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody data-team-table></tbody>
        </table>
    </div>
</article>

<div class="sage-modal-layer" id="teamModal" aria-hidden="true">
    <div class="sage-modal-backdrop" data-modal-close></div>

    <form class="sage-modal-dialog" action="/team" method="post" data-sage-form="team" novalidate>
        <header class="sage-modal-header">
            <div class="panel-title">
                <span class="panel-icon panel-icon-purple" data-icon="users"></span>
                <div>
                    <h2>Novo Membro</h2>
                    <p>Cadastre um usuário da equipe.</p>
                </div>
            </div>

            <button class="sage-modal-close" type="button" data-modal-close aria-label="Fechar">×</button>
        </header>

        <div class="sage-modal-body">
            <label class="sage-field">
                <span>Nome</span>
                <input name="name" type="text" placeholder="Digite o nome" required>
                <small class="sage-field-error">Informe o nome.</small>
            </label>

            <label class="sage-field">
                <span>Cargo / Função</span>
                <input name="role" type="text" placeholder="Digite o cargo ou função" required>
                <small class="sage-field-error">Informe o cargo.</small>
            </label>

            <label class="sage-field">
                <span>Contato</span>
                <input name="contact" type="email" placeholder="Digite o e-mail de contato" required>
                <small class="sage-field-error">Informe o contato.</small>
            </label>

            <label class="sage-field">
                <span>Status</span>
                <select name="status">
                    <option value="">Selecione o status</option>
                    <option value="active">Ativo</option>
                    <option value="inactive">Inativo</option>
                </select>
            </label>

            <div class="sage-feedback" data-form-feedback></div>
        </div>

        <footer class="sage-modal-footer">
            <button type="button" class="sage-btn sage-btn-ghost" data-modal-close>Cancelar</button>
            <button type="submit" class="sage-btn sage-btn-primary">
                <span data-icon="save"></span>
                Salvar Membro
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
<script src="assets/js/pages/configuracoes.js"></script>
</body>
</html>
