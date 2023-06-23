<script setup lang="ts">
import { reactive } from "vue";
import { Students } from "./student-interface";

const props = defineProps<{
    data: any;
}>();

const form = reactive({
    name: props.data.student.name,
    last_name: props.data.student.last_name
 });


</script>

<template>
    <!-- {{ student }} -->
    {{ props }}
    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="name@example.com"
            v-model="props.data.student.name"
        />
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
        />
        <label for="floatingPassword">Password</label>
    </div>
</template>
