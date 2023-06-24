import { ResponseInterface } from "@/Interfaces/response-interface";

export interface CourseResponse extends ResponseInterface {
  data: Courses[];
}

export interface Courses {
  id?: number;
  name: string;
  schedule: string;
  start_date: string;
  end_date: string;
  number_students: number;
  created_at?: string;
  updated_at?: string;
  pivot?: CoursePivot
}

export interface CoursePivot {
  student_id: number;
  course_id: number;
  id: number;
}
