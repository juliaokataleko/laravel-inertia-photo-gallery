<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>

    <div class="content-wrapper">

        <header class="">
            <div class="container py-5 px-4 border-x-2 mx-auto flex flex-row justify-between">
                <a href="#">
                    App Logo editado
                </a>

                <div>
                    <a href="#" class="p-2 rounded bg-green-700 text-white">Entrar</a>
                </div>
            </div>
        </header>

        <!-- content -->
        <div class="show-case p-5 text-center bg-indigo-900 text-white text-3xl">
            Orçamentos e Informações rápidas e confiáveis sobre serviços tecnológicos especializados
        </div>
    </div>



</template>

<style>
.content-wrapper {
    max-width: 1250px;
    margin: 0 auto;
}
</style>
