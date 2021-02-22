<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg" v-for="group in groups" :key="group.id">
                    <h2>{{ group.name }}</h2>
                    <hr>
                    <p>Počet členů: <span> {{ group.users.length }}</span></p>
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
