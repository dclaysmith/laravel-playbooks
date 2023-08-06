<template>
    <div>
        <notifications />
        <div class="playbooks-container">
            <div class="playbooks-menu"><admin-menu></admin-menu></div>
            <div class="playbooks-content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import AdminMenu from "./components/menu/index.vue";

export default {
    name: "LaravelPlaybooksAdminVueComponent",
    components: {
        AdminMenu: AdminMenu,
    },
};
</script>

<style lang="scss">
.playbooks-container {
    display: flex;
}
.playbooks-menu {
    flex: 2;
    padding: 2em;
}
.playbooks-menu ul {
    margin: 0px;
}
.playbooks-content {
    flex: 8;
    padding: 2em;
}
</style>