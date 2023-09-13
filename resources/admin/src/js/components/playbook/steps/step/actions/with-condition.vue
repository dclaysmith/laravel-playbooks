<template>
    <div>
        [ WITH STEP CONDITION ]
        <p>If True...</p>

        {{ trueActions }}

        <p>If False...</p>

        {{ falseActions }}

        <p>And then...</p>

        {{ finallyActions }}
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

export default {
    name: "WithCondition",
    props: ["playbookStep"],
    setup(props, { emit }) {
        /**
         * Computed
         */
        const trueActions = computed(() => {
            return [];
        });
        const falseActions = computed(() => {
            return [];
        });
        const finallyActions = computed(() => {
            return [];
        });

        return { trueActions, falseActions, finallyActions };
    },
};
</script>

<style>
</style>