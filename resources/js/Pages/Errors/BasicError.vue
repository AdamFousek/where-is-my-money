<template>
    <error-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white my-8 py-20 overflow-hidden shadow-xl sm:rounded-lg text-center">
                <h1 class="text-4xl py-4">{{ title }}</h1>
                <h3 class="text-2xl py-4">{{ description }}</h3>
                <basic-link class="pt-4" :href="route('index')">
                    {{ __('error.backLink') }}
                </basic-link>
            </div>
        </div>
    </error-layout>
</template>

<script>
import BasicLink from "@/Components/Link/BasicLink";
import ErrorLayout from "@/Layouts/ErrorLayout";
export default {
    components: {
        ErrorLayout,
        BasicLink,
    },
    props: {
        status: Number,
        user: Boolean|Object,
    },
    computed: {
        title() {
            return {
                503: '503: Service Unavailable',
                500: '500: Server Error',
                404: '404: Page Not Found',
                403: '404: Forbidden',
            }[this.status]
        },
        description() {
            return {
                503: this.__('error.503.description'),
                500: this.__('error.500.description'),
                404: this.__('error.404.description'),
                403: this.__('error.403.description'),
            }[this.status]
        },
    },
}
</script>
