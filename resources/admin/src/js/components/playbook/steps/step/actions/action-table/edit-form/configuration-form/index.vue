<template>
  <fieldset>
    <form-item
      v-for="(item, key) in definition"
      :definition="item"
      v-model="configuration[item.key]"
    ></form-item>
  </fieldset>
</template>

<script>
import { ref, computed } from "vue";

import FormItem from "../../../add-form/configuration-form/form-item.vue";

export default {
  name: "ActionEditFormConfiguration",
  components: { FormItem },
  emits: ["update-configuration", "update:modelValue"],
  props: ["modelValue", "definition", "visible"],
  setup(props, { emit }) {
    const submitting = ref(false);
    const valid = ref(true);
    const configuration = ref(props.modelValue);
    function close() {
      emit("update:visible", false);
    }
    return { configuration, submitting, valid, close };
  },
};
</script>
