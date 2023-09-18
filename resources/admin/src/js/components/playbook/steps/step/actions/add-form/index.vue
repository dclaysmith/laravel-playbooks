<template>
    <form @submit.prevent="onSubmit">
        <fieldset>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="action_class_name">Action</label>
                <select
                    class="form-input"
                    name="action_class_name"
                    id="action_class_name"
                    v-model.number="newPlaybookAction.action_class_name"
                >
                    <option></option>
                    <option
                        v-for="actionClass in classes"
                        :key="actionClass.className"
                        :value="actionClass.className"
                    >
                        {{ actionClass.className }}
                    </option>
                </select>
            </div>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="name">Action Label</label>
                <input
                    class="form-input"
                    name="name"
                    id="name"
                    v-model.number="newPlaybookAction.name"
                />
            </div>
            <button
                class="btn btn-primary mx-2"
                :class="{ loading: submitting }"
                :disabled="!valid"
            >
                Add Action
            </button>
        </fieldset>
        <configuration-form
            v-model:visible="showConfigurationEditor"
            :definition="classDefinition?.configuration"
            v-model="configuration"
            @update-configuration="onConfigurationFormSubmit"
        ></configuration-form>
    </form>
</template>


<script>
import { ref, reactive, computed } from "vue";
import ConfigurationForm from "./configuration-form/index.vue";

export default {
    name: "ActionAddForm",
    components: { ConfigurationForm },
    emits: ["add"],
    props: ["playbookStep", "case", "submitting"],
    setup(props, { emit }) {
        const newPlaybookAction = ref({});
        const classes = ref([]);
        const loaded = ref(false);
        const showConfigurationEditor = ref(false);
        const configuration = reactive({});

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

            newPlaybookAction.value.lp_playbook_id =
                props.playbookStep.lp_playbook_id;
            newPlaybookAction.value.lp_playbook_step_id = props.playbookStep.id;
            newPlaybookAction.value.case = props.case;

            if (
                Object.keys(this.classDefinition.configuration || {}).length > 0
            ) {
                showConfigurationEditor.value = true;
                return;
            }

            emit("add", newPlaybookAction.value);
            showConfigurationEditor.value = false;
            newPlaybookAction.value = {};
            Object.assign(configuration, {});
        }

        async function onConfigurationFormSubmit() {
            newPlaybookAction.value.lp_playbook_id =
                props.playbookStep.lp_playbook_id;
            newPlaybookAction.value.lp_playbook_step_id = props.playbookStep.id;
            newPlaybookAction.value.configuration = configuration;

            emit("add", newPlaybookAction.value);
            showConfigurationEditor.value = false;
            newPlaybookAction.value = {};
            Object.assign(configuration, {});
        }

        /**
         * Computed
         */
        const valid = computed(() => {
            return newPlaybookAction.value.action_class_name != null;
        });

        const classDefinition = computed(() => {
            return classes.value.find(
                (item) =>
                    item.className == newPlaybookAction.value.action_class_name
            );
        });

        fetchClassList();

        return {
            newPlaybookAction,
            classes,
            onSubmit,
            onConfigurationFormSubmit,
            valid,
            classDefinition,
            configuration,
            loaded,
            showConfigurationEditor,
        };
    },
};
</script>