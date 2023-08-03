<template>
    <tr>
        <td>{{ trigger.id }}</td>
        <td>
            {{ trigger.class_name }}
        </td>
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
export default {
    name: "TriggersListItem",
    props: ["trigger"],
    setup(props, { emit }) {
        async function onDeleteClick() {
            emit("delete", props.trigger.id);
        }

        return { onDeleteClick };
    },
};
</script>

<style scoped>
</style>