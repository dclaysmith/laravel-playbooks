<template>
    {{ drag }}
    <table class="table">
        <tfoot v-if="playbookActions.length == 0">
            <tr>
                <td>No actions yet.</td>
            </tr>
        </tfoot>
        <draggable
            v-else
            tag="tbody"
            v-model="playbookActions"
            @start="drag = true"
            @end="drag = false"
            item-key="id"
        >
            <template #item="{ element: playbookAction }">
                <list-item
                    class="drag-item"
                    :playbook-action="playbookAction"
                    @delete-action="$emit('delete-action', $event)"
                ></list-item
            ></template>
        </draggable>
    </table>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useRouter } from "vue-router";
import { sortBy as _sortBy } from "lodash";
import draggable from "vuedraggable";

import ListItem from "./list-item.vue";

export default {
    name: "PlaybookActionTable",
    props: ["playbookActions"],
    emits: ["delete-action"],
    components: {
        ListItem,
        draggable,
    },
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */

        const drag = ref(false);
        const myArray = ref([]);
        /**
         * Methods
         */

        /**
         * Computed
         */

        return { drag, myArray };
    },
};
</script>

<style>
</style>