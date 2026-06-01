document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("[data-total-parts]").textContent = "0";
    document.querySelector("[data-low-stock]").textContent = "0";
    document.querySelector("[data-total-value]").textContent = SageUtils.currency(0);
    document.querySelector("[data-today-moves]").textContent = "0";

    document.querySelector("[data-low-stock-table]").innerHTML = EmptyStateComponent.row({
        colspan: 3,
        icon: "activity",
        title: "Nenhum item em atenção",
        text: "O back-end carregará os produtos com estoque baixo."
    });

    document.querySelector("[data-os-table]").innerHTML = EmptyStateComponent.row({
        colspan: 3,
        icon: "save",
        title: "Nenhuma ordem de serviço",
        text: "O back-end carregará as últimas utilizações."
    });
});
