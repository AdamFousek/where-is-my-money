<template>
    <div class="bg-white order-last lg:order-first w-full lg:w-3/5 my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
        <h2 class="text-xl my-2 py-2 border-b border-gray-400">
            {{ __('groups.show.payments.title') }}
        </h2>
        <div class="py-2">
            <div class="flex flex-wrap justify-between my-2">
                <div class="w-2/3 cursor-pointer "
                     :class="{ 'font-bold': filter.order === 'created_at' }"
                     @click="orderPayments('created_at', filter.orderDir === 'asc' ? 'desc' : 'asc')">
                    {{ __('groups.show.payments.name') }}
                    <i class="fas"
                       :class="{
                        'fa-sort': !filter.order,
                        'fa-sort-down': filter.order === 'created_at' && filter.orderDir === 'desc',
                        'fa-sort-up': filter.order === 'created_at' && filter.orderDir === 'asc',
                    }"></i>
                </div>
                <div class="w-1/3 cursor-pointer text-center"
                     :class="{ 'font-bold': filter.order === 'amount' }"
                     @click="orderPayments('amount', filter.orderDir === 'asc' ? 'desc' : 'asc')">
                    {{ __('groups.show.payments.amount') }}
                    <i class="fas"
                       :class="{
                        'fa-sort': !filter.order,
                        'fa-sort-down': filter.order === 'amount' && filter.orderDir === 'desc',
                        'fa-sort-up': filter.order === 'amount' && filter.orderDir === 'asc',
                    }"></i>
                </div>
            </div>
            <payment-item v-for="payment in payments.data"
                          :key="payment.id"
                          :payment="payment"
                          :users="users"
                          :categories="categories"
                          @filterPayments="filterPayments">
            </payment-item>
            <div class="flex flex-wrap justify-between">
                <div>
                    <basic-link v-if="payments.links.prev"
                                :href="payments.links.prev">
                        {{ __('groups.show.payments.prev') }}
                    </basic-link>
                </div>
                <div>
                    <basic-link v-if="payments.links.next"
                                :href="payments.links.next">
                        {{ __('groups.show.payments.next') }}
                    </basic-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BasicLink from "@/Components/Link/BasicLink";
import PaymentItem from "@/Pages/Groups/components/show/PaymentItem";

export default {
    name: "PaymentsCard.vue",
    components: {
        PaymentItem,
        BasicLink
    },
    props: {
        payments: Object,
        users: Array,
        categories: Array,
        filter: Object|Array,
    },
    methods: {
        filterPayments(value) {
            this.$emit('filterPayments', value);
        },
        orderPayments(order, orderDir) {
            this.$emit('filterPayments', {order, orderDir});
        }
    }
}
</script>

<style scoped>

</style>
