<template>
    <div class="bg-white order-last lg:order-first w-full lg:w-3/5 my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
        <h2 class="text-xl my-2 py-2 border-b border-gray-400">
            {{ __('groups.show.payments.title') }}
        </h2>
        <div class="py-2">
            <div class="flex flex-wrap justify-between my-2">
                <div class="w-2/3 cursor-pointer">
                    {{ __('groups.show.payments.name') }}
                </div>
                <div class="w-1/3 cursor-pointer text-center">
                    {{ __('groups.show.payments.amount') }}
                </div>
            </div>
            <payment-item v-for="payment in payments"
                          :key="payment.id"
                          :payment="payment"
                          :users="users"
                          :categories="categories">
            </payment-item>
        </div>
    </div>
</template>

<script>
import PaymentItem from "@/Pages/Groups/components/show/PaymentItem";

export default {
    name: "PaymentsCard.vue",
    components: {
        PaymentItem,
    },
    props: {
        payments: Array,
        users: Array,
        categories: Array,
    },
}
</script>

<style scoped>

</style>
