<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('groups.edit.title')}} - {{ group.name }}
                </h2>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    name: "Edit.vue",
    props: ['group'],
    components: {
        AppLayout
    }
}
</script>

<style scoped>

</style>
