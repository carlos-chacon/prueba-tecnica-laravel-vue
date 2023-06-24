<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import moment from 'moment';
import SearchTableComponent from '@/Components/SearchTableComponent.vue';
import TableComponent from '@/Components/TableComponent.vue';
import { ResponseInterface } from '@/Interfaces/response-interface';
import { CourseStudentResponse, CourseStudentInterface } from '@/Pages/CourseStudent/course-student-interface';
import DangerButton from '@/Components/DangerButton.vue';
import PaginationComponent from '@/Components/PaginationComponent.vue';

defineProps<{
    course_students?: CourseStudentResponse;
    q: string;
}>();

const nameColumns = [
    "Nombre",
    "Apellido",
    "Curso",
    "Fecha de inscripción",
];

const search = (q: string) => {
    router.visit(route("dashboard", { q: q }), {
        method: 'get',
        preserveScroll: true
    });
};

const deleteCourseStudent = (course: CourseStudentInterface) => {
    Swal.fire({
        title: `Desea eliminar este curso ${course.name_course} a: ${course.name} `,
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "OK",
        preConfirm: () => {
            const data = {
                course_id: course.course_id,
            };
            router.delete(route("course_student.destroy", course.student_id), {
                data,
                only: ["course_students"],
                preserveScroll: true,
                onSuccess: () => {

                }
            });
            return course;
        },
    });
};


</script>

<template>

    <SearchTableComponent :q="q" @submit="search" />

    <TableComponent :name-columns="nameColumns" title="Listado de Estudiantes" :active-action="true">
        <tr v-for="course in course_students?.data">
            <th scope="row">{{ course.name }}</th>
            <td>{{ course.last_name }}</td>
            <td>{{ course.name_course }}</td>
            <td>{{ moment(course.created_at).format('DD-MM-YYYY hh:mm A') }}</td>
            <td>
                <div class="d-flex">
                    <DangerButton @click="deleteCourseStudent(course)">
                        <i class="bi bi-trash3"></i>
                    </DangerButton>
                </div>
            </td>
        </tr>
    </TableComponent>

    <PaginationComponent
        :route="'/dashboard'"
        :paginate="(course_students as ResponseInterface)"
    />
</template>
