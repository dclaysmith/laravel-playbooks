<template>
    <div class="card mb-2">
        <div class="card-header">{{ step.name }}</div>
        <div class="card-body">
            <p>If... {{ step.condition_class_name }}</p>
            <playbook-actions :playbook-step="step"></playbook-actions>
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
    props: ["step"],
    components: { PlaybookActions },
    setup(props, { emit }) {
        async function onDeleteClick() {
            emit("delete", props.step.id);
        }

        return { onDeleteClick };
    },
};
</script>

<style scoped>
</style>