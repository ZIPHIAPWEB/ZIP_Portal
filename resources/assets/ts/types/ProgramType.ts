import { ProgramCategoryType } from "./ProgramCategoryType"

export type ProgramType = {
    id: number,
    name: string,
    display_name: string,
    description: string,
    category: ProgramCategoryType | null
}