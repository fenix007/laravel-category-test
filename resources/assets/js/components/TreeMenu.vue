<template>
    <li>
        <div
                :class="{bold: isFolder}"
            >
            <router-link :to="itemRoute">{{ model.name }}</router-link>
            <span v-if="isFolder" @click="toggle">[{{ open ? '-' : '+' }}]</span>
        </div>
        <ul v-show="open" v-if="isFolder">
            <item
                    class="item"
                    v-for="(model, index) in model.children"
                    :key="index"
                    :model="model">
            </item>
        </ul>
    </li>
</template>

<script>
    export default {
        name: 'item',
        props: ['model'],
        data: function () {
            return {
                open: false
            }
        },
        computed: {
            isFolder: function () {
                return this.model.children &&
                    this.model.children.length
            },
            itemRoute: function () {
                return '?category=' + this.model.id;
            }
        },
        methods: {
            toggle: function () {
                if (this.isFolder) {
                    this.open = !this.open
                }
            }
        }
    }
</script>
