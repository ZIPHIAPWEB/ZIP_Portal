import { IProgram } from "./IProgram";

export interface IProgramCategory {
    id: number | string;
    name: string;
    display_name: string;
    description: string;
    programs: IProgram[]
}