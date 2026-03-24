import "./bootstrap";
import "../css/app.css";

import Alpine from "alpinejs";
import { authModal } from "./auth";

window.Alpine = Alpine;

window.authModal = authModal;

Alpine.start();
