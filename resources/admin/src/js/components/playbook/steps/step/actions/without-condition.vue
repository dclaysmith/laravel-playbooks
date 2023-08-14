<template>
    <div>
        <add-form @add="onAdd"></add-form>
    </div>
</template>

<script>
import { ref } from "vue";
import AddForm from "./add-form.vue";

export default {
    name: "WithoutCondition",
    props: ["playbookStep", "playbookActions"],
    components: { AddForm },
    setup(props, { emit }) {
        async function onAdd(playbookAction) {
            playbookAction.lp_playbook_id = props.playbookStep.lp_playbook_id;
            submitting.value = true;
            const response = await fetch("/api/lp-playbook-actions", {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": $cookies.get("XSRF-TOKEN"),
                },
                method: "POST",
                body: JSON.stringify(playbookAction),
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
                title: "New playbook action added.",
                type: "success",
            });

            playbookActions.value.push(
                Object.assign(playbookAction, json.data)
            );
        }
        return { onAdd };
    },
};
</script>

<style>
</style>