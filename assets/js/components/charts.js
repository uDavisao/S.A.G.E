const ChartsComponent = {
    lineChart(rootSelector) {
        const root = document.querySelector(rootSelector);
        if (!root) return;

        root.innerHTML = `
            <div class="chart-frame">
                <svg class="line-chart" viewBox="0 0 640 280" preserveAspectRatio="none" aria-label="Gráfico de fluxo de movimentações">
                    <line x1="44" y1="230" x2="600" y2="230" class="chart-axis"/>
                    <line x1="44" y1="40" x2="44" y2="230" class="chart-axis"/>
                    <path class="chart-line chart-line-entry" d="M44 230 C120 230, 200 230, 280 230 S460 230, 600 230"/>
                    <path class="chart-line chart-line-exit" d="M44 230 C120 230, 200 230, 280 230 S460 230, 600 230"/>
                </svg>
            </div>
            <div class="chart-legend">
                <span><i class="dot dot-green"></i> Entradas</span>
                <span><i class="dot dot-orange"></i> Saídas</span>
            </div>
        `;
    },

    donutChart(rootSelector) {
        const root = document.querySelector(rootSelector);
        if (!root) return;

        root.innerHTML = `
            <div class="donut-area">
                <div class="donut-chart">
                    <span>0%</span>
                </div>
            </div>

            <div class="chart-legend">
                <span><i class="dot dot-orange"></i> Óleos e Fluidos</span>
                <span><i class="dot dot-blue"></i> Injeção Elétrica</span>
                <span><i class="dot dot-green"></i> Elétrica</span>
                <span><i class="dot dot-yellow"></i> Freios</span>
                <span><i class="dot dot-purple"></i> Filtros</span>
            </div>
        `;
    }
};
