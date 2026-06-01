document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("[data-movements-table]").innerHTML = EmptyStateComponent.row({
        colspan: 5,
        icon: "arrows",
        title: "Nenhuma movimentação cadastrada",
        text: "Entradas e saídas serão carregadas pelo back-end."
    });

    document.querySelectorAll("[data-part-select]").forEach((select) => {
        select.innerHTML = '<option value="">Escolha uma peça do inventário...</option>';
    });
});
