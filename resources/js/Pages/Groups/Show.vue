<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ group.name }}
                </h2>
                <inertia-link
                    :href="route('group.index')"
                    class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo transition ease-in-out duration-150"
                >
                    Back to groups
                </inertia-link>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    Payments:
                    @todo
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
    name: "Show.vue",
    props: ['group'],
    components: {
        AppLayout,
    },
}
</script>

<style scoped>

</style>
