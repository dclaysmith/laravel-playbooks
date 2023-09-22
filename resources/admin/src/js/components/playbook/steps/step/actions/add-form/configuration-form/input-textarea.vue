<template>
  <textarea
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    :required="definition.required"
    v-bind="definition.attributes"
  />
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "ActionConfigurationFormTextarea",
  components: {},
  emits: [],
  props: ["definition", "modelValue"],
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    return {};
  },
};
</script>
