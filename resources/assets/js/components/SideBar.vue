<template>
    <div class="sidebar">
        <vue-tree-navigation :items="items" :defaultOpenLevel="1" />
    </div>
</template>
<script>
    import ListToTree from '../services/ListToTree'
    const listToTree = new ListToTree();

    export default {
        data: function () {
            return {
                items: []
            }
        },
        mounted() {
            const app = this;
            this.$http.get('/api/category')
                .then(function (resp) {
                    app.items = listToTree.toTree(resp.data.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load menu");
                });
        }
    }
</script>