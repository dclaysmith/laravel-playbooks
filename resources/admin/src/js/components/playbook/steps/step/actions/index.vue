<template>
  <component
    :is="componentName"
    :playbook-step="playbookStep"
    :playbook-actions="playbookActions"
  ></component>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";

import WithCondition from "./with-condition.vue";
import WithoutCondition from "./without-condition.vue";

export default {
  name: "Actions",
  components: { WithCondition, WithoutCondition },
  props: ["playbookStep", "playbookActions"],
  setup(props, { emit }) {
    /**
     * Reactive Properties
     */
    const $cookies = inject("$cookies");

    /**
     * Methods
     */

    /**
     * Computed
     */
    const componentName = computed(() => {
      return props.playbookStep.condition_class_name
        ? "WithCondition"
        : "WithoutCondition";
    });

    return {
      componentName,
    };
  },
};
</script>
