<template>
    <div class="w-full lg:w-1/3">
        <div class="bg-white flex items-center flex-wrap my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
            <h2 class="text-xl my-2 py-2">
                {{ __('groups.show.status') }}
            </h2>
            <span class="text-3xl text-green-400 mx-auto">+ 1000</span>
        </div>
        <div class="bg-white my-8 p-4 overflow-hidden shadow-xl sm:rounded-lg">
            <h2 class="text-xl my-2 py-2 border-b border-gray-400">
                {{ __('groups.show.description.title') }}
            </h2>

            <group-card-info-block :title="__('groups.show.description.countPayments')"
                                   :data="payments.meta.total"
                                   class="mb-2"></group-card-info-block>
            <group-card-info-block :title="__('groups.show.description.countUsers')"
                                   :data="users.length"
                                   class="mb-2"></group-card-info-block>
            <group-card-info-block :title="__('groups.show.description.createdBy')"
                                   :data="group.created_user"
                                   class="mb-2"></group-card-info-block>
            <group-card-info-block :title="__('groups.show.description.created')"
                                   :data="group.created_at"
                                   class="mb-2"></group-card-info-block>
            <div class="my-2 py-2">
                <h4 class="mb-2 text-lg border-b border-gray-400">
                    {{ __('groups.show.description.description') }}
                </h4>
                <p class="text-gray-700 text-xs">{{ group.description }}</p>
            </div>

            <div class="my-2 py-2">
                <div class="flex justify-between items-center border-b border-gray-400 mb-2">
                    <h4 class="text-lg">
                        {{ __('groups.show.description.categories') }}
                    </h4>
                    <inertia-link
                        :href="'#'"
                        class="inline-flex items-center"
                    >
                        <i class="fas fa-plus cursor-pointer text-lg hover:text-green-500 focus:text-green-500"></i>
                    </inertia-link>
                </div>
                <div class="flex flex-wrap justify-between">
                    <div class="mb-1 cursor-default w-1/2 text-sm pl-4 relative"
                         v-for="category in categories" :key="category.id">
                        <div class="bookmark left-0 top-0" :style="{
                            borderLeftColor: category.color,
                            borderRightColor: category.color
                        }"></div>
                        <span class="cursor-pointer hover:text-green-700"
                              :class="{ 'font-bold': filter.categories ? filter.categories.indexOf(category.id.toString()) !== -1 : false }"
                              @click="filterPayments('categories', category.id)">
                            {{ category.name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="my-2 py-2">
                <h4 class="mb-2 text-lg border-b border-gray-400">
                    {{ __('groups.show.description.users') }}
                </h4>
                <div class="flex flex-wrap justify-between">
                    <div class="mb-1 w-1/2 text-xs text-gray-700 hover:text-green-700"
                         v-for="user in users" :key="user.id">
                        <span class="cursor-pointer hover:text-green-700"
                              :class="{ 'font-bold': filter.users ? filter.users.indexOf(user.id.toString()) !== -1 : false }"
                              @click="filterPayments('users', user.id)">
                            {{ user.display_name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import GroupCardInfoBlock from "@/Pages/Groups/components/GroupCardInfoBlock";

export default {
    name: "GroupInfoCard.vue",
    components: {
        GroupCardInfoBlock
    },
    props: {
        group: Object,
        users: Array,
        payments: Object,
        categories: Array,
        filter: Object | Array,
    },
    methods: {
        filterPayments(section, id) {
            this.$emit('filterPayments', {section, id});
        }
    }
}
</script>

<style scoped>

</style>
