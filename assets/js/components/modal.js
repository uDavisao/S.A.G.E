const ModalComponent = {
    open(selector) {
        const modal = document.querySelector(selector);
        if (!modal) return;

        this.closeAll();

        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");
        document.body.classList.add("sage-modal-open");

        const firstField = modal.querySelector("input:not([type='hidden']), select, textarea");
        if (firstField) {
            window.setTimeout(() => firstField.focus(), 80);
        }
    },

    close(modal) {
        if (!modal) return;

        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");
        document.body.classList.remove("sage-modal-open");
    },

    closeAll() {
        document.querySelectorAll(".sage-modal-layer.is-open").forEach((modal) => {
            this.close(modal);
        });
    },

    init() {
        document.addEventListener("click", (event) => {
            const openButton = event.target.closest("[data-modal-open]");
            if (openButton) {
                event.preventDefault();
                this.open(openButton.dataset.modalOpen);
                return;
            }

            const closeButton = event.target.closest("[data-modal-close]");
            if (closeButton) {
                event.preventDefault();
                this.close(closeButton.closest(".sage-modal-layer"));
                return;
            }

            if (event.target.classList.contains("sage-modal-backdrop")) {
                this.close(event.target.closest(".sage-modal-layer"));
            }
        });

        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") this.closeAll();
        });
    }
};
