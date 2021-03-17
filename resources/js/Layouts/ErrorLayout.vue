<template>
    <div>
        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main class="pb-14 sm:pb-20">
            <slot></slot>
        </main>

        <the-footer></the-footer>
    </div>
</template>

<script>
import TheFooter from "@/Layouts/TheFooter";
import JetBanner from '@/Jetstream/Banner';

export default {
    components: {
        TheFooter,
        JetBanner
    },
    name: "ErrorLayout.vue"
}
</script>

<style scoped>

</style>
