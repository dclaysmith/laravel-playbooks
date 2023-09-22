<template>
  <div class="card mb-2">
    <div class="card-header">
      <form @submit.prevent="onSubmit">
        <fieldset>
          <div class="form-group form-inline">
            <label class="form-label" for="name">Step Name</label>
            <input class="form-input" type="text" v-model="playbookStep.name" />
          </div>
        </fieldset>
      </form>
    </div>
    <div class="card-body">
      <p v-if="playbookStep.condition_class_name">
        Condition: "{{ playbookStep.condition_class_name }}"
      </p>
      <playbook-actions
        :playbook-step="playbookStep"
        :playbook-actions="playbookActions"
        @add-action="$emit('add-action', $event)"
        @delete-action="$emit('delete-action', $event)"
        @update-action="$emit('update-action', $event)"
      ></playbook-actions>
    </div>
    <div class="card-footer">
      <button @click.prevent="onDeleteClick" class="btn btn-error">
        Delete Step
      </button>
    </div>
  </div>
</template>

<script>
import { ref, computed, inject, watch } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useDebounceFn } from "../../../../composables/useDebounce.js";

import PlaybookActions from "./actions/index.vue";

export default {
  name: "StepsListItem",
  props: ["playbookStep", "playbookActions"],
  emits: ["add-action", "delete-step", "delete-action"],
  components: { PlaybookActions },
  setup(props, { emit }) {
    function onDeleteClick() {
      emit("delete-step", props.playbookStep.id);
    }

    const updateStep = useDebounceFn(async (playbookStep) => {
      const response = await fetch(
        "/api/lp-playbook-steps/" + playbookStep.id,
        {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
          },
          method: "PUT",
          body: JSON.stringify(playbookStep),
        },
      );

      const json = await response.json();

      if (!response.ok) {
        notify({
          title: json.message,
          type: "error",
        });
        return;
      }

      notify({
        title: "Playbook step updated.",
        type: "success",
      });
    }, 1000);

    /**
     * Watch
     */
    watch(props.playbookStep, updateStep, { deep: true });

    return { onDeleteClick };
  },
};
</script>

<style scoped></style>
