<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <jet-dialog-modal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ cTitle }}
            </template>

            <template #content>
                {{ cContent }}

                <div class="mt-4">
                    <jet-input type="password" class="mt-1 block w-3/4" :placeholder="__('jetstream.password')"
                                ref="password"
                                v-model="form.password"
                                @keyup.enter.native="confirmPassword" />

                    <jet-input-error :message="form.error" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="closeModal">
                    {{ __('jetstream.nevermind') }}
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="confirmPassword" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ cButton }}
                </jet-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import JetButton from './Button'
    import JetDialogModal from './DialogModal'
    import JetInput from './Input'
    import JetInputError from './InputError'
    import JetSecondaryButton from './SecondaryButton'

    export default {
        props: {
            title: {
                type: String,
                default: 'default',
            },
            content: {
                type: String,
                default: 'default',
            },
            button: {
                type: String,
                default: 'default',
            }
        },

        computed: {
            cTitle() {
                let title = this.__('jetstream.title');
                if (this.title === 'default') {
                    return title;
                }
                return this.title;
            },
            cContent() {
                let content = this.__('jetstream.content');
                if (this.content === 'default') {
                    return content;
                }
                return this.content;
            },
            cButton() {
                let button = this.__('jetstream.button');
                if (this.button === 'default') {
                    return button;
                }
                return this.button;
            }
        },

        components: {
            JetButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingPassword: false,
                form: {
                    password: '',
                    error: '',
                },
            }
        },

        methods: {
            startConfirmingPassword() {
                axios.get(route('password.confirmation')).then(response => {
                    if (response.data.confirmed) {
                        this.$emit('confirmed');
                    } else {
                        this.confirmingPassword = true;

                        setTimeout(() => this.$refs.password.focus(), 250)
                    }
                })
            },

            confirmPassword() {
                this.form.processing = true;

                axios.post(route('password.confirm'), {
                    password: this.form.password,
                }).then(() => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit('confirmed'));
                }).catch(error => {
                    this.form.processing = false;
                    this.form.error = error.response.data.errors.password[0];
                    this.$refs.password.focus()
                });
            },

            closeModal() {
                this.confirmingPassword = false
                this.form.password = '';
                this.form.error = '';
            },
        }
    }
</script>
