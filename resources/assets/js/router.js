import Vue from "vue";
import Router from "vue-router";
import ProductsIndex from './components/products/ProductsIndex.vue';

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: '/',
            name: ProductsIndex,
            component: ProductsIndex
        },
    ]
});
