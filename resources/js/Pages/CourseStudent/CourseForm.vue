<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";

defineProps<{
    errors: { student_id: string; course_id: string };
}>();

const form = useForm({
    student_id: "",
    course_id: "",
});

const submit = () => {
    form.post(route("course_student.store"), {
        preserveScroll: true,
        onFinish: () => {},
        onSuccess: () => {
            form.student_id = '';
            form.course_id = '';
        }
    });
};
</script>

<template>
    <form @submit.prevent="submit" novalidate class="was-validated">
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Estudiante"
                v-model="form.student_id"
                required
            />
            <label for="name">Estudiante</label>
            <InputError :message="errors.student_id" class="mt-2" />
        </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                id="last_name"
                placeholder="Curso"
                v-model="form.course_id"
                required
            />
            <label for="last_name">Curso</label>
            <InputError :message="errors.course_id" class="mt-2" />
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <button
                type="submit"
                class="btn btn-primary"
                :class="{
                    'opacity-25': form.processing,
                }"
                :disabled="form.processing"
            >
                <span
                    v-if="form.processing"
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                ></span>
                Agregar
            </button>
        </div>
    </form>
</template>
