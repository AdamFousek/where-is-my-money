<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Your groups
                </h2>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end my-4 px-2 sm:px-0">
                    <inertia-link
                        :href="route('group.create')"
                        class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green transition ease-in-out duration-150"
                    >
                        Create Group
                    </inertia-link>
                </div>

                <div class="bg-white mb-8 p-4 overflow-hidden shadow-xl sm:rounded-lg" v-for="group in groups" :key="group.id">
                    <div class="flex flex-wrap justify-between items-center">
                        <h2 class="text-xl my-4">{{ group.name }}</h2>
                        <inertia-link v-if="group.user.id === $page.props.user.id"
                                      :href="route('group.edit', group)"
                                      class="inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-yellow transition ease-in-out duration-150"
                        >
                            Edit Group
                        </inertia-link>
                    </div>
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
