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
            <Link
                v-if="$page.props.auth.user && $page.props.auth.user.admin"
                :href="route('apikeys.create')"
                class="text-white rounded-md px-3 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-700"
                aria-current="page"
                >Add a Apikey</Link
            >
        </template>
        <template #content>
            <ul
                    class="flex flex-col gap-8 justify-center"
                    :v-if="apiKeys.length > 0"
                >
                   <li v-for="(apikey, index) in apikeys"    :key="apikey.uuid" :index="index" class="flex flex-row gap-4 items-center">
                        <h3>{{ apikey.name }}</h3>
                        <h3>{{ apikey.key }}</h3>
                        <Link
                            :href="route('apikeys.destroy', { api_key: apikey })"
                            method="delete"
                            as="button"
                            class="bg-red-500 hover:bg-red-700 rounded-lg px-4 py-2 text-white font-bold hover:cursor-pointer w-fit"
                            >Delete the API key</Link
                        >
                   </li>
                </ul>
        </template>
    </HeaderLayout>
</template>
