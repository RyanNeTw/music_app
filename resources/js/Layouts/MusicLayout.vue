<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <nav class="bg-gray-800">
            <div class="max-w-7xl px-16 sm:px-6 lg:px-16">
                <div class="relative flex h-16 items-center justify-between">
                    <div
                        class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"
                    >
                        <Link href="/" class="flex flex-shrink-0 items-center">
                            <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company"
                            />
                        </Link>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <Link
                                    :href="route('tracks.create')"
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page"
                                    >Add a track</Link
                                >
                                <a
                                    href="#"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    >Team</a
                                >
                                <a
                                    href="#"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    >Projects</a
                                >
                                <a
                                    href="#"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    >Calendar</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="px-16">
            <div class="flex justify-between items-center">
                <h4 class="text-4xl font-bold my-8">
                    <slot name="title"></slot>
                </h4>
                <div>
                    <slot name="action"></slot>
                </div>
            </div>
            <slot name="content"></slot>
        </div>
    </div>
</template>
