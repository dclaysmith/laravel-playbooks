<template>
  <div>
    <h2>Available Conditions</h2>
    <table class="table" v-if="loaded && conditionsSorted.length">
      <list-item
        v-for="className in conditionsSorted"
        :key="className"
        :class-name="className"
      ></list-item>
    </table>
    <p v-else-if="loaded">There are no conditions.</p>
    <p v-else>Loading...</p>
  </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useRouter } from "vue-router";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";

export default {
  name: "Conditions",
  components: {
    ListItem,
  },
  setup(props, { emit }) {
    const router = useRouter();

    /**
     * Reactive Properties
     */
    const conditions = ref([]);
    const loaded = ref(false);

    /**
     * Methods
     */
    async function fetchConditionList() {
      const response = await fetch("/api/lp-conditions", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
        },
      });
      const json = await response.json();
      conditions.value = json.data;
      loaded.value = true;
    }

    fetchConditionList();

    /**
     * Computed
     */
    const conditionsSorted = computed(() => {
      return _sortBy(conditions.value || [], (className) => {
        return className;
      });
    });

    return {
      conditionsSorted,
      loaded,
    };
  },
};
</script>

<style></style>
