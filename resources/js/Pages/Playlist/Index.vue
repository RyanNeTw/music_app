<script setup>
import { ref, computed } from "vue";
import PlaylistElement from "@/Components/PlaylistElement.vue";

const props = defineProps({
    playlists: Array,
});

const playlistsRef = ref(props.playlists);
const search = ref("");

const filteredPlaylists = computed(() => {
    return playlistsRef.value.filter(
        (playlist) =>
            playlist.title.toLowerCase().includes(search.value.toLowerCase()) ||
            playlist.tracks.find(
                (track) =>
                    track.title
                        .toLowerCase()
                        .includes(search.value.toLowerCase()) ||
                    track.artist
                        .toLowerCase()
                        .includes(search.value.toLowerCase())
            )
    );
});
</script>

<template>
    <Head title="Playlists" />
    <HeaderLayout>
        <template #title> Playlists </template>
        <template #action>
            <Link
                v-if="$page.props.auth.user && $page.props.auth.user.admin"
                :href="route('playlists.create')"
                class="text-white rounded-md px-3 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-700"
                aria-current="page"
                >Add a playlist</Link
            >
        </template>
        <template #content>
            <div>
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search..."
                    class="mb-8 rounded-lg w-1/4"
                />
                <ul
                    class="flex flex-wrap gap-8 justify-center"
                    :v-if="filteredPlaylists.length > 0"
                >
                    <PlaylistElement
                        v-for="playlist in filteredPlaylists"
                        :key="playlist.uuid"
                        :playlist="playlist"
                    >
                        {{ playlist.title }}
                    </PlaylistElement>
                </ul>
            </div>
        </template>
    </HeaderLayout>
</template>
