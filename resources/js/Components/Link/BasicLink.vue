<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
export default {
    props: ['href', 'color'],

    computed: {
        classes() {
            let classes = ''
            switch (this.color) {
                case 'green':
                    classes = 'inline-flex items-center text-gray-700 border-b-2 border-transparent hover:text-black hover:border-green-500 focus:outline-none focus:text-gray-700 focus:border-green-300 transition duration-150 ease-in-out';
                    break;
                default:
                    classes = 'inline-flex items-center px-1 pt-1 text-green-800 hover:text-green-600 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
            }
            return classes;
        }
    }
}
</script>
