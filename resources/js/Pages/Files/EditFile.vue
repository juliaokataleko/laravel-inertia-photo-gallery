<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    file: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    title: props.file.title,
});

const updateFile = () => {
    form.put(route("files.update", props.file.id));
};

</script>

<template>
    <AppLayout title="Dashboard">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-5 overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="flex-row justify-between border-bottom mb-2 flex align-items-center">
                        <h1>Editar descrição da foto</h1>
                        <div>
                            <Link :href="route('files.index')" class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                            Voltar</Link>
                        </div>
                    </div>

                    <form @submit.prevent="updateFile">

                        <div>
                            <InputLabel for="title" value="Titulo" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                                autofocus />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div>
                            <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Salvar
                            </PrimaryButton>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </AppLayout>
</template>
