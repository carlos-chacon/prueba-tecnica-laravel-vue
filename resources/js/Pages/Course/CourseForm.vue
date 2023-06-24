<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
import { Courses } from "./course-interface";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps<{
    course?: Courses;
}>();

const form = useForm({
    id: props.course?.id,
    name: props.course?.name,
    schedule: props.course?.schedule,
    start_date: props.course?.start_date,
    end_date: props.course?.end_date,
    number_students: props.course?.number_students,
});

const submit = () => {
    if (props.course) {
        form.patch(route("course.update", form.id), {
            onFinish: () => {},
        });
    } else {
        form.post(route("course.store"), {
            onFinish: () => {},
        });
    }
};

const goToBack = () => {
    history.go(-1);
};
</script>

<template>
    <Head :title="(course ? 'Editar' : 'Nuevo') + ' Estudiante'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex justify-content-between">
                <h2 class="d-flex justify-content-start">
                    {{ course ? "Editar" : "Nuevo" }}
                </h2>
                <div class="d-flex justify-content-end">
                    <button
                        class="btn btn-outline-secondary"
                        @click="goToBack()"
                    >
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form
                        @submit.prevent="submit"
                        novalidate
                        class="was-validated"
                    >
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                placeholder="Nombre"
                                v-model="form.name"
                                required
                            />
                            <label for="name">Nombre</label>
                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="schedule"
                                placeholder="Horario"
                                v-model="form.schedule"
                                required
                            />
                            <label for="schedule">Horario</label>
                            <InputError
                                :message="form.errors.schedule"
                                class="mt-2"
                            />
                        </div>

                        <div class="form-floating mb-3">
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="start_date"
                                placeholder="Fecha Inicio"
                                v-model="form.start_date"
                            />
                            <label for="start_date">Fecha Inicio</label>
                            <InputError
                                :message="form.errors.start_date"
                                class="mt-2"
                            />
                        </div>

                        <div class="form-floating mb-3">
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="end_date"
                                placeholder="Fecha Fin"
                                v-model="form.end_date"
                            />
                            <label for="end_date">Fecha Fin</label>
                            <InputError
                                :message="form.errors.end_date"
                                class="mt-2"
                            />
                        </div>

                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="number_students"
                                placeholder="Número de estudiantes asociados"
                                v-model="form.number_students"
                                disabled
                            />
                            <label for="number_students">Número de estudiantes asociados</label>
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-end mt-4"
                        >
                            <button
                                type="submit"
                                class="btn"
                                :class="{
                                    'opacity-25': form.processing,
                                    'btn-primary': !course,
                                    'btn-success': course,
                                }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                {{ course ? "Actualizar" : "Guardar" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
