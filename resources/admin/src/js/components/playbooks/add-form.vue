<template>
  <form @submit.prevent="onSubmit">
    <fieldset>
      <div class="form-group form-inline mx-2">
        <label class="form-label" for="name">Name</label>
        <input
          class="form-input"
          type="text"
          name="name"
          id="name"
          v-model="newPlaybook.name"
        />
      </div>
      <button class="btn btn-primary mx-2" :disabled="!valid">
        Add Playbook
      </button>
    </fieldset>
  </form>
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "PlaybookAddForm",
  components: {},
  emits: ["add"],
  setup(props, { emit }) {
    const newPlaybook = ref({});

    async function onSubmit() {
      if (!this.valid) {
        return;
      }
      emit("add", newPlaybook.value);
      newPlaybook.value = {};
    }

    /**
     * Updated
     */
    const valid = computed(() => {
      return newPlaybook.value.name != null;
    });

    return { newPlaybook, onSubmit, valid };
  },
};
</script>
