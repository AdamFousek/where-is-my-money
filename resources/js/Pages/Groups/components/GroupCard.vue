<template>
    <div class="bg-white mb-4 md:mb-8 p-4 overflow-hidden shadow-xl sm:rounded-lg w-full lg:w-96 md:w-5/12">
        <h2 class="flex flex-wrap items-center text-xl my-2 py-2 border-b border-gray-400">
            <span v-if="group.is_favorite" class="border-b-2 border-transparent mr-2">
                <i class="fas fa-star text-yellow-400"></i>
            </span>
            <basic-link :href="route('group.show', group)" :color="'green'">
                {{ group.name }}
            </basic-link>
        </h2>
        <div class="w-full flex justify-between flex-wrap text-2xl my-4">
            <div class="w-1/2">
                {{ __('groups.card.status') }}:
            </div>
            <div class="w-1/2 text-green-400">
                + 1000
            </div>
        </div>

        <group-card-info-block v-if="group.payment"
                               :title="__('groups.card.lastPaymentWho')"
                               :data="group.payment.user"></group-card-info-block>
        <group-card-info-block v-else
                               :title="__('groups.card.lastPaymentWho')"
                               :data="'-'"></group-card-info-block>
        <group-card-info-block v-if="group.payment"
                               :title="__('groups.card.lastPayment')"
                               :data="group.payment.created_at"
                               class="mb-2"></group-card-info-block>
        <group-card-info-block v-else
                               :title="__('groups.card.lastPayment')"
                               :data="'-'"
                               class="mb-2"></group-card-info-block>
        <group-card-info-block :title="__('groups.card.createdBy')"
                               :data="group.created_user.display_name"></group-card-info-block>
        <group-card-info-block :title="__('groups.card.created')"
                               :data="group.created_at"></group-card-info-block>
        <group-card-info-block :title="__('groups.card.numberOfUsers')"
                               :data="group.user_count"></group-card-info-block>
        <group-card-info-block :title="__('groups.card.numberOfPayments')"
                               :data="group.payments ? group.payments.length : 0"></group-card-info-block>
        <div class="flex justify-end flex-wrap text-sm">
            <basic-link :href="route('group.show', group)">
                {{ __('groups.card.showMore') }}
            </basic-link>
        </div>
    </div>
</template>

<script>
import BasicLink from "@/Components/Link/BasicLink";
import GroupCardInfoBlock from "@/Pages/Groups/components/GroupCardInfoBlock";

export default {
    props: {
        group: Object,
    },
    components: {
        BasicLink,
        GroupCardInfoBlock,
    },
}
</script>
