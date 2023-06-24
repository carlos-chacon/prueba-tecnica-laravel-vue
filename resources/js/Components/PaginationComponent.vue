<script setup lang="ts">
import { ResponseInterface } from "@/Interfaces/response-interface";
import { Link } from "@inertiajs/vue3";

defineProps<{
    paginate: ResponseInterface;
    route: string;
}>();
</script>

<template>
    <div class="justify-content-start">
        <p class="text-sm text-gray-700">
            Mostrando
            <span class="font-medium">{{ paginate.from }}</span>
            a
            <span class="font-medium">{{ paginate.to }}</span>
            de
            <span class="font-medium">{{ paginate.total }}</span>
            resultados
        </p>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item" v-for="(link, index) in paginate.links">
                <Link
                    v-if="index === 0"
                    class="page-link"
                    :class="{'disabled':!link.url}"
                    :href="route"  :data="{ page: link.url ? paginate.current_page-1 : null }"
                    aria-label="Previous"
                >
                    <span aria-hidden="true">&laquo;</span>
                </Link>

                <Link v-if="
                        !(index === 0) && !(index === paginate.links.length - 1)
                    " class="page-link" :class="{'active': link.active, 'disabled':!link.url}"
                    :active="link.active" :href="route"  :data="{ page: link.label }">{{ link.label }}</Link>

                <Link
                    v-if="index === paginate.links.length - 1"
                    class="page-link"
                    :class="{'disabled':!link.url}"
                    :href="route"  :data="{ page: link.url ? paginate.current_page+1 : null }"
                    aria-label="Next"
                >
                    <span aria-hidden="true">&raquo;</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>
