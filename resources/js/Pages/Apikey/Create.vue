<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    apikeys: Array,
});

const apikeys = ref(props.apikeys);
const showMenu = ref(false);

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("apikeys.store"));
};
</script>

<template>
    <Head title="Add Apikey" />
    <HeaderLayout>
        <template #title> Add a apikey </template>
        <template #action> </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-y-8">
                <div>
                    <label for="name"> Name </label>
                    <input
                        type="text"
                        v-model="form.name"
                        :class="{ 'border-red-500': form.errors.name }"
                        class="form-control"
                        placeholder="name"
                        id="name"
                    />
                    <p
                        v-if="form.errors.name"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.name }}
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
