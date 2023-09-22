<template>
  <form @submit.prevent="onSubmit">
    <fieldset>
      <div class="form-group form-inline mx-2">
        <label class="form-label" for="class_name">Audience</label>
        <select
          class="form-select"
          name="class_name"
          id="class_name"
          v-model.number="newPlaybookAudience.class_name"
          v-if="loaded"
        >
          <option
            v-for="className in classes"
            :key="className"
            :value="className"
          >
            {{ className }}
          </option>
        </select>
        <p v-else>Loading...</p>
      </div>
      <div class="form-group form-inline mx-2">
        <label class="form-label" for="exit_action"
          >When no longer in audience...</label
        >
        <select
          class="form-select"
          name="exit_action"
          id="exit_action"
          v-model.number="newPlaybookAudience.exit_action"
          v-if="loaded"
        >
          <option value="CONTINUE">continue playbook</option>
          <option value="CANCEL">cancel playbook</option>
        </select>
      </div>
      <button
        class="btn btn-primary mx-2"
        :class="{ loading: submitting }"
        :disabled="!valid"
      >
        Add Audience
      </button>
    </fieldset>
  </form>
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "AudienceAddForm",
  components: {},
  emits: ["add"],
  props: ["submitting"],
  setup(props, { emit }) {
    const newPlaybookAudience = ref({});
    const classes = ref([]);
    const loaded = ref(false);

    async function fetchClassList() {
      const response = await fetch("/api/lp-audiences");
      const json = await response.json();
      classes.value = json.data;
      loaded.value = true;
    }

    async function onSubmit() {
      if (!this.valid) {
        return;
      }
      emit("add", newPlaybookAudience.value);
      newPlaybookAudience.value = {};
    }

    /**
     * Updated
     */
    const valid = computed(() => {
      return newPlaybookAudience.value.class_name != null;
    });

    fetchClassList();

    return { newPlaybookAudience, classes, onSubmit, valid, loaded };
  },
};
</script>
