import "./bootstrap";
import "../css/app.css";

import Alpine from "alpinejs";

window.Alpine = Alpine;

window.authModal = function (hasError) {
    return {
        showLogin: false,
        showRegister: false,

        init() {
            if (hasError) {
                this.showLogin = true;
            }
        },

        closeAll() {
            this.showLogin = false;
            this.showRegister = false;
        },
    };
};

Alpine.start();
