<template>
    <div>
        <add-form
            @add="$emit('add-action', $event)"
            :playbook-step="playbookStep"
            :submitting="submitting"
            :enable-case="false"
        ></add-form>
        <action-table
            :playbook-actions="playbookActionsSorted"
            @delete-action="$emit('delete-action', $event)"
        ></action-table>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import AddForm from "./add-form/index.vue";
import ActionTable from "./action-table/index.vue";

export default {
    name: "WithoutCondition",
    props: ["playbookStep", "playbookActions"],
    components: { AddForm, ActionTable },
    emits: ["add-action", "delete-action"],
    setup(props, { emit }) {
        const submitting = ref(false);

        /**
         * Computed
         */
        const playbookActionsSorted = computed(() => {
            if (!props.playbookActions) {
                return [];
            }
            return _sortBy(props.playbookActions || [], (playbookAction) => {
                return playbookAction.class_name;
            });
        });

        return { submitting, playbookActionsSorted };
    },
};
</script>

<style>
</style>