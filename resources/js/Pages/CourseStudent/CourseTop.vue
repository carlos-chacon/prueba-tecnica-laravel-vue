<script setup lang="ts">
import TableComponent from "@/Components/TableComponent.vue";
import { TopCourseInterface } from "@/Pages/CourseStudent/course-student-interface";

defineProps<{
    top_courses: TopCourseInterface[];
}>();

const nameColumns = ["Curso", "Estudiantes"];
</script>

<template>
    <TableComponent
        :name-columns="nameColumns"
        :active-action="false"
    >
        <tr v-for="course in top_courses">
            <th scope="row">{{ course.name }}</th>
            <td class="text-center">{{ course.students_count }}</td>
        </tr>
    </TableComponent>
</template>
