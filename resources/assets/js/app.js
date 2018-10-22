import Vue from "vue";
import VueResource from "vue-resource";
import App from "./App.vue";
import router from "./router";

Vue.use(VueResource);

import Default from "./layouts/Default";
Vue.component("default-layout", Default);

import TreeMenu from "./components/TreeMenu";
Vue.component("item", TreeMenu);

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
