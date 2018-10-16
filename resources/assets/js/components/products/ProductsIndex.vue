<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Products list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Categories</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product, index in products">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ truncate(product.description, 50) }}</td>
                        <td><img :src="product.photo"></td>
                        <td>{{ categoryString(product) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                products: []
            }
        },
        methods: {
             categoryString (product) {
                 return product.categories.data.map(cat => cat.name).join(', ');
             },
            truncate(string, maxLength) {
                if (string.length <= maxLength) {
                    return string;
                }
                return string.substring(0, maxLength) + '...';
            }
        },
        mounted() {
            const app = this;
            this.$http.get('/api/product')
                .then(function (resp) {
                    app.products = resp.data.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load products");
                });
        }
    }
</script>
