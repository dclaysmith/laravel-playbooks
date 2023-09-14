<template>
    <select
        class="form-select"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :required="definition.required"
    >
        <option v-for="(label, value) in options" :key="value" :value="value">
            {{ label }}
        </option>
    </select>
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "ActionConfigurationFormSelect",
    components: {},
    emits: [],
    props: ["definition", "modelValue"],
    emits: ["update:modelValue"],
    setup(props, { emit }) {
        const options = computed(() => {
            return props.definition?.options;
        });
        return { options };
    },
};
</script>