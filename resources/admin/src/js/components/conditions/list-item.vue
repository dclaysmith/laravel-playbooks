<template>
  <tr>
    <td>
      {{ className }}
    </td>
  </tr>
</template>

<script>
import { ref } from "vue";

export default {
  name: "ConditionListItem",
  props: ["className"],
  setup(props, { emit }) {
    return {};
  },
};
</script>

<style></style>
