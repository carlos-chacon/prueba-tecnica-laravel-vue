<script setup lang="ts">
import { Head, Link, router } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import moment from 'moment';
import { CourseResponse, Courses } from "./course-interface";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TableComponent from "@/Components/TableComponent.vue";
import PaginationComponent from "@/Components/PaginationComponent.vue";
import SearchTableComponent from "@/Components/SearchTableComponent.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { ResponseInterface } from "@/Interfaces/response-interface";

defineProps<{
    courses?: CourseResponse;
    q: string;
}>();

const nameColumns = [
    "Nombre",
    "Horario",
    "Fecha Inicio",
    "Fecha Fin",
    "Estudiantes",
    "Fecha Creación",
    "Fecha Actualización",
];

const search = (q: string) => {
    router.get(route("course.index", { q: q }));
};

const deleteStudent = (course: Courses) => {
    Swal.fire({
    title: `Desea eliminar el curso: ${course.name}`,
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: 'OK',
    preConfirm: () => {
        router.delete(route('course.destroy', course.id));
        return course
    }
  })
}

</script>

<template>
    <Head title="Cursos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Cursos</h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Link
                        class="btn btn-primary mb-2"
                        :href="route('course.create')"
                        aria-label="Previous"
                    >
                        <i class="bi bi-plus-circle"></i> Nuevo
                    </Link>

                    <SearchTableComponent :q="q" @submit="search" />

                    <TableComponent
                        :name-columns="nameColumns"
                        title="Listado de Cursos"
                        :active-action="true"
                    >
                        <tr v-for="course in courses?.data">
                            <th scope="row">{{ course.name }}</th>
                            <td>{{ course.schedule }}</td>
                            <td>{{ moment(course.start_date).format('DD-MM-YYYY hh:mm A') }}</td>
                            <td>{{ moment(course.end_date).format('DD-MM-YYYY hh:mm A') }}</td>
                            <td>{{ course.number_students }}</td>
                            <td>{{ course.created_at }}</td>
                            <td>{{ course.updated_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <Link
                                        class="btn btn-success me-2"
                                        :href="route('course.edit', course.id)"
                                        aria-label="Previous"
                                    >
                                    <i class="bi bi-pencil"></i>
                                    </Link>

                                    <DangerButton @click="deleteStudent(course)">
                                        <i class="bi bi-trash3"></i>
                                    </DangerButton>
                                </div>
                            </td>
                        </tr>
                    </TableComponent>

                    <PaginationComponent
                        :paginate="(courses as ResponseInterface)" :route="'/course'"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
