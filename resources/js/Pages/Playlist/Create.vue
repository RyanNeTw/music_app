<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    tracks: Array,
});

const tracksRef = ref(props.tracks);
const filter = ref("");
const showMenu = ref(false);

const form = useForm({
    title: "",
    tracks: [],
});

const submit = () => {
    form.post(route("playlists.store"));
};

const filteredTracks = computed(() => {
    return tracksRef.value.filter(
        (track) =>
            track.title.toLowerCase().includes(filter.value.toLowerCase()) ||
            track.artist.toLowerCase().includes(filter.value.toLowerCase())
    );
});
</script>

<template>
    <Head title="Add playlist" />
    <HeaderLayout>
        <template #title> Add a playlist </template>
        <template #action> </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-y-8">
                <div>
                    <label for="title"> Title </label>
                    <input
                        type="text"
                        v-model="form.title"
                        :class="{ 'border-red-500': form.errors.title }"
                        class="form-control"
                        placeholder="Title"
                        id="title"
                    />
                    <p
                        v-if="form.errors.title"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.title }}
                    </p>
                </div>
                <div class="flex flex-col z-50">
                    <h4 class="font-bold text-xl mb-4">Tracks</h4>
                    <div class="w-fit relative">
                        <button
                            type="button"
                            @click="showMenu = !showMenu"
                            class="w-96 py-2 px-1 border border-black hover:bg-gray-100"
                            :class="`${
                                showMenu
                                    ? 'rounded-t-lg border-b-0'
                                    : 'rounded-lg'
                            }`"
                        >
                            {{
                                showMenu ? "Hide the tracks" : "Show the tracks"
                            }}
                        </button>
                        <div
                            class="w-96 py-2 px-2 bg-white border-black border-x flex items-center border-y absolute -bottom-[58px] left-0"
                            v-if="showMenu"
                        >
                            <label for="filter">
                                <svg
                                    class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                    />
                                </svg>
                            </label>
                            <input
                                type="search"
                                v-model="filter"
                                placeholder="Filter tracks"
                                class="w-full border-0"
                                id="filter"
                            />
                        </div>
                        <div
                            class="h-48 max-h-48 w-96 max-w-96 overflow-y-auto overflow-x-hidden flex-col border border-t-0 border-black rounded-b-lg absolute -bottom-[250px] left-0 bg-white"
                            v-if="showMenu"
                        >
                            <div
                                v-for="track in filteredTracks"
                                :key="track.uuid"
                                class="border-b border-black"
                            >
                                <label
                                    :for="track.uuid"
                                    class="w-full block py-2 px-1 hover:bg-blue-300 cursor-pointer"
                                    :class="`${
                                        form.tracks.includes(track.uuid)
                                            ? 'bg-blue-200'
                                            : 'white'
                                    }`"
                                    >{{ track.title }}</label
                                >
                                <input
                                    type="checkbox"
                                    v-model="form.tracks"
                                    class="hidden"
                                    :class="{
                                        'border-red-500': form.errors.tracks,
                                    }"
                                    :value="track.uuid"
                                    :id="track.uuid"
                                />
                            </div>
                        </div>
                    </div>

                    <p
                        v-if="form.errors.tracks"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.tracks }}
                    </p>
                </div>
                <input
                    type="submit"
                    value="Add the playlist"
                    class="bg-blue-500 hover:bg-blue-700 rounded-lg px-4 py-2 text-white font-bold hover:cursor-pointer w-fit"
                />
            </form>
        </template>
    </HeaderLayout>
</template>
