<template>
  <label class="form-radio" v-for="(label, value) in options" :key="value">
    <input
      :name="definition.key"
      type="radio"
      :value="value"
      v-model="selected"
      v-bind="definition.attributes"
    />
    <i class="form-icon"></i> {{ label }}
  </label>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
  name: "ActionConfigurationFormRadio",
  components: {},
  emits: [],
  props: ["definition", "modelValue"],
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    const selected = ref(props.modelValue);

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
      { deep: true },
    );

    return { options, selected };
  },
};
</script>
