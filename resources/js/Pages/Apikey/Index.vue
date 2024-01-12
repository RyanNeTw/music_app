<script setup>
import { ref } from "vue";

const props = defineProps({
    apikeys: Array,
});

const apiKeys = ref(props.apikeys);
</script>

<template>
    <Head title="ApiKeys" />
    <HeaderLayout>
        <template #title> ApiKeys </template>
        <template #action>
                <h1>hello</h1>
        </template>
        <template #content>
            <div>
                <h1>Hello</h1>
            </div>
        </template>
    </HeaderLayout>
</template>
