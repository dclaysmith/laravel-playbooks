<template>
    <div>
        <add-form @add="onAddStep"></add-form>
        <template v-if="loaded && playbookStepsSorted.length">
            <playbook-step
                v-for="playbookStep in playbookStepsSorted"
                :key="playbookStep.id"
                :playbook-step="playbookStep"
                :playbook-actions="playbookActionsFiltered(playbookStep.id)"
                @delete-step="onDelete"
                @add-action="onAddAction"
                @delete-action="onDeleteAction"
            ></playbook-step>
        </template>
        <p v-else-if="loaded">There are no steps.</p>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed, inject, watch } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy, filter as _filter } from "lodash";

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
        const playbookSteps = ref(null);
        const playbookActions = ref(null);
        const submitting = ref(false);
        const $cookies = inject("$cookies");

        /**
         * Methods
         */
        async function fetchPlaybookStepList() {
            const response = await fetch(
                "/api/lp-playbook-steps?lp_playbook_id=" + props.playbook.id
            );
            const json = await response.json();
            playbookSteps.value = json.data;
        }

        async function fetchPlaybookActionList() {
            const response = await fetch(
                "/api/lp-playbook-actions?lp_playbook_id=" + props.playbook.id
            );
            const json = await response.json();
            playbookActions.value = json.data;

            /**
             * Watch
             */
            watch(
                playbookActions,
                async (newActions, oldActions) => {
                    newActions.forEach(function (item, index) {
                        console.log(item.id + " - " + item.sort_order);
                        updateAction(item);
                    });
                },
                { deep: true }
            );
        }

        async function onAddAction(playbookAction) {
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

        async function onAddStep(playbookStep) {
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

        async function onDeleteAction(id) {
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

        async function updateAction(playbookAction) {
            const response = await fetch(
                "/api/lp-playbook-actions/" + playbookAction.id,
                {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                    },
                    method: "PUT",
                    body: JSON.stringify(playbookAction),
                }
            );
            if (!response.ok) {
                notify({
                    title: json.message,
                    type: "error",
                });
                return;
            }
        }

        function playbookActionsFiltered(playbookStepId) {
            if (!playbookActions) {
                return [];
            }
            return _filter(playbookActions.value || [], (playbookAction) => {
                return playbookAction.lp_playbook_step_id == playbookStepId;
            });
        }

        Promise.all([fetchPlaybookStepList(), fetchPlaybookActionList()]);

        /**
         * Computed
         */
        const playbookStepsSorted = computed(() => {
            if (!playbookSteps) {
                return [];
            }
            return _sortBy(playbookSteps.value || [], (step) => {
                return playbookSteps.sort_order;
            });
        });

        const loaded = computed(() => {
            return (
                playbookSteps.value !== null && playbookActions.value !== null
            );
        });

        return {
            playbookStepsSorted,
            playbookActionsFiltered,
            loaded,
            onAddStep,
            onAddAction,
            onDelete,
            onDeleteAction,
        };
    },
};
</script>

<style>
</style>