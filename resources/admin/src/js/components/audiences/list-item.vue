<template>
    <tr>
        <td>
            <router-link :to="'/audiences/' + encodeURIComponent(className)">{{
                className
            }}</router-link>
        </td>
    </tr>
</template>

<script>
import { ref } from "vue";

export default {
    name: "AudienceListItem",
    props: ["className"],
    setup(props, { emit }) {
        return {};
    },
};
</script>

<style>
</style>