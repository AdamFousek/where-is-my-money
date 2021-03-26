<template>
    <div class="bg-white order-last lg:order-first w-full lg:w-3/5 my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
        <h2 class="text-xl my-2 py-2 border-b border-gray-400">
            {{ __('groups.show.payments.title') }}
        </h2>
        <div class="py-2">
            <div class="flex flex-wrap justify-between my-2">
                <div class="w-1/5 cursor-pointer border-r border-gray-200">
                    {{ __('groups.show.payments.name') }}
                </div>
                <div class="w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ __('groups.show.payments.amount') }}
                </div>
                <div class="w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ __('groups.show.payments.createdBy') }}
                </div>
                <div class="w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ __('groups.show.payments.created') }}
                </div>
                <div class="w-1/5 cursor-pointer text-center">
                    {{ __('groups.show.payments.category') }}
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center my-2" v-for="payment in payments">
                <div class="self-stretch flex items-center w-1/5 cursor-pointer border-r border-gray-200">
                    {{ payment.name }}
                </div>
                <div class="p-2 self-stretch flex items-center w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ payment.amount }}
                </div>
                <div class="p-2 self-stretch flex items-center w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ getUserName(payment.user_id) }}
                </div>
                <div class="p-2 self-stretch flex items-center w-1/5 cursor-pointer border-r border-gray-200 text-center">
                    {{ payment.created_at }}
                </div>
                <div class="p-2 self-stretch flex items-center w-1/5 cursor-pointer text-center">
                    {{ getCategoryName(payment.category_id) }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentsCard.vue",
    props: {
        payments: Array,
        users: Array,
        categories: Array,
    },
    methods: {
        getUserName(id) {
            let user = this.users.find(user => user.id === id );
            return user.display_name;
        },
        getCategoryName(id) {
            let category = this.categories.find(user => user.id === id);
            return category.name;
        }
    }
}
</script>

<style scoped>

</style>
