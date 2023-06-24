<script setup lang="ts">
defineProps<{
    nameColumns: string[];
    title?: string;
    activeAction: boolean,
}>();
</script>

<template>
    <div class="table-responsive">
        <table class="table table-hover">
            <caption class="caption-top" v-if="title">
                {{ title }}
            </caption>
            <thead>
                <tr>
                    <th scope="col" v-for="column in nameColumns">
                        {{ column }}
                    </th>
                    <th scope="col" v-if="activeAction">Acción</th>
                </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>
</template>
