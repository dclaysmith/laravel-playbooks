<template>
  <input
    type="text"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    v-bind="definition.attributes"
  />
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "ActionConfigurationFormText",
  components: {},
  emits: [],
  props: ["definition", "modelValue"],
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    return {};
  },
};
</script>
