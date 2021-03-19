<template>
    <textarea
        class="border-gray-300 focus:border-green-500 focus:ring focus:ring-green-400 focus:ring-opacity-50 rounded-md shadow-sm"
        :value="value"
        @input="$emit('input', $event.target.value)"
        ref="textarea"
        cols="100"
        rows="10"
    ></textarea>
</template>

<script>
export default {
    props: ['value'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    },
}
</script>

<style scoped>

</style>
