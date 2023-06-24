<script setup lang="ts">
import { Head, router, useForm } from "@inertiajs/vue3";
import moment from "moment";
import Swal from "sweetalert2";
import { Students } from "./student-interface";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Courses } from "../Course/course-interface";
import TableComponent from "@/Components/TableComponent.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { onMounted } from "vue";

const props = defineProps<{
    student?: Students;
    lvCourses?: Courses[];
}>();

const form = useForm({
    id: props.student?.id,
    name: props.student?.name,
    last_name: props.student?.last_name,
    birth_year: props.student?.birth_year,
    email: props.student?.email,
});

const formAddCourse = useForm({
    course_id: "",
});

const submit = () => {
    if (props.student) {
        form.patch(route("student.update", form.id), {
            onFinish: () => {},
        });
    } else {
        form.post(route("student.store"), {
            onFinish: () => {},
        });
    }
};

const goToBack = () => {
    history.go(-1);
};

const deleteCourseStudent = (course: Courses) => {
    Swal.fire({
        title: `Desea eliminar el curso: ${course.name} `,
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "OK",
        preConfirm: () => {
            const data = {
                course_id: course.pivot?.course_id,
            };
            router.delete(route("student.delete-course", form.id), {
                data,
                only: ["student"],
                onSuccess: () => {

                }
            });
            return course;
        },
    });
};
const addCourse = () => {
    formAddCourse.post(route("student.add-course", form.id), {
        only: ["student"],
    });
};

const listCourses = () => {};

onMounted(() => {
    router.visit(route("course.list"), {
        data: {
            name_component: "Student/StudentForm",
        },
        method: "post",
        only: ["lvCourses"],
        preserveState: true,
        onSuccess: (resp) => {
            console.log(resp);
        },
    });
});
</script>

<template>
    <Head :title="(student ? 'Editar' : 'Nuevo') + ' Estudiante'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex justify-content-between">
                <h2 class="d-flex justify-content-start">
                    {{ student ? "Editar" : "Nuevo" }}
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
                                placeholder="Nombres"
                                v-model="form.name"
                                required
                            />
                            <label for="name">Nombres</label>
                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="last_name"
                                placeholder="Apellidos"
                                v-model="form.last_name"
                                required
                            />
                            <label for="last_name">Apellidos</label>
                            <InputError
                                :message="form.errors.last_name"
                                class="mt-2"
                            />
                        </div>

                        <div class="form-floating mb-3">
                            <input
                                type="number"
                                min="1900"
                                :max="new Date().getFullYear()"
                                class="form-control"
                                id="birth_year"
                                placeholder="Año de nacimiento"
                                v-model="form.birth_year"
                            />
                            <label for="birth_year">Año de nacimiento</label>
                            <InputError
                                :message="form.errors.birth_year"
                                class="mt-2"
                            />
                        </div>

                        <div class="form-floating mb-3">
                            <input
                                type="email"
                                class="form-control is-invalid"
                                id="email"
                                placeholder="Correo Electrónico"
                                v-model="form.email"
                            />
                            <label for="email">Correo Electrónico</label>
                            <InputError
                                :message="form.errors.email"
                                class="mt-2"
                            />
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-end mt-4"
                        >
                            <button
                                type="submit"
                                class="btn"
                                :class="{
                                    'opacity-25': form.processing,
                                    'btn-primary': !student,
                                    'btn-success': student,
                                }"
                                :disabled="form.processing"
                            >
                                <span
                                    v-if="form.processing"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                {{ student ? "Actualizar" : "Guardar" }}
                            </button>
                        </div>
                    </form>

                    <form class="my-3" @submit.prevent="addCourse">
                        <div class="input-group mb-3">
                            <select
                                class="form-control"
                                aria-label="Agregar un curso al estudiante"
                                aria-describedby="agregar-curso"
                                v-model="formAddCourse.course_id"
                                @click="listCourses"
                            >
                                <option disabled value="">
                                    Agregar un curso al estudiante
                                </option>
                                <option
                                    v-for="course in lvCourses"
                                    :value="course.id"
                                >
                                    {{ course.name }}
                                </option>
                            </select>
                            <button
                                class="btn btn-primary"
                                type="submit"
                                id="agregar-curso"
                                :class="{
                                    'opacity-25': formAddCourse.processing,
                                }"
                                :disabled="formAddCourse.processing"
                            >
                                <span
                                    v-if="formAddCourse.processing"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                Agregar
                            </button>
                        </div>
                    </form>

                    <div v-if="student?.course">
                        <TableComponent
                            v-if="student?.course"
                            :name-columns="[
                                'Nombre',
                                'Horario',
                                'Inicia',
                                'Finaliza',
                            ]"
                            title="Listado de Cursos"
                        >
                            <tr v-for="course in student?.course">
                                <th scope="row">{{ course.name }}</th>
                                <td>{{ course.schedule }}</td>
                                <td>
                                    {{
                                        moment(course.start_date).format(
                                            "DD-MM-YYYY hh:mm A"
                                        )
                                    }}
                                </td>
                                <td>
                                    {{
                                        moment(course.end_date).format(
                                            "DD-MM-YYYY hh:mm A"
                                        )
                                    }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <DangerButton
                                            @click="deleteCourseStudent(course)"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </DangerButton>
                                    </div>
                                </td>
                            </tr>
                        </TableComponent>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
