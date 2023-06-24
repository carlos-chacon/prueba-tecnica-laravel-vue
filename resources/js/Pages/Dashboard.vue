<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import Card from "@/Components/Card.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CourseList from "./CourseStudent/CourseList.vue";
import CourseForm from "./CourseStudent/CourseForm.vue";
import {
    CourseStudentResponse,
    TopCourseInterface,
} from "./CourseStudent/course-student-interface";
import CourseTop from "./CourseStudent/CourseTop.vue";

defineProps<{
    course_students?: CourseStudentResponse;
    q: string;
    errors: { student_id: string; course_id: string };
    top_courses: TopCourseInterface[];
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Dashboard</h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <Card
                                title-header="Top 3 cursos con mas estudiantes"
                                title=""
                            >
                                <CourseTop :top_courses="top_courses" />
                            </Card>
                        </div>

                        <div class="col-md-6 mb-2">
                            <Card title-header="Asignación de cursos" title="">
                                <CourseForm :errors="errors" />
                            </Card>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <Card title-header="Listado Estudiantes - Curso">
                                <CourseList
                                    :q="q"
                                    :course_students="course_students"
                                />
                            </Card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
