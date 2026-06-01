document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#loginForm");
    const logo = document.querySelector("[data-login-logo]");
    const emailIcon = document.querySelector("[data-login-email-icon]");
    const lockIcon = document.querySelector("[data-login-lock-icon]");
    const themeButton = document.querySelector("[data-login-theme-toggle]");
    const themeIcon = document.querySelector("[data-login-theme-icon]");
    const feedback = document.querySelector("[data-login-feedback]");

    if (logo) logo.innerHTML = SageIcons.wrench;
    if (emailIcon) emailIcon.innerHTML = SageIcons.mail;
    if (lockIcon) lockIcon.innerHTML = SageIcons.lock;

    function setTheme(theme) {
        document.documentElement.dataset.theme = theme;
        localStorage.setItem("sage-theme", theme);

        if (themeIcon) {
            themeIcon.textContent = theme === "dark" ? "☀" : "☾";
        }
    }

    setTheme(localStorage.getItem("sage-theme") || "light");

    themeButton?.addEventListener("click", () => {
        const currentTheme = document.documentElement.dataset.theme || "light";
        setTheme(currentTheme === "dark" ? "light" : "dark");
    });

    form?.addEventListener("submit", (event) => {

        const email = form.email.value.trim();
        const password = form.password.value.trim();

     if (!email || !password) {

         event.preventDefault();

            if (feedback) {
                eedback.classList.add("is-visible");
                feedback.textContent = "Preencha o e-mail e a senha para continuar.";
            }

         return;
        }

        if (feedback) {
            feedback.classList.remove("is-visible");
            feedback.textContent = "";
        }
    }); 
});
