<script setup lang="ts">
import { onMounted, defineAsyncComponent, reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";
import { StudentResponse, Students } from "@/Pages/Student/student-interface";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TableComponent from "@/Components/TableComponent.vue";
import PaginationComponent from "@/Components/PaginationComponent.vue";
import SearchTableComponent from "@/Components/SearchTableComponent.vue";
import SuccessButton from "@/Components/SuccessButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import StudentForm from "@/Pages/Student/StudentForm.vue";
import { ResponseInterface } from "@/Interfaces/response-interface";

const studentInit = { name: "", last_name: "", birth_year: "", email: "" };

const data = reactive({
    student: { ...studentInit },
});

const ModalComponent = defineAsyncComponent({
    loader: () => import("@/Components/Modal.vue"),
});

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

const setStudent = (studentList?: Students) => {
    if (studentList) {
        data.student = { ...studentList };
    } else {
        data.student = { ...studentInit };
    }
    console.log(data);
};

const search = (q: string) => {
    router.get(route("student.index", { q: q }));
};
</script>

<template>
    <Head title="Estudiantes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Estudiantes</h2>
        </template>

        {{ data.student }}

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <PrimaryButton
                        class="mb-2"
                        :is="ModalComponent"
                        data-bs-toggle="modal"
                        data-bs-target="#globalModal"
                        @click="setStudent()"
                    >
                        <i class="bi bi-plus-circle"></i> Nuevo
                    </PrimaryButton>

                    <SearchTableComponent :q="q" @submit="search" />

                    <TableComponent
                        :name-columns="nameColumns"
                        title="Listado de Estudiantes"
                    >
                        <tr v-for="student in students?.data">
                            <th scope="row">{{ student.name }}</th>
                            <td>{{ student.last_name }}</td>
                            <td>{{ student.birth_year }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.created_at }}</td>
                            <td>{{ student.updated_at }}</td>
                            <td>
                                <SuccessButton
                                    class="me-2"
                                    :is="ModalComponent"
                                    data-bs-toggle="modal"
                                    data-bs-target="#globalModal"
                                    @click="setStudent(student)"
                                >
                                    <i class="bi bi-pencil"></i>
                                </SuccessButton>
                                <DangerButton>
                                    <i class="bi bi-trash3"></i>
                                </DangerButton>
                            </td>
                        </tr>
                    </TableComponent>

                    <PaginationComponent
                        :paginate="(students as ResponseInterface)"
                    />
                </div>
            </div>
        </div>

        <ModalComponent>
            <StudentForm :data="data" />
        </ModalComponent>
    </AuthenticatedLayout>
</template>
