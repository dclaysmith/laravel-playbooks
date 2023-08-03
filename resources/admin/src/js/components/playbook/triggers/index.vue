<template>
    <div>
        <add-form @add="onAdd"></add-form>
        <table class="table" v-if="loaded && triggersSorted.length">
            <tr>
                <th>Id</th>
                <th colspan="2">Trigger</th>
            </tr>
            <list-item
                v-for="trigger in triggersSorted"
                :key="trigger.id"
                :trigger="trigger"
                @delete="onDelete"
            ></list-item>
        </table>
        <p v-else-if="loaded">There are no triggers.</p>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";
import AddForm from "./add-form.vue";

export default {
    name: "Triggers",
    components: {
        ListItem,
        AddForm,
    },
    props: ["playbook"],
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */
        const playbookTriggers = ref([]);
        const loaded = ref(false);
        const submitting = ref(false);

        /**
         * Methods
         */
        async function fetchPlaybookTriggerList() {
            const response = await fetch(
                "/api/lp-playbook-triggers?lp_playbooks=" + props.playbook.id
            );
            const json = await response.json();
            playbookTriggers.value = json.data;
            loaded.value = true;
        }

        async function onAdd(playbookTrigger) {
            playbookTrigger.lp_playbook_id = props.playbook.id;
            submitting.value = true;
            const response = await fetch("/api/lp-playbook-triggers", {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "POST",
                body: JSON.stringify(playbookTrigger),
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
                title: "New playbook trigger added.",
                type: "success",
            });

            playbookTriggers.value.push(
                Object.assign(playbookTrigger, json.data)
            );
        }

        async function onDelete(id) {
            const response = await fetch("/api/lp-playbook-triggers/" + id, {
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
                title: "Trigger deleted.",
                type: "warn",
            });

            var indexToRemove = playbookTriggers.value
                .map((item) => item.id)
                .indexOf(id);
            ~indexToRemove && playbookTriggers.value.splice(indexToRemove, 1);
        }

        fetchPlaybookTriggerList();

        /**
         * Updated
         */
        const triggersSorted = computed(() => {
            return _sortBy(playbookTriggers.value || [], (trigger) => {
                return playbookTriggers.class_name;
            });
        });

        return {
            triggersSorted,
            loaded,
            onAdd,
            onDelete,
        };
    },
};
</script>

<style>
</style>