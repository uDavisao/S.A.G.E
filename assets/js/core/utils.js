const SageUtils = {
    currency(value) {
        return Number(value || 0).toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL"
        });
    },

    number(value) {
        return Number(value || 0).toLocaleString("pt-BR");
    },

    today() {
        return new Date().toISOString().slice(0, 10);
    },

    currentDateLabel() {
        return new Date().toLocaleDateString("pt-BR", {
            weekday: "long",
            day: "numeric",
            month: "long"
        });
    },

    formPayload(form) {
        return Object.fromEntries(new FormData(form).entries());
    }
};
