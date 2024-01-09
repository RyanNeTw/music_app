<script setup>
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    tracks: Array,
});

const tracksRef = ref(props.tracks);
const search = ref("");

const currentTrack = ref(null);
const audio = ref(null);

const filteredTracks = computed(() => {
    return tracksRef.value.filter(
        (track) =>
            track.title.toLowerCase().includes(search.value.toLowerCase()) ||
            track.artist.toLowerCase().includes(search.value.toLowerCase())
    );
});

const playMusic = (track) => {
    const url = "/storage/" + track.music;

    if (!currentTrack.value) {
        audio.value = new Audio(url);
        audio.value.play();
    } else if (currentTrack.value !== track.uuid) {
        audio.value.pause();
        audio.value.src = url;
        audio.value.play();
    } else if (!audio.value.paused) {
        audio.value.pause();
    } else {
        audio.value.play();
    }

    currentTrack.value = track.uuid;
};
</script>

<template>
    <Head title="Tracks" />
    <HeaderLayout>
        <template #title> Tracks </template>
        <template #action> </template>
        <template #content>
            <div>
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search..."
                    class="mb-8 rounded-lg w-1/4"
                />
                <ul class="flex flex-col gap-y-4">
                    <li
                        v-if="filteredTracks.length > 0"
                        v-for="(track, index) in filteredTracks"
                        :class="index % 2 ? 'bg-white' : 'bg-gray-100'"
                        :key="track.uuid"
                        class="flex items-center gap-x-4 h-24 rounded-lg p-4"
                        @click="playMusic(track)"
                    >
                        <img
                            v-if="track.image"
                            :src="`/storage/${track.image}`"
                            class="w-24 h-24 rounded-lg"
                            :alt="track.title + ' by ' + track.artist"
                        />
                        {{ track.title }} - {{ track.artist }}
                        <audio
                            v-if="track.music"
                            controls
                            :src="`/storage/${track.music}`"
                            class="w-1/3 ml-auto"
                        />
                    </li>
                </ul>
            </div>
        </template>
    </HeaderLayout>
</template>
