<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card mt-5">
                <div class="card-body">
                    <div>
                        <Link href="/">
                            <ApplicationLogo
                                class="rounded mx-auto d-block w-25"
                            />
                        </Link>
                    </div>

                    <div
                        class=""
                    >
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
