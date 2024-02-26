import { AxiosResponse } from "axios"
import { ApiRequest } from "./ApiRequest"
import { ICoord } from "../store/superadminCoords";
import { IProgramCategoryForm } from "../store/superadminProgramCategory";

export default {
    getSuperadminStudents() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/students');
    },
    deleteSuperadminStudent(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/student/${userId}/delete`);
    },
    activateUserAccount(userId : string | number) {
        return ApiRequest.put(`/sa/user/${userId}/activate`);
    },
    deactivateUserAccount(userId : string | number) {
        return ApiRequest.put(`/sa/user/${userId}/deactivate`);
    },
    getSuperadminCoords() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/coords');
    },
    storeSuperadminCoords(data : ICoord) : Promise<AxiosResponse> {
        return ApiRequest.post('/sa/coords', data);
    },
    deleteSuperadminCoord(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/coords/${userId}/delete`);
    },

    getAllPrograms() : Promise<AxiosResponse> {
        return ApiRequest.get(`/sa/programs`);
    },
    storeProgram(data : any) : Promise<AxiosResponse> {
        return ApiRequest.post(`/sa/programs`, data);
    },
    updateProgram(data : any, programId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.put(`/sa/program/${programId}`, data);
    },
    deleteProgram(programId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/program/${programId}`);
    },

    getAllProgramCategories() : Promise<AxiosResponse> {

        return ApiRequest.get('/sa/program-categories');
    },
    storeProgramCategory(data : IProgramCategoryForm) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/program-categories`, data);
    },
    updateProgramCategory(data : IProgramCategoryForm, categoryId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/program-categories/${categoryId}/update`, data);
    },
    deleteProgramCategory(categoryId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/program-categories/${categoryId}/delete`);
    }
}