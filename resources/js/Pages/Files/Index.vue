<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    files: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm();

function destroy(id) {
    if (confirm("Tem certeza?")) {
        form.delete(route('files.destroy', id));
    }
}

</script>

<template>
    <Head title="Meus ficheiros" />
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de ficheiros
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-5 overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="flex-row justify-between mb-5 flex align-items-center">
                        <h1>Ficheiros</h1>
                        <div>
                            <Link :href="route('files.create')" class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                            Carregar</Link>
                        </div>
                    </div>

                    <div v-if="$page.props.flash && $page.props.flash.message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">
                            {{ $page.props.flash.message }}
                        </span>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="file in files" :key="file.id" class="p-3">
                                <img style="width: 100%; height: 200px; object-fit: cover"
                                    :src="'/uploads/files/'+file.url" alt="">
                                <br>
                                {{ file.title }}
                                <hr class="my-3">
                                <Link :href="route('files.edit',file.id)"
                                    class="px-4 py-2 text-white bg-blue-600 rounded-lg">Editar</Link>

                                <button class="px-4 py-2 text-white bg-blue-600 rounded-lg ml-3" @click="destroy(file.id)">
                                    Excluir
                                </button>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <hr>

            </div>
        </div>
    </AppLayout>
</template>
