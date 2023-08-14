<template>
    <div class="card mb-2">
        <div class="card-header">{{ playbookStep.name }}</div>
        <div class="card-body">
            <p v-if="playbookStep.condition_class_name">
                IF {{ playbookStep.condition_class_name }} is TRUE...
            </p>
            <playbook-actions :playbook-step="playbookStep"></playbook-actions>
        </div>
        <div class="card-footer">
            <button @click.prevent="onDeleteClick" class="btn btn-error">
                Delete
            </button>
        </div>
    </div>
</template>

<script>
import PlaybookActions from "./actions/index.vue";

export default {
    name: "StepsListItem",
    props: ["playbookStep"],
    components: { PlaybookActions },
    setup(props, { emit }) {
        async function onDeleteClick() {
            emit("delete", props.playbookStep.id);
        }

        return { onDeleteClick };
    },
};
</script>

<style scoped>
</style>