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
                                   :data="group.payments ? group.payments.length : 0"
                                   class="mb-2"></group-card-info-block>
            <group-card-info-block :title="__('groups.show.description.countUsers')"
                                   :data="group.users ? group.users.length : 0"
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
                <h4 class="mb-2 text-lg border-b border-gray-400">
                    {{ __('groups.show.description.users') }}
                </h4>
                <div class="flex flex-wrap justify-between">
                    <div class="mb-1 cursor-default w-1/2 text-xs text-gray-700 hover:text-green-700 "
                         v-for="user in group.users" :key="user.id">
                        {{ user.display_name }}
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
    }
}
</script>

<style scoped>

</style>
