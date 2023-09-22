<template>
  <select
    class="form-select"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    :required="definition.required"
    v-bind="definition.attributes"
  >
    <option
      v-for="(item, index) in options"
      :key="item.value"
      :value="item.value"
    >
      {{ item.label }}
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
