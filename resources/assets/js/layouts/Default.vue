<script>
    import SideBar from "../components/SideBar";
    export default {
        components: {
            SideBar
        }
    };
</script>

<template>
    <div>
        <div class="container section">
            <div class="columns">
                <div class="column is-8">
                    <slot />
                </div>

                <div class="column is-4">
                    <side-bar />
                </div>
            </div>
        </div>
    </div>
</template>
