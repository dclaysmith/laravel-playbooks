<template>
  <table class="table">
    <tfoot v-if="playbookActions.length == 0">
      <tr>
        <td>No actions yet.</td>
      </tr>
    </tfoot>
    <draggable
      v-else
      tag="tbody"
      v-model="playbookActions"
      @start="drag = true"
      @end="drag = false"
      item-key="id"
      @change="onChange"
    >
      <template #item="{ element: playbookAction }">
        <list-item
          class="drag-item"
          :playbook-action="playbookAction"
          @delete-action="$emit('delete-action', $event)"
          @update-action="$emit('update-action', $event)"
        ></list-item
      ></template>
    </draggable>
  </table>
</template>

<script>
import { ref, computed, inject } from "vue";
import { sortBy as _sortBy } from "lodash";
import draggable from "vuedraggable";

import ListItem from "./list-item.vue";

export default {
  name: "PlaybookActionTable",
  props: ["playbookActions"],
  emits: ["delete-action", "update-action"],
  components: {
    ListItem,
    draggable,
  },
  setup(props, { emit }) {
    /**
     * Reactive Properties
     */

    /**
     * Methods
     */
    async function onChange(e) {
      props.playbookActions.forEach((playbookAction, index) => {
        playbookAction.sort_order = index;
      });
    }

    /**
     * Computed
     */

    return { onChange };
  },
};
</script>

<style></style>
