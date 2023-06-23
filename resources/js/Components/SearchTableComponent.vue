<script setup lang="ts">
import { reactive } from 'vue';

const props = defineProps<{
    q: string
}>();

const form = reactive({
    q: props.q
});

const emit = defineEmits<{
    submit: [q: string]
}>();

</script>

<template>
    <form class="d-flex" role="search" @submit.prevent="emit('submit', form.q)">
        <span class="input-group-text">
            <i class="bi bi-search"></i>
        </span>
        <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
            v-model="form.q"
        />
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</template>
