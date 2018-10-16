import Vue from "vue";
import VueResource from "vue-resource";
import VueTreeNavigation from 'vue-tree-navigation';
import App from "./App.vue";
import router from "./router";

Vue.use(VueResource);
Vue.use(VueTreeNavigation);

import Default from "./layouts/Default";
Vue.component("default-layout", Default);

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
