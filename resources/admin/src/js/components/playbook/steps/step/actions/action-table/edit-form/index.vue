<template>
    <span>
        <a href="#" @click.prevent="visible = !visible"> <slot></slot></a>
        <div
            class="modal"
            :class="{ active: visible }"
            :id="'playbook-action-' + buffer.id"
        >
            <a
                href="#close"
                @click.prevent="visible = false"
                class="modal-overlay"
                aria-label="Close"
            ></a>
            <div class="modal-container">
                <div class="modal-header">
                    <a
                        href="#close"
                        @click.prevent="visible = false"
                        class="btn btn-clear float-right"
                        aria-label="Close"
                    ></a>
                    <div class="modal-title h5">Configure Action</div>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="onSubmit">
                        <fieldset>
                            <div class="form-group form-inline mx-2">
                                <label class="form-label" for="name"
                                    >Action Label</label
                                >
                                <input
                                    class="form-input"
                                    name="name"
                                    id="name"
                                    v-model.number="buffer.name"
                                />
                            </div>
                        </fieldset>
                        <configuration-form
                            :definition="classDefinition?.configuration"
                            v-model="buffer.configuration"
                        ></configuration-form>
                        <fieldset>
                            <div class="form-group form-inline mx-2">
                                <button
                                    class="btn btn-primary mx-2"
                                    :class="{ loading: submitting }"
                                    :disabled="!valid"
                                >
                                    Save Configuration
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </span>
</template>


<script>
import { ref, reactive, computed } from "vue";

import ConfigurationForm from "./configuration-form/index.vue";

export default {
    name: "ActionEditForm",
    components: { ConfigurationForm },
    emits: ["add", "update-action"],
    props: ["visible", "playbookAction", "submitting", "enableCase"],
    setup(props, { emit }) {
        const classes = ref([]);
        const loaded = ref(false);
        const visible = ref(false);
        const buffer = ref(props.playbookAction);

        async function fetchClassList() {
            const response = await fetch("/api/lp-actions");
            const json = await response.json();
            classes.value = json.data;
            loaded.value = true;
        }

        async function onSubmit() {
            if (!this.valid) {
                return;
            }
            emit("update-action", buffer.value);
            visible.value = false;
        }

        /**
         * Computed
         */
        const valid = computed(() => {
            return (
                (buffer.value.action_class_name || "").length > 0 &&
                (buffer.value.name || "").length > 0
            );
        });

        const classDefinition = computed(() => {
            return classes.value.find(
                (item) => item.namespace == buffer.value.action_class_name
            );
        });

        fetchClassList();

        return {
            classes,
            onSubmit,
            valid,
            classDefinition,
            loaded,
            visible,
            buffer,
        };
    },
};
</script>