<template>
    <div>
        <component
            v-if="loaded"
            :is="componentName"
            :playbook-step="playbookStep"
            :playbook-actions="playbookActionsSorted"
            @delete="onDelete"
        ></component>
        <p v-else>Loading...</p>
        {{ componentName }}
    </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import WithCondition from "./with-condition.vue";
import WithoutCondition from "./without-condition.vue";

export default {
    name: "Actions",
    components: { WithCondition, WithoutCondition },
    props: ["playbookStep"],
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
                    props.playbookStep.playbook_id +
                    "&lp_playbook_step_id=" +
                    props.playbookStep.id
            );
            const json = await response.json();
            playbookActions.value = json.data;
            loaded.value = true;
        }

        async function onAdd(playbookAction) {
            playbookAction.lp_playbook_id = props.playbookStep.lp_playbook_id;
            playbookAction.lp_playbook_step_id = props.playbookStep.id;
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
         * Computed
         */
        const playbookActionsSorted = computed(() => {
            return _sortBy(playbookActions.value || [], (action) => {
                return playbookActions.class_name;
            });
        });

        /**
         * Computed
         */
        const componentName = computed(() => {
            return props.playbookStep.condition_class_name
                ? "WithCondition"
                : "WithoutCondition";
        });

        return {
            playbookActionsSorted,
            loaded,
            componentName,
            onAdd,
            onDelete,
        };
    },
};
</script>

<style>
</style>