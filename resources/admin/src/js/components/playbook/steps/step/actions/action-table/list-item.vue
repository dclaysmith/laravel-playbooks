<template>
    <tr>
        <td><i class="icon icon-2x icon-menu"></i></td>
        <td>
            {{ playbookAction.name }}
        </td>
        <td>
            {{ playbookAction.action_class_name }}
        </td>
        <td>Configure</td>
        <td class="text-right">
            <button
                @click.prevent="onDeleteClick"
                class="btn btn-link text-error"
            >
                Delete
            </button>
        </td>
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
    emits: ["delete-action"],
    components: {},
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */

        /**
         * Methods
         */
        async function onDeleteClick() {
            emit("delete-action", props.playbookAction.id);
        }

        /**
         * Computed
         */

        return { onDeleteClick };
    },
};
</script>

<style>
</style>