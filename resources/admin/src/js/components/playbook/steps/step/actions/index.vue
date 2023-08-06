<template>
    <div>
        <add-form @add="onAdd"></add-form>
        <template v-if="loaded && actionsSorted.length">
            <list-item
                v-for="action in actionsSorted"
                :key="action.id"
                :action="action"
                @delete="onDelete"
            ></list-item>
        </template>
        <p v-else-if="loaded">There are no actions.</p>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";
import AddForm from "./add-form.vue";

export default {
    name: "Actions",
    components: {
        ListItem,
        AddForm,
    },
    props: ["step"],
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */
        const playbookActions = ref([]);
        const loaded = ref(false);
        const submitting = ref(false);
        const $cookies = inject("$cookies");

        /**
         * Methods
         */
        async function fetchPlaybookActionList() {
            const response = await fetch(
                "/api/lp-playbook-actions?lp_playbook_id=" +
                    props.step.playbook_id +
                    "&lp_playbook_step_id=" +
                    props.step.id
            );
            const json = await response.json();
            playbookActions.value = json.data;
            loaded.value = true;
        }

        async function onAdd(playbookAction) {
            playbookAction.lp_playbook_id = props.step.lp_playbook_id;
            playbookAction.lp_playbook_step_id = props.step.id;
            submitting.value = true;
            const response = await fetch("/api/lp-playbook-actions", {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "POST",
                body: JSON.stringify(playbookAction),
            });
            submitting.value = false;

            const json = await response.json();

            if (!response.ok) {
                notify({
                    title: json.message,
                    type: "error",
                });
                return;
            }

            notify({
                title: "New playbook action added.",
                type: "success",
            });

            playbookActions.value.push(
                Object.assign(playbookAction, json.data)
            );
        }

        async function onDelete(id) {
            const response = await fetch("/api/lp-playbook-actions/" + id, {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "DELETE",
            });
            if (!response.ok) {
                notify({
                    title: json.message,
                    type: "error",
                });
                return;
            }

            notify({
                title: "Action deleted.",
                type: "warn",
            });

            var indexToRemove = playbookActions.value
                .map((item) => item.id)
                .indexOf(id);
            ~indexToRemove && playbookActions.value.splice(indexToRemove, 1);
        }

        fetchPlaybookActionList();

        /**
         * Updated
         */
        const actionsSorted = computed(() => {
            return _sortBy(playbookActions.value || [], (action) => {
                return playbookActions.class_name;
            });
        });

        return {
            actionsSorted,
            loaded,
            onAdd,
            onDelete,
        };
    },
};
</script>

<style>
</style>