<template>
    <label class="form-radio" v-for="(label, value) in options" :key="value">
        <input type="radio" v-model="selected" :value="value" />
        <i class="form-icon"></i> {{ label }}
    </label>
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "ActionConfigurationFormRadio",
    components: {},
    emits: [],
    props: ["definition", "modelValue"],
    emits: ["update:modelValue"],
    setup(props, { emit }) {
        const selected = ref([]);
        const options = computed(() => {
            return props.definition?.options;
        });
        return { options, selected };
    },
};
</script>