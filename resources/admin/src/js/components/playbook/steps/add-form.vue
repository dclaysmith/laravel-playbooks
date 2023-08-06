<template>
    <form @submit.prevent="onSubmit">
        <fieldset>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="name">Name</label>
                <input
                    class="form-input"
                    name="name"
                    id="name"
                    v-model.number="newPlaybookStep.name"
                />
            </div>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="condition_class_name"
                    >Condition</label
                >
                <select
                    class="form-select"
                    name="condition_class_name"
                    id="condition_class_name"
                    v-model.number="newPlaybookStep.condition_class_name"
                    v-if="loaded"
                >
                    <option></option>
                    <option
                        v-for="className in classes"
                        :key="className"
                        :value="className"
                    >
                        {{ className }}
                    </option>
                </select>
                <p v-else>Loading...</p>
            </div>
            <button
                class="btn btn-primary mx-2"
                :class="{ loading: submitting }"
                :disabled="!valid"
            >
                Add Step
            </button>
        </fieldset>
    </form>
</template>


<script>
import { ref, computed } from "vue";

export default {
    name: "StepAddForm",
    components: {},
    emits: ["add"],
    props: ["submitting"],
    setup(props, { emit }) {
        const newPlaybookStep = ref({});
        const classes = ref([]);
        const loaded = ref(false);

        async function fetchClassList() {
            const response = await fetch("/api/lp-conditions");
            const json = await response.json();
            classes.value = json.data;
            loaded.value = true;
        }

        async function onSubmit() {
            if (!this.valid) {
                return;
            }
            emit("add", newPlaybookStep.value);
            newPlaybookStep.value = {};
        }

        /**
         * Updated
         */
        const valid = computed(() => {
            return newPlaybookStep.value.name != null;
        });

        fetchClassList();

        return { newPlaybookStep, classes, onSubmit, valid, loaded };
    },
};
</script>