<template>
    <form @submit.prevent="onSubmit">
        <fieldset>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="class_name">Trigger</label>
                <select
                    class="form-select"
                    name="class_name"
                    id="class_name"
                    v-model.number="newPlaybookTrigger.class_name"
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
                Add Trigger
            </button>
        </fieldset>
    </form>
</template>


<script>
import { ref, computed } from "vue";

export default {
    name: "TriggerAddForm",
    components: {},
    emits: ["add"],
    props: ["submitting"],
    setup(props, { emit }) {
        const newPlaybookTrigger = ref({});
        const classes = ref([]);
        const loaded = ref(false);

        async function fetchClassList() {
            const response = await fetch("/api/lp-triggers");
            const json = await response.json();
            classes.value = json.data;
            loaded.value = true;
        }

        async function onSubmit() {
            if (!this.valid) {
                return;
            }
            emit("add", newPlaybookTrigger.value);
            newPlaybookTrigger.value = {};
        }

        /**
         * Updated
         */
        const valid = computed(() => {
            return newPlaybookTrigger.value.class_name != null;
        });

        fetchClassList();

        return { newPlaybookTrigger, classes, onSubmit, valid, loaded };
    },
};
</script>