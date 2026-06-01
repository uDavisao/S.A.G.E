const TopbarComponent = {
    render(crumb) {
        const root = document.querySelector("#topbar-root");
        if (!root) return;

        root.innerHTML = `
            <header class="sage-topbar">
                <div class="sage-breadcrumb">
                    <span>S.A.G.E.</span>
                    <span>/</span>
                    <strong>${crumb || ""}</strong>
                </div>

                <div class="sage-top-actions">
                    <button class="theme-toggle" type="button" data-theme-toggle aria-label="Alternar tema">
                        <span data-theme-icon>☀</span>
                    </button>

                    <span class="date-pill">
                        ${SageIcons.calendar}
                        <strong data-current-date></strong>
                    </span>
                </div>
            </header>
        `;
    }
};
