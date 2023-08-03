<template>
    <div>
        <p><router-link to="/playbooks">&lt; Back</router-link></p>
        <template v-if="playbook">
            <h2>Edit Playbook: {{ playbook.name }}</h2>
            <form @submit.prevent="onSubmit">
                <fieldset>
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input
                            class="form-input"
                            type="text"
                            name="name"
                            id="name"
                            v-model="playbook.name"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="allow_multiple"
                            >Allow Multiple Instances</label
                        >
                        <input
                            type="checkbox"
                            name="allow_multiple"
                            id="allow_multiple"
                            v-model="playbook.allow_multiple"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="allow_multiple"
                            >Allow Concurrent Instances</label
                        >
                        <input
                            type="checkbox"
                            name="allow_concurrent"
                            id="allow_concurrent"
                            v-model="playbook.allow_concurrent"
                        />
                    </div>
                    <div
                        class="form-group"
                        v-if="
                            playbook.allow_multiple &&
                            !playbook.allow_concurrent
                        "
                    >
                        <label class="form-label" for="multiple_buffer_days"
                            >Delay Between Instances (Days)</label
                        >
                        <input
                            type="number"
                            name="multiple_buffer_days"
                            id="multiple_buffer_days"
                            v-model="playbook.multiple_buffer_days"
                        />
                    </div>
                    <div class="form-group">
                        <button
                            class="btn btn-primary"
                            :class="{ loading: submitting }"
                            :disabled="!saveEnabled"
                        >
                            Update
                        </button>
                    </div>
                </fieldset>
            </form>
            <playbook-triggers :playbook="playbook"></playbook-triggers>
            <playbook-steps :playbook="playbook"></playbook-steps>
        </template>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed, watch } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy, filter as _filter, chain as _chain } from "lodash";

import PlaybookTriggers from "./triggers/index.vue";
import PlaybookSteps from "./steps/index.vue";

export default {
    name: "Playbook",
    components: { PlaybookTriggers, PlaybookSteps },
    props: ["id"],
    setup(props) {
        /**
         * Reactive Properties
         */
        const playbook = ref(null);
        const playbookOriginal = ref(null);
        const submitting = ref(false);
        const loading = ref(false);

        /**
         * Methods
         */
        async function fetchPlaybook() {
            loading.value = true;
            const response = await fetch("/api/lp-playbooks/" + props.id);
            const json = await response.json();
            loading.value = false;
            playbook.value = json.data;
            playbookOriginal.value = Object.assign({}, playbook.value);
        }

        async function onSubmit() {
            submitting.value = true;
            const response = await fetch("/api/lp-playbooks/" + props.id, {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "PUT",
                body: JSON.stringify(playbook.value),
            });

            const json = await response.json();
            submitting.value = false;

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

        Promise.all([fetchPlaybook()]);

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
            playbook,
            saveEnabled,
            onSubmit,
            submitting,
            loading,
        };
    },
};
</script>

<style>
</style>