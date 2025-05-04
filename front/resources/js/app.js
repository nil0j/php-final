// import "./bootstrap";
import router from "./router";
import { createApp } from "vue";
import App from "./App.vue";

const app = document.getElementById("app")
const token = app.getAttribute("data")
console.log(token)

createApp(App).use(router).provide("token", token).mount("#app");
