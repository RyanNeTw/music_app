<script setup>
defineProps({
    playlist: Object,
});
</script>
<template>
    <Link
        :href="route('playlists.show', { playlist: playlist })"
        class="flex flex-col items-center justify-center w-64 h-64 gap-x-4 gap-y-8 rounded-lg p-4 border-8 border-transparent relative bg-slate-100 hover:bg-slate-200 cursor-pointer"
    >
        <img
            :src="`${
                playlist.tracks[0].image
                    ? '/storage/' + playlist.tracks[0].image
                    : 'https://placehold.co/400'
            }`"
            class="w-32 h-32 rounded-lg"
            :alt="playlist.title + ' by ' + playlist.user.name"
        />
        <p class="text-center text-xl">
            {{ playlist.title }} made by {{ playlist.user.name }}
        </p>
    </Link>
</template>
