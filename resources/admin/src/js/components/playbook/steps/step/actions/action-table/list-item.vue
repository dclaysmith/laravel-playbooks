<template>
    <tr>
        HELLO
    </tr>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useRouter } from "vue-router";
import { sortBy as _sortBy } from "lodash";

export default {
    name: "PlaybookActionTableRow",
    props: ["playbookAction"],
    components: {},
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