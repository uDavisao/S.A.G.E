const SAGE_API = {
    baseURL: "",

    setBaseURL(url) {
        this.baseURL = url || "";
    },

    async request(path, options = {}) {
        const response = await fetch(`${this.baseURL}${path}`, {
            headers: {
                "Content-Type": "application/json",
                ...(options.headers || {})
            },
            ...options
        });

        if (!response.ok) {
            throw new Error(`Erro HTTP ${response.status}`);
        }

        return response.json();
    },

    login(payload) {
        return this.request("/auth/login", {
            method: "POST",
            body: JSON.stringify(payload)
        });
    },

    listParts() {
        return this.request("/parts");
    },

    createPart(payload) {
        return this.request("/parts", {
            method: "POST",
            body: JSON.stringify(payload)
        });
    },

    listMovements() {
        return this.request("/movements");
    },

    createEntry(payload) {
        return this.request("/movements/entry", {
            method: "POST",
            body: JSON.stringify(payload)
        });
    },

    createExit(payload) {
        return this.request("/movements/exit", {
            method: "POST",
            body: JSON.stringify(payload)
        });
    },

    getDashboard() {
        return this.request("/dashboard");
    },

    getReports() {
        return this.request("/reports");
    },

    getSettings() {
        return this.request("/settings");
    }
};
