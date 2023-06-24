import { ResponseInterface } from "@/Interfaces/response-interface";

export interface CourseStudentResponse extends ResponseInterface {
  data: CourseStudentInterface[];
}

export interface CourseStudentInterface {
  id: number;
  student_id: number;
  name: string;
  last_name: string;
  course_id: number;
  name_course: string;
  created_at?: any;
  updated_at?: any;
}

export interface TopCourseInterface {
  id: number;
  name: string;
  schedule: string;
  start_date: string;
  end_date: string;
  number_students: number;
  created_at: string;
  updated_at: string;
  students_count: number;
}
