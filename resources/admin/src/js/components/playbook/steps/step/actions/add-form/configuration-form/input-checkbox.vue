<template>
    <template v-for="(label, value) in options" :key="value">
        <label class="form-radio">
            <input type="checkbox" v-model="selected" />
            <i class="form-icon"></i> {{ label }}
        </label>
    </template>
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "ActionConfigurationFormCheckbox",
    components: {},
    emits: ["update:modelValue"],
    props: ["definition", "modelValue"],
    setup(props, { emit }) {
        const selected = ref([]);
        const options = computed(() => {
            return props.definition?.options;
        });
        return { options, selected };
    },
};
</script>