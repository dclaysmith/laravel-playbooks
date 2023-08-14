<template>
    <table class="table">
        <list-item
            v-for="playbookAction in playbookActions"
            :key="playbookAction.id"
            :playbook-action="playbookAction"
            @delete="onDelete"
        ></list-item>
    </table>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useRouter } from "vue-router";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";

export default {
    name: "PlaybookActionTable",
    props: ["playbookActions"],
    components: {
        ListItem,
    },
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */

        /**
         * Methods
         */

        /**
         * Computed
         */

        return {};
    },
};
</script>

<style>
</style>