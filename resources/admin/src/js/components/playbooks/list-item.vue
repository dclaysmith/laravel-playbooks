<template>
  <tr>
    <td>{{ playbook.id }}</td>
    <td>
      <router-link :to="'/playbooks/' + playbook.id">{{
        playbook.name
      }}</router-link>
    </td>
    <td>{{ playbook.identifier }}</td>
    <td>
      <button @click.prevent="onDeleteClick" class="btn btn-link text-error">
        Delete
      </button>
    </td>
  </tr>
</template>

<script>
import { ref } from "vue";

export default {
  name: "PlaybooksListItem",
  props: ["playbook"],
  emits: ["delete"],
  setup(props, { emit }) {
    async function onDeleteClick() {
      emit("delete", props.playbook.id);
    }

    return { onDeleteClick };
  },
};
</script>

<style></style>
