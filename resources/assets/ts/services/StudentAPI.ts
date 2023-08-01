import { AxiosResponse } from "axios";
import { ApiRequest, ApiRequestWithFile } from "./ApiRequest";
import { PersonalType } from "../types/PersonalType";
import { ContactType } from "../types/ContactType";
import { TertiaryType } from "../types/TertiaryType";
import { SecondaryType } from "../types/SecondaryType";
import { ParentType } from "../types/ParentType";
import { ExperienceType } from "../types/ExperienceType";
import { IStudentPaymentRequirementForm } from "../store/paymentRequirement";

export default {
    getStudentProfile() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/profile');
    },

    updatePersonalDetails(data: PersonalType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-personal', data);
    },

    updateContactDetails(data: ContactType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-contact', data);
    },

    updateTertiaryDetails(data: TertiaryType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-tertiary', data);
    },

    updateSecondaryDetails(data: SecondaryType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-secondary', data);
    },

    updateFatherDetails(data: ParentType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-father', data);
    },

    updateMotherDetails(data: ParentType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/update-mother', data);
    },

    storeWorkExperience(data: ExperienceType) : Promise<AxiosResponse> {
        return ApiRequest.post('/student/add-work-experience', data);
    },

    updateWorkExperience(data: ExperienceType) : Promise<AxiosResponse> {
        return ApiRequest.put(`/student/${data.id}/update-work-experience`, data);
    },

    deleteWorkExperience(id?: number | string) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/student/${id}/delete-work-experience`);
    },

    getPaymentRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/payment-requirements');
    },

    storePaymentRequirement(requirementId: number, data: IStudentPaymentRequirementForm) : Promise<AxiosResponse> {
        let formData = new FormData();
        formData.append('bank_code', data.bank_code);
        formData.append('reference_no', data.reference_no);
        formData.append('date_deposit', String(data.date_deposit));
        formData.append('bank_account_no', data.bank_account_no);
        formData.append('amount', String(data.amount))
        formData.append('file', data.file);

        return ApiRequestWithFile.post(`/student/payment-requirement/${requirementId}/store`, formData);
    },

    removePaymentRequirement(requirementId: number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/student/payment-requirement/${requirementId}/delete`, {});
    },

    getStudentBasicRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/basic-requirements');
    },

    storeStudentBasicRequirement(requirementId : string | number | undefined, file: File) : Promise<AxiosResponse> {
        
        let formData = new FormData();
        formData.append('file', file);

        return ApiRequestWithFile.post(`/student/basic-requirement/${requirementId}/store`, formData);
    },

    deleteStudentBasicRequirement(requirementId : string | number | undefined) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/student/basic-requirement/${requirementId}/delete`);
    },

    getStudentAdditionalRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/additional-requirements');
    },

    storeStudentAdditionalRequirement(requirementId : string | number | undefined, file: File) : Promise<AxiosResponse> {
        
        let formData = new FormData();
        formData.append('file', file);
        
        return ApiRequestWithFile.post(`/student/additional-requirement/${requirementId}/store`, formData);
    },

    deleteStudentAdditionalRequirement(requirementId : string | number | undefined) : Promise<AxiosResponse> { 
        return ApiRequest.delete(`/student/additional-requirement/${requirementId}/delete`);
    },

    getStudentVisaSponsorRequirements() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/visa-sponsor-requirements');
    },

    storeStudentVisaSponsorRequirement(requirementId : string | number | undefined, file: File) : Promise<AxiosResponse> {
            
        let formData = new FormData();
        formData.append('file', file);
        
        return ApiRequestWithFile.post(`/student/visa-sponsor-requirement/${requirementId}/store`, formData);
    },

    deleteStudentVisaSponsorRequirement(requirementId : string | number | undefined) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/student/visa-sponsor-requirement/${requirementId}/delete`);
    },

    getStudentVisaSponsor() : Promise<AxiosResponse> {

        return ApiRequest.get('/student/visa-sponsor');
    },

    getStudentVisaInterviewDetails() : Promise<AxiosResponse> {

        return ApiRequest.get('/student/visa-interview-details');
    },

    getStudentPdosCfoScheduleDetails() : Promise<AxiosResponse> {

        return ApiRequest.get('/student/pdos-cfo-schedule');
    },

    getStudentFlightDetails() : Promise<AxiosResponse> {

        return ApiRequest.get('/student/flight-details');
    }
}