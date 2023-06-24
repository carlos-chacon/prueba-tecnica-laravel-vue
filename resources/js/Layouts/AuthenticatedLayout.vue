<script setup lang="ts">
import MenuLayout from "./MenuLayout.vue";
</script>

<template>

    <div class="bg-body-secondary min-vh-100">
        <MenuLayout />

        <div class="">
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl py-3 mx-auto px-4 sm:px-5 lg:px-4">
                    <slot name="header" />
                </div>
            </header>
            <!-- Page Content -->
            <main class="container py-3">
                <slot />
            </main>
        </div>
    </div>
</template>
