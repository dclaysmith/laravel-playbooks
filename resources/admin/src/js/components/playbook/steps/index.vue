<template>
    <div>
        <add-form @add="onAdd"></add-form>
        <template v-if="loaded && playbookStepsSorted.length">
            <playbook-step
                v-for="playbookStep in playbookStepsSorted"
                :key="playbookStep.id"
                :playbook-step="playbookStep"
                @delete="onDelete"
            ></playbook-step>
        </template>
        <p v-else-if="loaded">There are no steps.</p>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import PlaybookStep from "./step/index.vue";
import AddForm from "./add-form.vue";

export default {
    name: "Steps",
    components: {
        PlaybookStep,
        AddForm,
    },
    props: ["playbook"],
    setup(props, { emit }) {
        /**
         * Reactive Properties
         */
        const playbookSteps = ref([]);
        const loaded = ref(false);
        const submitting = ref(false);
        const $cookies = inject("$cookies");

        /**
         * Methods
         */
        async function fetchPlaybookStepList() {
            const response = await fetch(
                "/api/lp-playbook-steps?lp_playbooks=" + props.playbook.id
            );
            const json = await response.json();
            playbookSteps.value = json.data;
            loaded.value = true;
        }

        async function onAdd(playbookStep) {
            playbookStep.lp_playbook_id = props.playbook.id;
            submitting.value = true;
            const response = await fetch("/api/lp-playbook-steps", {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "POST",
                body: JSON.stringify(playbookStep),
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
                title: "New playbook step added.",
                type: "success",
            });

            playbookSteps.value.push(Object.assign(playbookStep, json.data));
        }

        async function onDelete(id) {
            const response = await fetch("/api/lp-playbook-steps/" + id, {
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
                title: "Step deleted.",
                type: "warn",
            });

            var indexToRemove = playbookSteps.value
                .map((item) => item.id)
                .indexOf(id);
            ~indexToRemove && playbookSteps.value.splice(indexToRemove, 1);
        }

        fetchPlaybookStepList();

        /**
         * Updated
         */
        const playbookStepsSorted = computed(() => {
            return _sortBy(playbookSteps.value || [], (step) => {
                return playbookSteps.class_name;
            });
        });

        return {
            playbookStepsSorted,
            loaded,
            onAdd,
            onDelete,
        };
    },
};
</script>

<style>
</style>