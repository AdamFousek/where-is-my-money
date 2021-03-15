<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('groups.create.title') }}
                </h2>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white my-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <the-form @submitted="createGroup" :actions="'flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md'">
                        <template #form>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="name" :value="__('groups.create.input.name')" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" autocomplete="group-name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>
                        </template>

                        <template #actions>
                            <basic-link :href="route('group.index')">
                                {{ __('groups.back') }}
                            </basic-link>
                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ __('groups.create.button.create') }}
                            </jet-button>
                        </template>
                    </the-form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import TheForm from "@/Components/Form/TheForm";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import BasicLink from "@/Components/Link/BasicLink";
export default {
    name: "Create.vue",
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        TheForm,
        JetInput,
        JetInputError,
        JetLabel,
        BasicLink,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: '',
            }),
        }
    },
    methods: {
        createGroup() {
            this.form.post(route('group.store'), {
                errorBag: 'createGroup',
                preserveScroll: true
            });
        },
    },
}
</script>

<style scoped>

</style>
