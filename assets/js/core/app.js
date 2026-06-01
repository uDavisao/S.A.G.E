const SageApp = {
    initLayout() {
        const page = document.body.dataset.page;
        const crumb = document.body.dataset.crumb;

        SidebarComponent.render(page);
        TopbarComponent.render(crumb);
        this.injectIcons();
    },

    injectIcons() {
        document.querySelectorAll("[data-icon]").forEach((element) => {
            const icon = element.dataset.icon;
            element.innerHTML = SageIcons[icon] || "";
        });
    },

    setTheme(theme) {
        document.documentElement.dataset.theme = theme;
        localStorage.setItem("sage-theme", theme);

        const icon = document.querySelector("[data-theme-icon]");
        if (icon) icon.textContent = theme === "dark" ? "☾" : "☀";

        document.querySelectorAll("[data-theme-option]").forEach((button) => {
            button.classList.toggle("active", button.dataset.themeOption === theme);
        });
    },

    initTheme() {
        this.setTheme(localStorage.getItem("sage-theme") || "light");

        document.addEventListener("click", (event) => {
            const toggle = event.target.closest("[data-theme-toggle]");
            if (toggle) {
                const nextTheme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
                this.setTheme(nextTheme);
            }

            const option = event.target.closest("[data-theme-option]");
            if (option) this.setTheme(option.dataset.themeOption);
        });
    },

    initDate() {
        const target = document.querySelector("[data-current-date]");
        if (target) target.textContent = SageUtils.currentDateLabel();

        document.querySelectorAll('input[type="date"]').forEach((input) => {
            if (!input.value) input.value = SageUtils.today();
        });
    },

    clearErrors(form) {
        form.querySelectorAll(".sage-field").forEach((field) => {
            field.classList.remove("is-invalid");
        });
    },

    validate(form) {
        this.clearErrors(form);
        let valid = true;

        form.querySelectorAll("[required]").forEach((input) => {
            const value = String(input.value || "").trim();
            const field = input.closest(".sage-field");

            if (!value) {
                valid = false;
                field?.classList.add("is-invalid");
            }
        });

        return valid;
    },

    showFeedback(form, message, type = "success") {
        const feedback = form.querySelector("[data-form-feedback]");
        if (!feedback) return;

        feedback.classList.remove("success", "warning");
        feedback.classList.add("active", type);
        feedback.textContent = message;
    },

    resetForm(form) {
        form.reset();
        this.clearErrors(form);

        form.querySelectorAll("[data-form-feedback]").forEach((feedback) => {
            feedback.classList.remove("active", "success", "warning");
            feedback.textContent = "";
        });

        this.initDate();
    },

    initForms() {
        document.querySelectorAll("[data-sage-form]").forEach((form) => {
            form.addEventListener("submit", (event) => {
                if (form.dataset.backendActive === "true") return;

                event.preventDefault();

                if (!this.validate(form)) {
                    this.showFeedback(form, "Confira os campos obrigatórios antes de continuar.", "warning");
                    return;
                }

                this.showFeedback(form, "Formulário validado. Pronto para integração com o back-end.", "success");

                const modal = form.closest(".sage-modal-layer");
                if (modal) {
                    window.setTimeout(() => {
                        ModalComponent.close(modal);
                        this.resetForm(form);
                    }, 500);
                }
            });

            form.addEventListener("input", () => this.clearErrors(form));
            form.addEventListener("change", () => this.clearErrors(form));
        });
    },

    initSearch() {
        document.querySelectorAll("[data-empty-search]").forEach((input) => {
            input.addEventListener("input", () => {
                const table = document.querySelector(input.dataset.emptySearch);
                if (!table) return;

                const hasTerm = Boolean(input.value.trim());
                const colspan = table.dataset.colspan || "6";

                table.innerHTML = EmptyStateComponent.row({
                    colspan,
                    icon: "search",
                    title: hasTerm ? "Sem resultados" : "Nenhum registro",
                    text: hasTerm
                        ? "Nenhum resultado encontrado. A busca será conectada ao back-end."
                        : "Nenhum registro para exibir. Dados serão carregados pelo back-end."
                });
            });
        });
    },

    init() {
        this.initLayout();
        this.initTheme();
        this.initDate();
        ModalComponent.init();
        this.initForms();
        this.initSearch();
    }
};

document.addEventListener("DOMContentLoaded", () => SageApp.init());
