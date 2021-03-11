<template>
    <app-layout>
        <template #header>
            <div class="flex justify-start items-center">
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ __('groups.title') }}
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
                        {{ __('groups.buttons.create') }}
                    </inertia-link>
                </div>

                <div class="bg-white mb-8 p-4 overflow-hidden shadow-xl sm:rounded-lg" v-for="group in groups" :key="group.id">
                    <div class="flex flex-wrap justify-between items-center">
                        <h2 class="text-xl my-4">
                            <span v-if="group.pivot.is_favorite">
                                <i class="fas fa-star text-yellow-400"></i>
                            </span>
                            <basic-link :href="route('group.show', group)" :color="'green'">
                                {{ group.name }}
                            </basic-link>
                        </h2>
                    </div>
                    <p>{{ __('groups.card.numberOfUsers') }} <span>0</span></p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BasicLink from "@/Components/Link/BasicLink";

export default {
    props: {
        groups: Array,
    },
    components: {
        AppLayout,
        BasicLink,
    },
}
</script>
