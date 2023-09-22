<template>
  <div class="modal" :class="{ active: visible }" id="modal-id">
    <a
      href="#close"
      @click.prevent="close"
      class="modal-overlay"
      aria-label="Close"
    ></a>
    <div class="modal-container">
      <div class="modal-header">
        <a
          href="#close"
          @click.prevent="close"
          class="btn btn-clear float-right"
          aria-label="Close"
        ></a>
        <div class="modal-title h5">Configure Action</div>
      </div>
      <div class="modal-body">
        <div class="content">
          <form @submit.prevent="onSubmit">
            <fieldset>
              <form-item
                v-for="(item, key) in definition"
                :definition="item"
                v-model="configuration[item.key]"
              ></form-item>
              <button
                class="btn btn-primary mx-2"
                :class="{ loading: submitting }"
                :disabled="!valid"
              >
                Save Configuration
              </button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="modal-footer">...</div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";

import FormItem from "./form-item.vue";

export default {
  name: "ActionAddFormConfiguration",
  components: { FormItem },
  emits: ["update-configuration", "update:modelValue"],
  props: ["modelValue", "definition", "visible"],
  setup(props, { emit }) {
    const submitting = ref(false);
    const valid = ref(true);
    const configuration = ref(props.modelValue);
    async function onSubmit() {
      emit("update-configuration", configuration);
    }
    function close() {
      emit("update:visible", false);
    }
    return { onSubmit, configuration, submitting, valid, close };
  },
};
</script>
