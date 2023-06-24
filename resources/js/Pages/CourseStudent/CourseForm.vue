<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";

const c = {controller: new AbortController()};

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
            form.student_id = "";
            form.course_id = "";
        },
    });
};

const options = reactive({
    lvStudent: [],
    lvCourse: [],
});

const fetchOptions = (search: string, loading: Function) => {
    if (search.length) {
        loading(true);

        c.controller.abort();
        c.controller = new AbortController();
        const signal = c.controller.signal;

        fetch(`student/list-student/${search}`, {signal})
            .then((resp) => resp.json())
            .then((data) => {
                options.lvStudent = data;
                loading(false);
            })
            .catch((err) => {
                loading(false);
            });
    }
};

const fetchOptionsCourse = (search: string, loading: Function) => {
    if (search.length) {
        loading(true);

        c.controller.abort();
        c.controller = new AbortController();
        const signal = c.controller.signal;

        fetch(`course/list-course/${search}`, {signal})
            .then((resp) => resp.json())
            .then((data) => {
                options.lvCourse = data;
                loading(false);
            })
            .catch((err) => {
                loading(false);
            });
    }
};
</script>

<template>
    <form @submit.prevent="submit" novalidate class="was-validated">
        <div class="mb-2">
            <label for="student_id">Estudiante</label>
            <v-select
                :options="options.lvStudent"
                v-model="form.student_id"
                label="full_name"
                @search="fetchOptions"
                :reduce="(option: any) => option.id"
            >
                <template #search="{ attributes, events }">
                    <input
                        id="student_id"
                        class="vs__search"
                        required
                        v-bind="attributes"
                        v-on="events"
                    />
                </template>
            </v-select>
            <InputError :message="errors.student_id" class="mt-2" />
        </div>
        <div class="mb-2">
            <label for="course_id">Curso</label>
            <v-select
                :options="options.lvCourse"
                v-model="form.course_id"
                label="name"
                @search="fetchOptionsCourse"
                :reduce="(option: any) => option.id"
            >
                <template #search="{ attributes, events }">
                    <input
                        id="course_id"
                        class="vs__search"
                        required
                        v-bind="attributes"
                        v-on="events"
                    />
                </template>
            </v-select>
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
