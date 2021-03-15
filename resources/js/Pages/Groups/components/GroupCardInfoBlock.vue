<template>
    <div class="w-full flex justify-between flex-wrap text-xs">
        <div class="w-1/2 text-gray-700 mb-2">
            {{ title }}
        </div>
        <div class="w-1/2 text-black mb-2">
            {{ data }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        data: String|Number|Boolean,
    }
}
</script>
