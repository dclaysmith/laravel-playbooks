<template>
    <input
        type="number"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        v-bind="definition.attributes"
    />
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "ActionConfigurationFormNum ber",
    components: {},
    emits: [],
    props: ["definition", "modelValue"],
    emits: ["update:modelValue"],
    setup(props, { emit }) {
        return {};
    },
};
</script>
