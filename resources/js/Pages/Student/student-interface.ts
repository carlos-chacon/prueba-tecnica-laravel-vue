import { Response } from "@/interfaces/response-interface";

export interface StudentResponse extends Response {
  data: Students[];
}

export interface Students {
  id: number;
  name: string;
  last_name: string;
  birth_year: string;
  email: string;
  created_at: string;
  updated_at: string;
}
