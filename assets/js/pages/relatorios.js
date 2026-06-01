document.addEventListener("DOMContentLoaded", () => {
    ChartsComponent.lineChart("#movement-chart-root");
    ChartsComponent.donutChart("#capital-chart-root");

    document.querySelector("[data-report-models]").textContent = "0";
    document.querySelector("[data-report-volume]").textContent = "0";
    document.querySelector("[data-report-ticket]").textContent = SageUtils.currency(0);
});
