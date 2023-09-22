<template>
  <div>
    <p>If True...</p>

    <add-form
      @add="$emit('add-action', $event)"
      :playbook-step="playbookStep"
      :case="'true'"
    ></add-form>
    <action-table
      :playbook-actions="trueActions"
      @delete-action="$emit('delete-action', $event)"
      @update-action="$emit('update-action', $event)"
    ></action-table>

    <p>If False...</p>

    <add-form
      @add="$emit('add-action', $event)"
      :playbook-step="playbookStep"
      :case="'false'"
    ></add-form>
    <action-table
      :playbook-actions="falseActions"
      @delete-action="$emit('delete-action', $event)"
      @update-action="$emit('update-action', $event)"
    ></action-table>

    <p>And then...</p>

    <add-form
      @add="$emit('add-action', $event)"
      :playbook-step="playbookStep"
      :case="'finally'"
    ></add-form>
    <action-table
      :playbook-actions="finallyActions"
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
  name: "WithCondition",
  props: ["playbookStep", "playbookActions"],
  components: { AddForm, ActionTable },
  setup(props, { emit }) {
    /**
     * Computed
     */
    const trueActions = computed(() => {
      return props.playbookActions
        .filter((item) => {
          return item.case == "true";
        })
        .sort((a, b) => {
          return a.sort_order < b.sort_order;
        });
    });
    const falseActions = computed(() => {
      return props.playbookActions
        .filter((item) => {
          return item.case == "false";
        })
        .sort((a, b) => {
          return a.sort_order < b.sort_order;
        });
      return [];
    });
    const finallyActions = computed(() => {
      return props.playbookActions
        .filter((item) => {
          return item.case == "finally";
        })
        .sort((a, b) => {
          return a.sort_order < b.sort_order;
        });
    });

    return { trueActions, falseActions, finallyActions };
  },
};
</script>

<style></style>
