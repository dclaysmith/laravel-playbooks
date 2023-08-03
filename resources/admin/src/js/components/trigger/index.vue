<template>
    <div>
        <p><router-link to="/triggers">&lt; Back</router-link></p>
        <h2>Preview Trigger</h2>
        <table class="table" v-if="loaded && results.length">
            <list-item
                v-for="result in results"
                :key="result.id"
                :item="result"
            ></list-item>
        </table>
        <p v-else-if="loaded">There are no playbooks.</p>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
import { ref, computed, watch } from "vue";
import { notify } from "@kyvg/vue3-notification";
import { sortBy as _sortBy, filter as _filter, chain as _chain } from "lodash";
import ListItem from "./list-item.vue";

export default {
    name: "Trigger",
    components: { ListItem },
    props: ["className"],
    setup(props) {
        /**
         * Reactive Properties
         */
        const results = ref([]);
        const loaded = ref(false);

        /**
         * Methods
         */
        async function fetchResults() {
            const response = await fetch(
                "/api/lp-trigger-data?class_name=" +
                    encodeURIComponent(props.className)
            );
            loaded.value = true;
            const json = await response.json();
            results.value = json.data;
        }

        fetchResults();

        /**
         * Computed
         */

        return {
            results,
            loaded,
        };
    },
};
</script>

<style>
</style>