<template>
    <app-layout>
        <template #header>
            <div class="flex justify-start items-center">
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ __('groups.title') }}
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end my-4 px-2 sm:px-0">
                <inertia-link
                    :href="route('group.create')"
                    class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green transition ease-in-out duration-150"
                >
                    {{ __('groups.buttons.create') }}
                </inertia-link>
            </div>

            <div class="flex justify-around flex-wrap">
                <group-card v-for="group in groups" :key="group.id" :group="group"></group-card>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BasicLink from "@/Components/Link/BasicLink";
import GroupCard from "@/Pages/Groups/components/GroupCard";

export default {
    props: {
        groups: Array,
    },
    components: {
        AppLayout,
        BasicLink,
        GroupCard,
    },
}
</script>
