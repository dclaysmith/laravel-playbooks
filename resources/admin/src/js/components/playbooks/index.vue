<template>
  <div>
    <h2>Add Playbook</h2>
    <add-form @add="onAdd"></add-form>
    <h2>Existing Playbooks</h2>
    <table class="table" v-if="loaded && playbooksSorted.length">
      <list-item
        v-for="playbook in playbooksSorted"
        :key="playbook.id"
        :playbook="playbook"
        @delete="onDelete"
      ></list-item>
    </table>
    <p v-else-if="loaded">There are no playbooks.</p>
    <p v-else>Loading...</p>
  </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { useRouter } from "vue-router";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";
import AddForm from "./add-form.vue";

export default {
  name: "Playbooks",
  components: {
    ListItem,
    AddForm,
  },
  setup(props, { emit }) {
    const router = useRouter();
    const $cookies = inject("$cookies");

    /**
     * Reactive Properties
     */
    const playbooks = ref([]);
    const loaded = ref(false);

    /**
     * Methods
     */
    async function fetchPlaybookList() {
      const response = await fetch("/api/lp-playbooks");
      const json = await response.json();
      playbooks.value = json.data;
      loaded.value = true;
    }

    async function onAdd(playbook) {
      const response = await fetch("/api/lp-playbooks", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
        },
        method: "POST",
        body: JSON.stringify(playbook),
      });

      const json = await response.json();

      if (!response.ok) {
        notify({
          title: json.message,
          type: "error",
        });
        return;
      }

      playbooks.value.push(json.data);

      notify({
        title: "New playbook created.",
        type: "success",
      });

      router.push("/playbooks/" + json.data.id);
    }

    async function onDelete(id) {
      const response = await fetch("/api/lp-playbooks/" + id, {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
        },
        method: "DELETE",
      });
      if (!response.ok) {
        notify({
          title: json.message,
          type: "error",
        });
        return;
      }

      notify({
        title: "Playbook deleted.",
        type: "warn",
      });

      var indexToRemove = playbooks.value.map((item) => item.id).indexOf(id);
      ~indexToRemove && playbooks.value.splice(indexToRemove, 1);
    }

    fetchPlaybookList();

    /**
     * Updated
     */
    const playbooksSorted = computed(() => {
      return _sortBy(playbooks.value || [], (playbook) => {
        return playbook.name;
      });
    });

    return {
      playbooksSorted,
      loaded,
      onAdd,
      onDelete,
    };
  },
};
</script>

<style></style>
