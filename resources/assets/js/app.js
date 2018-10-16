import Vue from "vue";
import VueResource from "vue-resource";
import App from "./App.vue";
import router from "./router";

import Default from "./layouts/Default.vue";

Vue.component("default-layout", Default);
Vue.use(VueResource);

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
