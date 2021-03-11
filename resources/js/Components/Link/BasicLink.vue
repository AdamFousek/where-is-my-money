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
            console.log(this.color);
            let classes = ''
            switch (this.color) {
                case 'green':
                    classes = 'inline-flex items-center text-gray-700 border-b-2 border-transparent hover:text-black hover:border-green-500 focus:outline-none focus:text-gray-700 focus:border-green-300 transition duration-150 ease-in-out';
                    break;
                default:
                    classes = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
            }
            return classes;
        }
    }
}
</script>
