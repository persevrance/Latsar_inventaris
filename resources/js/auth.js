export function authModal(hasError = false) {
    return {
        showLogin: false,
        showRegister: false,

        init() {
            this.showLogin = hasError;
        },

        openLogin() {
            this.showRegister = false;
            this.showLogin = true;
        },

        openRegister() {
            this.showLogin = false;
            this.showRegister = true;
        },

        closeAll() {
            this.showLogin = false;
            this.showRegister = false;
        },
    };
}
