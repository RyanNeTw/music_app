<script setup>
import { Head } from "@inertiajs/vue3";
defineProps({});
</script>

<template>
    <Head title="Add track" />
    <MusicLayout>
        <template #title> Add a track </template>
        <template #action>
            <Link :href="route('tracks.create')">Créer</Link>
        </template>
        <template #content> </template>
    </MusicLayout>
</template>
