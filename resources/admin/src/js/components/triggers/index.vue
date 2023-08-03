<template>
    <div>
        <h2>Available Triggers</h2>
        <table class="table" v-if="loaded && triggersSorted.length">
            <list-item
                v-for="className in triggersSorted"
                :key="className"
                :class-name="className"
            ></list-item>
        </table>
        <p v-else-if="loaded">There are no triggers.</p>
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
    name: "Triggers",
    components: {
        ListItem,
    },
    setup(props, { emit }) {
        const router = useRouter();
        const $cookies = inject("$cookies");

        /**
         * Reactive Properties
         */
        const triggers = ref([]);
        const loaded = ref(false);

        /**
         * Methods
         */
        async function fetchTriggerList() {
            const response = await fetch("/api/lp-triggers");
            const json = await response.json();
            triggers.value = json.data;
            loaded.value = true;
        }

        fetchTriggerList();

        /**
         * Updated
         */
        const triggersSorted = computed(() => {
            return _sortBy(triggers.value || [], (className) => {
                return className;
            });
        });

        return {
            triggersSorted,
            loaded,
        };
    },
};
</script>

<style>
</style>