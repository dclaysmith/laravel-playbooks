<template>
  <tr>
    <td>{{ item }}</td>
  </tr>
</template>

<script>
import { ref } from "vue";

export default {
  name: "AudienceDataListItem",
  props: ["item"],
  setup(props, { emit }) {
    return {};
  },
};
</script>

<style></style>
