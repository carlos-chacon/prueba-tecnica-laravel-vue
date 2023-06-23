<script setup lang="ts">
defineProps<{
    nameColumns: string[];
    title: string;
}>();
</script>

<template>
    <div class="table-responsive">
        <table class="table table-hover">
            <caption class="caption-top">
                {{ title }}
            </caption>
            <thead>
                <tr>
                    <th scope="col" v-for="column in nameColumns">
                        {{ column }}
                    </th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>
</template>
