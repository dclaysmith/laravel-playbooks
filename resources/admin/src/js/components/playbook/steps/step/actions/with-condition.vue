<template>
    <div>
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