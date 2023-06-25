import { ResponseInterface } from "@/Interfaces/response-interface";
import { Courses } from "../Course/course-interface";

export interface StudentResponse extends ResponseInterface {
  data: Students[];
}

export interface Students {
  id?: number;
  name: string;
  last_name: string;
  birth_year: string;
  age: number;
  email: string;
  created_at?: string;
  updated_at?: string;
  course?: Courses[];
}
