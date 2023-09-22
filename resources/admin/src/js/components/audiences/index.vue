<template>
  <div>
    <h2>Available Audiences</h2>
    <table class="table" v-if="loaded && audiencesSorted.length">
      <list-item
        v-for="className in audiencesSorted"
        :key="className"
        :class-name="className"
      ></list-item>
    </table>
    <p v-else-if="loaded">There are no audiences.</p>
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
  name: "Audiences",
  components: {
    ListItem,
  },
  setup(props, { emit }) {
    const router = useRouter();
    const $cookies = inject("$cookies");

    /**
     * Reactive Properties
     */
    const audiences = ref([]);
    const loaded = ref(false);

    /**
     * Methods
     */
    async function fetchAudienceList() {
      const response = await fetch("/api/lp-audiences", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
        },
      });
      const json = await response.json();
      audiences.value = json.data;
      loaded.value = true;
    }

    fetchAudienceList();

    /**
     * Updated
     */
    const audiencesSorted = computed(() => {
      return _sortBy(audiences.value || [], (className) => {
        return className;
      });
    });

    return {
      audiencesSorted,
      loaded,
    };
  },
};
</script>

<style></style>
