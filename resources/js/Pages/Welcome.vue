<template>
    <div
        class="relative flex items-top justify-center min-h-screen background dark:bg-gray-900 items-center sm:pt-0">
        <div class="flex fixed top-0 py-4 w-full bg-gray-800 text-white">
            <inertia-link :href="route('index')" class="flex items-center">
                <jet-application-mark class="flex h-9 w-auto px-4 fill-current text-white" />
                <span class="text-3xl">{{ appName }}</span>
            </inertia-link>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div v-if="canLogin" class="px-6 py-4 block">
                <inertia-link
                    :href="route('login')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                >
                    Login
                </inertia-link>
                <inertia-link
                    v-if="canRegister"
                    :href="route('register')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                >
                    Register
                </inertia-link>
            </div>
        </div>

        <div class="block fixed bottom-0 py-4 w-full bg-gray-800">
            <div class="flex justify-center">
                <div class="text-center text-sm text-gray-500">
                    Create by <a href="https://github.com/AdamFousek" title="Adam Fousek" class="hover:underline">Adam Fousek</a> - Powered by <a href="https://laravel.com/" title="Larevel" class="hover:underline">Laravel</a>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <div class="text-center text-xs text-gray-700">
                    <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a
                        href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.background {
    background-image: url('/storage/backgrounds/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-position: center;
    filter: grayscale(100%);
}
</style>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetButton from "@/Jetstream/Button";
export default {
    components: {
        JetApplicationMark,
        JetButton,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        appName: String,
    }
}
</script>
