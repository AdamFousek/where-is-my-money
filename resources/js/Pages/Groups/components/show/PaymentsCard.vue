<template>
    <div class="bg-white order-last lg:order-first w-full lg:w-3/5 my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
        <h2 class="text-xl my-2 py-2 border-b border-gray-400">
            {{ __('groups.show.payments') }}
        </h2>
    </div>
</template>

<script>
export default {
    name: "PaymentsCard.vue",
    props: {
        payments: Array,
    }
}
</script>

<style scoped>

</style>
