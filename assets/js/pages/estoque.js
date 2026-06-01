document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("[data-catalog-count]").textContent = "0";

    document.querySelector("[data-stock-table]").innerHTML = EmptyStateComponent.row({
        colspan: 6,
        icon: "box",
        title: "Nenhuma peça cadastrada",
        text: "Os dados serão carregados pelo back-end e banco SQL."
    });
});
