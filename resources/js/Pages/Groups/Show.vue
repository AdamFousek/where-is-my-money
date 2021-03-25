<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <span v-if="isFavorite" @click="markFavoriteGroup()"><i
                        class="fas fa-star text-yellow-400 cursor-pointer"></i></span>
                    <span v-else @click="markFavoriteGroup()"><i class="far fa-star cursor-pointer"></i></span>
                    {{ group.name }}
                </h2>
                <inertia-link
                    :href="group.links.edit"
                    class="inline-flex items-center px-4 py-2"
                >
                    <i class="fas fa-cog cursor-pointer text-2xl hover:text-green-500 focus:text-green-500"></i>
                </inertia-link>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    {{ __('groups.show.payments') }}
                    {{ group.description }}
                    {{ group }}
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
    data() {
        return {
            isFavorite: this.group.is_favorite,
            favoriteForm: this.$inertia.form({}),
        }
    },
    methods: {
        markFavoriteGroup() {
            this.favoriteForm.put(this.group.links.toggleFavorite, {
                onSuccess: () => {
                    this.isFavorite = !this.isFavorite;
                    this.favoriteForm.reset()
                },
            })
        },
    },
}
</script>

<style scoped>

</style>
