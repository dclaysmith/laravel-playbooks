<template>
    <tr>
        <td>
            <router-link :to="'/triggers/' + encodeURIComponent(className)">{{
                className
            }}</router-link>
        </td>
    </tr>
</template>

<script>
import { ref } from "vue";

export default {
    name: "TriggerListItem",
    props: ["className"],
    setup(props, { emit }) {
        return {};
    },
};
</script>

<style>
</style>