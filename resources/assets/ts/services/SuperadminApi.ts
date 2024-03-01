import { AxiosResponse } from "axios"
import { ApiRequest } from "./ApiRequest"
import { ICoord } from "../store/superadminCoords";
import { IProgramCategoryForm } from "../store/superadminProgramCategory";
import { ISuperadminVisaSponsor } from "../store/superadminVisaSponsor";
import { ISuperadminHostCompany } from "../store/superadminHosCompany";
import { ISuperadminSchool } from "../store/superadminSchool";
import { ISuperadminDegree } from "../store/superadminDegree";

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
    },

    getAllVisaSponsors() : Promise<AxiosResponse> {

        return ApiRequest.get('/sa/visa-sponsors');
    },
    storeVisaSponsor(data : ISuperadminVisaSponsor) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/visa-sponsors`, data);
    },
    updateVisaSponsor(data : ISuperadminVisaSponsor, sponsorId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/visa-sponsors/${sponsorId}/update`, data);
    },
    deleteVisaSponsor(sponsorId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/visa-sponsors/${sponsorId}/delete`);
    },

    getAllHostCompanies() : Promise<AxiosResponse> {

        return ApiRequest.get('/sa/host-companies');
    },
    storeHostCompany(data : ISuperadminHostCompany) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/host-companies`, data);
    },
    updateHostCompany(data : ISuperadminHostCompany, companyId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/host-companies/${companyId}/update`, data);
    },
    deleteHostCompany(companyId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/host-companies/${companyId}/delete`);
    },

    getAllSchools() : Promise<AxiosResponse> {

        return ApiRequest.get('/sa/schools');
    },
    storeSchool(data : ISuperadminSchool) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/schools`, data);
    },
    updateSchool(data : ISuperadminSchool, schoolId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/schools/${schoolId}/update`, data);
    },
    deleteSchool(schoolId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/schools/${schoolId}/delete`);
    },

    getAllDegrees() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/degrees');
    },
    storeDegree(data : ISuperadminDegree) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/degrees`, data);
    },
    updateDegree(data: ISuperadminDegree, degreeId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/degrees/${degreeId}/update`, data);
    },
    deleteDegree(degreeId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/degrees/${degreeId}/delete`);
    }
}