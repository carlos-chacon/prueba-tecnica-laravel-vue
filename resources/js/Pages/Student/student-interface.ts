import { ResponseInterface } from "@/Interfaces/response-interface";

export interface StudentResponse extends ResponseInterface {
  data: Students[];
}

export interface Students {
  id?: number;
  name: string;
  last_name: string;
  birth_year: string;
  email: string;
  created_at?: string;
  updated_at?: string;
}
