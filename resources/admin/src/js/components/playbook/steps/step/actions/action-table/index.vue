<template>
  <table class="table">
    <tfoot v-if="playbookActionsClone.length == 0">
      <tr>
        <td>No actions yet.</td>
      </tr>
    </tfoot>
    <draggable
      v-else
      tag="tbody"
      v-model="playbookActionsClone"
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
import { ref, computed, inject, watch } from "vue";
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
    const playbookActionsClone = ref(props.playbookActions);

    /**
     * Methods
     */
    async function onChange(e) {
      playbookActionsClone.value.forEach((playbookAction, index) => {
        let match = props.playbookActions.find(item => {
          return item.id = playbookAction.id;
        })
        playbookAction.sort_order = index;
      });
    }

    /**
     * Computed
     */


    /**
     * Watch
     */
    watch(
      props.playbookActions,
      (newValue, oldValue) => {
        console.log('...changed 1');
        playbookActionsClone.value = props.playbookActions;
      },
      { deep: true },
    );

    watch(
      playbookActionsClone.value,
      (newValue, oldValue) => {
        console.log('...changed 2');
      },
      { deep: true },
    );

    return { onChange, playbookActionsClone };
  },
};
</script>

<style></style>
