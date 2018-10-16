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
                <div class="column is-3">
                    <side-bar />
                </div>

                <div class="column is-9">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
