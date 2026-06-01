document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("[data-team-table]").innerHTML = EmptyStateComponent.row({
        colspan: 5,
        icon: "users",
        title: "Nenhum membro cadastrado",
        text: "A equipe será carregada pelo back-end."
    });
});
