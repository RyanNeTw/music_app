<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
    tracks: Array,
});
</script>

<template>
    <Head title="Tracks" />
    <MusicLayout>
        <template #title> Tracks </template>
        <template #action> </template>
        <template #content>
            <div>
                <ul>
                    <li v-for="track in tracks" :key="track.uuid">
                        {{ track.title }} - {{ track.artist }}
                    </li>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>
