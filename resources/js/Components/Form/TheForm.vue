<template>
    <form @submit.prevent="$emit('submitted')">
        <div class="px-4 py-5 bg-white sm:p-6 shadow"
             :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'">
            <div class="grid grid-cols-6 gap-6">
                <slot name="form"></slot>
            </div>
        </div>

        <div v-if="hasActions" :class="classes">
            <slot name="actions"></slot>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        actions: String,
    },
    computed: {
        hasActions() {
            return !! this.$slots.actions
        },
        classes() {
            if (this.actions) {
                return this.actions;
            } else {
                return 'flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md';
            }
        }
    }
}
</script>

<style scoped>

</style>
