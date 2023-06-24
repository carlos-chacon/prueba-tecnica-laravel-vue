<script setup lang="ts">
defineProps<{
    titleHeader: string,
    title?: string,
    titleBtn?: string,
}>()
</script>

<template>
    <div class="card">
        <div class="card-header">{{ titleHeader }}</div>
        <div class="card-body">
            <h5 class="card-title" v-if="title">{{ title }}</h5>
            <p class="card-text">
                <slot />
            </p>
            <a href="#" class="btn btn-primary" v-if="titleBtn">{{ titleBtn }}</a>
        </div>
    </div>
</template>
