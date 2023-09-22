<template>
  <div>
    <add-form
      @add="$emit('add-action', $event)"
      :playbook-step="playbookStep"
    ></add-form>
    <action-table
      :playbook-actions="playbookActionsSorted"
      @delete-action="$emit('delete-action', $event)"
      @update-action="$emit('update-action', $event)"
    ></action-table>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import AddForm from "./add-form/index.vue";
import ActionTable from "./action-table/index.vue";

export default {
  name: "WithoutCondition",
  props: ["playbookStep", "playbookActions"],
  components: { AddForm, ActionTable },
  emits: ["add-action", "delete-action", "update-action"],
  setup(props, { emit }) {
    /**
     * Computed
     */
    const playbookActionsSorted = computed(() => {
      if (!props.playbookActions) {
        return [];
      }
      return _sortBy(props.playbookActions || [], (playbookAction) => {
        return playbookAction.sort_order;
      });
    });

    return { playbookActionsSorted };
  },
};
</script>

<style></style>
