<template>
    <tr>
        <td>{{ template.id }}</td>
        <td>
            <router-link :to="'/templates/' + template.id">{{
                template.name
            }}</router-link>
        </td>
        <td>{{ template.identifier }}</td>
        <td>
            <button
                @click.prevent="onDeleteClick"
                class="btn btn-link text-error"
            >
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
import { ref } from "vue";

export default {
    name: "LaravelPlaybooksAdminTemplatesListItem",
    props: ["template"],
    emits: ["delete"],
    setup(props, { emit }) {
        async function onDeleteClick() {
            emit("delete", props.template.id);
        }

        return { onDeleteClick };
    },
};
</script>

<style>
</style>