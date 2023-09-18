<template>
    <template v-for="(label, value) in options" :key="value">
        <label class="form-checkbox">
            <input
                type="checkbox"
                :value="value"
                v-model="selected"
                v-bind="definition.attributes"
            />
            <i class="form-icon"></i> {{ label }}
        </label>
    </template>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
    name: "ActionConfigurationFormCheckbox",
    components: {},
    emits: ["update:modelValue"],
    props: ["definition", "modelValue"],
    setup(props, { emit }) {
        const selected = ref(props.modelValue || []);

        const options = computed(() => {
            return props.definition?.options;
        });

        /**
         * Watch
         */
        watch(
            selected,
            (newValue, oldValue) => {
                emit("update:modelValue", newValue);
            },
            { deep: true }
        );

        return { options, selected };
    },
};
</script>