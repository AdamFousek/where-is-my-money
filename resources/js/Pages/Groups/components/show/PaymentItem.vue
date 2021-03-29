<template>
    <div class="flex flex-wrap justify-between items-center py-2 text-sm text-center">
        <div class="w-2/3 text-left">
            {{ payment.name }}
            <div class="text-xs">
                <span v-tooltip="getUserName(payment.user_id, true)">{{ getUserName(payment.user_id) }}</span>
                <span class="text-gray-700">@{{ payment.created_at }}</span>
            </div>
        </div>
        <div class="w-1/3 relative">
            <div class="bookmark top-0 right-0" :style="borderColor" v-tooltip="getCategory(payment.category_id).name"></div>
            <span class="mx-auto">{{ payment.amount }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentItem.vue",
    props: {
        payment: Object,
        users: Array,
        categories: Array,
    },
    methods: {
        getUserName(id, fullname = false) {
            let user = this.users.find(user => user.id === id);
            if (fullname)
                return user.display_name;

            return user.display_name.split(" ").map((n) => n[0]).join(".");
        },
        getCategory(id) {
            return this.categories.find(user => user.id === id);
        }
    },
    computed: {
        borderColor() {
            return {
                borderLeftColor: this.getCategory(this.payment.category_id).color,
                borderRightColor: this.getCategory(this.payment.category_id).color
            }
        }
    }
}
</script>

<style scoped>

</style>
