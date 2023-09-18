<template>
    <div class="form-group mx-2">
        <label class="form-label" for="name">{{ definition.label }}</label>
        <component
            :is="componentType"
            :definition="definition"
            v-model="configuration[definition.key]"
        ></component>
    </div>
</template>

<script>
import { ref, computed } from "vue";

import InputCheckbox from "../../../add-form/configuration-form/input-checkbox.vue";
import InputSelect from "../../../add-form/configuration-form/input-select.vue";
import InputText from "../../../add-form/configuration-form/input-text.vue";
import InputRadio from "../../../add-form/configuration-form/input-radio.vue";
import InputTextarea from "../../../add-form/configuration-form/input-textarea.vue";

export default {
    name: "ActionEditFormConfiguration",
    components: {
        InputCheckbox,
        InputRadio,
        InputText,
        InputTextarea,
        InputSelect,
    },
    emits: ["update:modelValue"],
    props: ["modelValue", "definition"],
    setup(props, { emit }) {
        const configuration = ref(props.modelValue);
        const componentType = computed(() => {
            return "input-" + props.definition.type;
        });
        return { componentType, configuration };
    },
};
</script>