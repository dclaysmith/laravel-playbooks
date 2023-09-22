<template>
  <div class="form-group mx-2">
    <label class="form-label" for="name">{{ definition.label }}</label>
    <component
      :is="componentType"
      :definition="definition"
      v-model="configuration"
      @update:modelValue="$emit('update:modelValue', $event)"
    ></component>
  </div>
</template>

<script>
import { ref, computed } from "vue";

import InputCheckbox from "./input-checkbox.vue";
import InputSelect from "./input-select.vue";
import InputText from "./input-text.vue";
import InputNumber from "./input-number.vue";
import InputRadio from "./input-radio.vue";
import InputTextarea from "./input-textarea.vue";

export default {
  name: "ActionConfigurationFormItem",
  components: {
    InputCheckbox,
    InputRadio,
    InputNumber,
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
