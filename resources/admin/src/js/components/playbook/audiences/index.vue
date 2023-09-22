<template>
  <div>
    <add-form @add="onAdd"></add-form>
    <table class="table" v-if="loaded && audiencesSorted.length">
      <tr>
        <th>Id</th>
        <th colspan="1">Audience</th>
        <th colspan="2">Exit Action</th>
      </tr>
      <list-item
        v-for="audience in audiencesSorted"
        :key="audience.id"
        :audience="audience"
        @delete="onDelete"
      ></list-item>
    </table>
    <p v-else-if="loaded">There are no audiences.</p>
    <p v-else>Loading...</p>
  </div>
</template>

<script>
import { ref, computed, inject } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy } from "lodash";

import ListItem from "./list-item.vue";
import AddForm from "./add-form.vue";

export default {
  name: "Audiences",
  components: {
    ListItem,
    AddForm,
  },
  props: ["playbook"],
  setup(props, { emit }) {
    /**
     * Reactive Properties
     */
    const playbookAudiences = ref([]);
    const loaded = ref(false);
    const submitting = ref(false);
    const $cookies = inject("$cookies");

    /**
     * Methods
     */
    async function fetchPlaybookAudienceList() {
      const response = await fetch(
        "/api/lp-playbook-audiences?lp_playbooks=" + props.playbook.id,
      );
      const json = await response.json();
      playbookAudiences.value = json.data;
      loaded.value = true;
    }

    async function onAdd(playbookAudience) {
      playbookAudience.lp_playbook_id = props.playbook.id;
      submitting.value = true;
      const response = await fetch("/api/lp-playbook-audiences", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
        },
        method: "POST",
        body: JSON.stringify(playbookAudience),
      });
      submitting.value = false;

      const json = await response.json();

      if (!response.ok) {
        notify({
          title: json.message,
          type: "error",
        });
        return;
      }

      notify({
        title: "New playbook audience added.",
        type: "success",
      });

      playbookAudiences.value.push(Object.assign(playbookAudience, json.data));
    }

    async function onDelete(id) {
      const response = await fetch("/api/lp-playbook-audiences/" + id, {
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
        title: "Audience deleted.",
        type: "warn",
      });

      var indexToRemove = playbookAudiences.value
        .map((item) => item.id)
        .indexOf(id);
      ~indexToRemove && playbookAudiences.value.splice(indexToRemove, 1);
    }

    fetchPlaybookAudienceList();

    /**
     * Updated
     */
    const audiencesSorted = computed(() => {
      return _sortBy(playbookAudiences.value || [], (audience) => {
        return playbookAudiences.class_name;
      });
    });

    return {
      audiencesSorted,
      loaded,
      onAdd,
      onDelete,
    };
  },
};
</script>

<style></style>
