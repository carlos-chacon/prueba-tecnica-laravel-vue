<script setup lang="ts">
import { Head, Link, router } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import { StudentResponse, Students } from "@/Pages/Student/student-interface";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TableComponent from "@/Components/TableComponent.vue";
import PaginationComponent from "@/Components/PaginationComponent.vue";
import SearchTableComponent from "@/Components/SearchTableComponent.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { ResponseInterface } from "@/Interfaces/response-interface";

defineProps<{
    students?: StudentResponse;
    q: string;
}>();

const nameColumns = [
    "Nombre",
    "Apellido",
    "Edad",
    "Correo Electrónico",
    "Fecha Creación",
    "Fecha Actualización",
];

const search = (q: string) => {
    router.get(route("student.index", { q: q }));
};

const deleteStudent = (student: Students) => {
    Swal.fire({
    title: `Desea eliminar el estudiante: ${student.name} ${student.last_name}`,
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: 'OK',
    preConfirm: () => {
        router.delete(route('student.destroy', student.id));
        return student
    }
  })
}

</script>

<template>
    <Head title="Estudiantes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Estudiantes</h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Link
                        class="btn btn-primary mb-2"
                        :href="route('student.create')"
                        aria-label="Previous"
                    >
                        <i class="bi bi-plus-circle"></i> Nuevo
                    </Link>

                    <SearchTableComponent :q="q" @submit="search" />

                    <TableComponent
                        :name-columns="nameColumns"
                        title="Listado de Estudiantes"
                        :active-action="true"
                    >
                        <tr v-for="student in students?.data">
                            <th scope="row">{{ student.name }}</th>
                            <td>{{ student.last_name }}</td>
                            <td>{{ student.birth_year }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.created_at }}</td>
                            <td>{{ student.updated_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <Link
                                        class="btn btn-success me-2"
                                        :href="route('student.edit', student.id)"
                                        aria-label="Previous"
                                    >
                                    <i class="bi bi-pencil"></i>
                                    </Link>

                                    <DangerButton @click="deleteStudent(student)">
                                        <i class="bi bi-trash3"></i>
                                    </DangerButton>
                                </div>
                            </td>
                        </tr>
                    </TableComponent>

                    <PaginationComponent :route="'/student'"
                        :paginate="(students as ResponseInterface)"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
