<template>
    <ul id="tree-menu">
        <item
                class="item"
                v-for="(model, index) in items"
                :key="index"
                :model="model">
        </item>
    </ul>
</template>
<script>
    export default {
        data: function () {
            return {
                items: []
            }
        },
        mounted() {
            const app = this;
            this.$http.get('/api/category-hierarchy')
                .then(function (resp) {
                    app.items = resp.data.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load menu");
                });
        }
    }
</script>
