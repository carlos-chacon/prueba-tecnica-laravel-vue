<script setup lang="ts">
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import MenuLayout from "./MenuLayout.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <MenuLayout />

    <div class="min-vw-100 bg-gray-100">
        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
            <div class="max-w-7xl py-3 mx-auto px-4 sm:px-5 lg:px-4">
                <slot name="header" />
            </div>
        </header>
        <!-- Page Content -->
        <main class="container pt-5">
            <slot />
        </main>
    </div>
</template>
