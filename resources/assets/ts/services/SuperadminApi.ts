import { AxiosResponse } from "axios"
import { ApiRequest, ApiRequestWithFile } from "./ApiRequest"
import { ICoord } from "../store/superadminCoords";
import { IProgramCategoryForm } from "../store/superadminProgramCategory";
import { ISuperadminVisaSponsor } from "../store/superadminVisaSponsor";
import { ISuperadminHostCompany } from "../store/superadminHosCompany";
import { ISuperadminSchool } from "../store/superadminSchool";
import { ISuperadminDegree } from "../store/superadminDegree";
import { ISuperadminPrelimRequirement } from "../store/superadminPrelimRequirement";
import { ISuperadminAdditionalRequirement } from "../store/superadminAdditionalRequirement";
import { ISuperadminVisaSponsorRequirement } from "../store/superadminVisaSponsorRequirement";
import { ISuperadminPaymentRequirement } from "../store/superadminPaymentRequirement";

export default {
    getSearchStudentByUsername(toBeSearch : string) : Promise<AxiosResponse> {

        return ApiRequest.get(`/sa/students?search=${toBeSearch}`);
    },
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
    resetUserPassword(userId : string | number) {
        return ApiRequest.put(`/sa/user/${userId}/reset-password`);
    },

    getSearchCoordByUsername(toBeSearch : string) : Promise<AxiosResponse> {
        
        return ApiRequest.get(`/sa/coords?search=${toBeSearch}`);
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
    },

    getAllPrelimRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get(`/sa/prelim-reqs`);
    },
    storePrelimRequirement(data: ISuperadminPrelimRequirement) : Promise<AxiosResponse> {
        
        return ApiRequest.post(`/sa/prelim-reqs`, data);
    },
    updatePrelimRequire(data: ISuperadminPrelimRequirement, prelimId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/prelim-reqs/${prelimId}/update`, data);
    },
    deletePrelimRequirement(prelimId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/prelim-reqs/${prelimId}/delete`);
    },
    uploadPrelimReqFile(file: File, prelimId: string | number | undefined) : Promise<AxiosResponse> {
        
        const formData = new FormData();
        formData.append('_method', 'put');
        formData.append('file', file);

        return ApiRequestWithFile.post(`/sa/prelim-reqs/${prelimId}/file/upload`, formData);
    },
    removePrelimReqFile(prelimId: string | number) : Promise<AxiosResponse> {
        
        return ApiRequest.put(`/sa/prelim-reqs/${prelimId}/file/remove`);
    },

    getAllAdditionalRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get(`/sa/additional-reqs`);
    },
    storeAdditionalRequirement(data: ISuperadminAdditionalRequirement) : Promise<AxiosResponse> {
        
        return ApiRequest.post(`/sa/additional-reqs`, data);
    },
    updateAdditionalRequirement(data: ISuperadminAdditionalRequirement, additionalId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/additional-reqs/${additionalId}/update`, data);
    },
    deleteAdditionalRequirement(additionalId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/additional-reqs/${additionalId}/delete`);
    },
    uploadAdditionalReqFile(file: File, additionalId: string | number | undefined) : Promise<AxiosResponse> {
        
        const formData = new FormData();
        formData.append('_method', 'put');
        formData.append('file', file);

        return ApiRequestWithFile.post(`/sa/additional-reqs/${additionalId}/file/upload`, formData);
    },
    removeAdditionalReqFile(additionalId: string | number) : Promise<AxiosResponse> {
        
        return ApiRequest.put(`/sa/additional-reqs/${additionalId}/file/remove`);
    },

    getAllVisaSponsorRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get(`/sa/sponsor-reqs`);
    },
    storeVisaSponsorRequirement(data: ISuperadminVisaSponsorRequirement) : Promise<AxiosResponse> {
        
        return ApiRequest.post(`/sa/sponsor-reqs`, data);
    },
    updateVisaSponsorRequirement(data: ISuperadminVisaSponsorRequirement, sponsorId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/sponsor-reqs/${sponsorId}/update`, data);
    },
    deleteVisaSponsorRequirement(sponsorId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/sa/sponsor-reqs/${sponsorId}/delete`);
    },
    uploadVisaSponsorReqFile(file: File, sponsorId: string | number | undefined) : Promise<AxiosResponse> {
        
        const formData = new FormData();
        formData.append('_method', 'put');
        formData.append('file', file);

        return ApiRequestWithFile.post(`/sa/sponsor-reqs/${sponsorId}/file/upload`, formData);
    },
    removeVisaSponsorReqFile(sponsorId: string | number) : Promise<AxiosResponse> {
        
        return ApiRequest.put(`/sa/sponsor-reqs/${sponsorId}/file/remove`);
    },
    
    getAllPaymentRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/payment-reqs');
    },
    storePaymentRequirement(data : ISuperadminPaymentRequirement) : Promise<AxiosResponse> {

        return ApiRequest.post(`/sa/payment-reqs`, data);
    },
    updatePaymentRequirement(data: ISuperadminPaymentRequirement, paymentId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.put(`/sa/payment-reqs/${paymentId}/update`, data);
    },
    deletePaymentRequirement(paymentId : string | number) : Promise<AxiosResponse> {

        return ApiRequest.delete(`/sa/payment-reqs/${paymentId}/delete`);
    },
}