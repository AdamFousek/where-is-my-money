<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Your groups
            </h2>
        </template>

        <div class="md:py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg" v-for="group in groups" :key="group.id">
                    <h2 class="text-xl my-4">{{ group.name }}</h2>
                    <p>Number of users: <span> {{ group.users.length }}</span></p>
                    <inertia-link
                        :href="route('group.show', group)"
                        class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo transition ease-in-out duration-150"
                    >
                        Show detail
                    </inertia-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['groups'],
    components: {
        AppLayout,
    },
}
</script>
