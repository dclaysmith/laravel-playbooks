<template>
  <tr>
    <td>{{ audience.id }}</td>
    <td>
      {{ audience.class_name }}
    </td>
    <td>
      {{ audience.exit_action }}
    </td>
    <td>
      <button @click.prevent="onDeleteClick" class="btn btn-link text-error">
        Delete
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  name: "AudiencesListItem",
  props: ["audience"],
  setup(props, { emit }) {
    async function onDeleteClick() {
      emit("delete", props.audience.id);
    }

    return { onDeleteClick };
  },
};
</script>

<style scoped></style>
