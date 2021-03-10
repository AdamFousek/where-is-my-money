<template>
    <jet-action-section>
        <template #title>
            {{ __('profile.twoFactor.title') }}
        </template>

        <template #description>
            {{ __('profile.twoFactor.description') }}
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
                {{ __('profile.twoFactor.contentEnable') }}
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                {{ __('profile.twoFactor.contentDisable') }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    {{ __('profile.twoFactor.content') }}
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('profile.twoFactor.contentQR') }}
                        </p>
                    </div>

                    <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('profile.twoFactor.contentRecovery') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <jet-confirms-password
                        @confirmed="enableTwoFactorAuthentication"
                        :title="__('profile.twoFactor.confirmPassword.title')"
                        :content="__('profile.twoFactor.confirmPassword.content')"
                        :button="__('profile.twoFactor.confirmPassword.button')"
                    >
                        <jet-button type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            {{ __('profile.twoFactor.enable') }}
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password
                        @confirmed="regenerateRecoveryCodes"
                        :title="__('profile.twoFactor.confirmPassword.title')"
                        :content="__('profile.twoFactor.confirmPassword.content')"
                        :button="__('profile.twoFactor.confirmPassword.button')"
                    >
                        <jet-secondary-button class="mr-3"
                                        v-if="recoveryCodes.length > 0">
                            {{ __('profile.twoFactor.regenerateRecovery') }}
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password
                        @confirmed="showRecoveryCodes"
                        :title="__('profile.twoFactor.confirmPassword.title')"
                        :content="__('profile.twoFactor.confirmPassword.content')"
                        :button="__('profile.twoFactor.confirmPassword.button')"
                    >
                        <jet-secondary-button class="mr-3" v-if="recoveryCodes.length === 0">
                            {{ __('profile.twoFactor.showRecovery') }}
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password
                        @confirmed="disableTwoFactorAuthentication"
                        :title="__('profile.twoFactor.confirmPassword.title')"
                        :content="__('profile.twoFactor.confirmPassword.content')"
                        :button="__('profile.twoFactor.confirmPassword.button')"
                    >
                        <jet-danger-button
                                        :class="{ 'opacity-25': disabling }"
                                        :disabled="disabling">
                            {{ __('profile.twoFactor.disable') }}
                        </jet-danger-button>
                    </jet-confirms-password>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'
    import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetButton,
            JetConfirmsPassword,
            JetDangerButton,
            JetSecondaryButton,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                this.$inertia.post('/user/two-factor-authentication', {}, {
                    preserveScroll: true,
                    onSuccess: () => Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes(),
                    ]),
                    onFinish: () => (this.enabling = false),
                })
            },

            showQrCode() {
                return axios.get('/user/two-factor-qr-code')
                        .then(response => {
                            this.qrCode = response.data.svg
                        })
            },

            showRecoveryCodes() {
                return axios.get('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.recoveryCodes = response.data
                        })
            },

            regenerateRecoveryCodes() {
                axios.post('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.showRecoveryCodes()
                        })
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                this.$inertia.delete('/user/two-factor-authentication', {
                    preserveScroll: true,
                    onSuccess: () => (this.disabling = false),
                })
            },
        },

        computed: {
            twoFactorEnabled() {
                return ! this.enabling && this.$page.props.user.two_factor_enabled
            }
        }
    }
</script>
