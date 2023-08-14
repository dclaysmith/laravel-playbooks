<template>
    <form @submit.prevent="onSubmit">
        <fieldset>
            <div class="form-group form-inline mx-2">
                <label class="form-label" for="name">Action</label>
                <select
                    class="form-input"
                    name="name"
                    id="name"
                    v-model.number="newPlaybookAction.name"
                ></select>
            </div>
            <button
                class="btn btn-primary mx-2"
                :class="{ loading: submitting }"
                :disabled="!valid"
            >
                Add Action
            </button>
        </fieldset>
    </form>
</template>


<script>
import { ref, computed } from "vue";

export default {
    name: "ActionAddForm",
    components: {},
    emits: ["add"],
    props: ["submitting"],
    setup(props, { emit }) {
        const newPlaybookAction = ref({});
        const classes = ref([]);
        const loaded = ref(false);

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
            emit("add", newPlaybookAction.value);
            newPlaybookAction.value = {};
        }

        /**
         * Updated
         */
        const valid = computed(() => {
            return newPlaybookAction.value.name != null;
        });

        fetchClassList();

        return { newPlaybookAction, classes, onSubmit, valid, loaded };
    },
};
</script>