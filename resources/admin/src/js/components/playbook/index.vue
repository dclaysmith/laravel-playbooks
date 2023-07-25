<template>
    <div>
        <p><router-link to="/playbooks">&lt; Back</router-link></p>
        <template v-if="playbook">
            <h2>Edit Playbook: {{ playbook.name }}</h2>
            <p>{{ playbook }}</p>
        </template>
    </div>
</template>

<script>
import { ref, computed, watch } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy, filter as _filter, chain as _chain } from "lodash";

export default {
    name: "Playbook",
    components: {},
    props: ["id"],
    setup(props) {
        debugger;
        /**
         * Reactive Properties
         */
        const playbook = ref(null);
        const playbookOriginal = ref(null);
        z;
        /**
         * Methods
         */
        async function fetchPlaybook() {
            const response = await fetch("/api/lp-playbooks/" + props.id);
            const json = await response.json();
            playbook.value = json.data;
            playbookOriginal.value = Object.assign({}, playbook.value);
        }

        async function onSubmit() {
            const response = await fetch("/api/cms-playbooks/" + props.id, {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "PUT",
                body: JSON.stringify(playbook.value),
            });

            const json = await response.json();

            if (!response.ok) {
                notify({
                    title: json.message,
                    type: "error",
                });
                return;
            }

            playbook.value = json.data;
            playbookOriginal.value = Object.assign({}, playbook.value);

            notify({
                title: "Playbook updated.",
                type: "success",
            });
        }

        Promise.all([fetchPlaybook(), fetchTemplateList()]);

        /**
         * Computed
         */
        const saveEnabled = computed(() => {
            return (
                JSON.stringify(playbookOriginal.value) !=
                JSON.stringify(playbook.value)
            );
        });

        return {
            tab,
            playbook,
            templates,
            saveEnabled,
            onSubmit,
        };
    },
};
</script>

<style>
</style>