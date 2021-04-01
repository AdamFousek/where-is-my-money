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
                    class="inline-flex items-center px-4 py-2 hover:text-green-500 focus:text-green-500"
                >
                    <i class="fas fa-cog cursor-pointer text-2xl"></i>
                </inertia-link>
            </div>
        </template>

        <div v-if="showLoader" class="flex items-center justify-center fixed top-0 left-0 w-full h-full z-50 bg-gray-200 bg-opacity-50">
            <div class="text-3xl text-black">Loading...</div>
        </div>

        <div class="max-w-7xl mx-auto flex items-start justify-between flex-wrap sm:px-6 lg:px-8">
            <payments-card :payments="payments"
                           :users="users"
                           :categories="categories"
                           :filter="filter"
                           @filterPayments="filterPayments"></payments-card>
            <group-info-card :group="group"
                             :payments="payments"
                             :users="users"
                             :categories="categories"
                             :filter="filter"
                             @filterPayments="filterPayments"></group-info-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import PaymentsCard from "@/Pages/Groups/components/show/PaymentsCard";
import GroupInfoCard from "@/Pages/Groups/components/show/GroupInfoCard";

export default {
    name: "Show.vue",
    props: {
        group: Object,
        payments: Object,
        categories: Array,
        users: Array,
        filter: Object|Array,
    },
    components: {
        AppLayout,
        PaymentsCard,
        GroupInfoCard
    },
    data() {
        return {
            isFavorite: this.group.is_favorite,
            showLoader: false,
        }
    },
    methods: {
        markFavoriteGroup() {
            let url = this.group.links.toggleFavorite;
            this.$inertia.visit(url, {
                method: 'put',
                replace: true,
                preserveScroll: true,
                onStart: visit => {
                    this.showLoader = true;
                },
                onSuccess: page => {
                    this.isFavorite = !this.isFavorite;
                },
                onFinish: visit => {
                    this.showLoader = false;
                },
            })
        },
        filterPayments(value) {
            let filter = {...this.filter};
            if (value.section) {
                if (filter[value.section]) {
                    if (filter[value.section].indexOf(value.id.toString()) !== -1) {
                        filter[value.section].splice(filter[value.section].indexOf(value.id.toString()),1);
                    } else {
                        filter[value.section].push(value.id);
                    }
                } else {
                    filter[value.section] = [value.id];
                }
            } else {
                filter.order = value.order;
                filter.orderDir = value.orderDir;
            }

            this.showLoader = true;
            this.$inertia.visit(this.group.links.show,{
                method: 'get',
                data: filter,
                replace: true,
                preserveScroll: true,
                onStart: visit => {
                    this.showLoader = true;
                },
                onSuccess: page => {
                },
                onFinish: visit => {
                    this.showLoader = false;
                },
            })
        }
    },
}
</script>

<style scoped>

</style>
