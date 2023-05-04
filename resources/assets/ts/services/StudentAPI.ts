import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";
import { PersonalType } from "../types/PersonalType";
import { ContactType } from "../types/ContactType";
import { TertiaryType } from "../types/TertiaryType";
import { SecondaryType } from "../types/SecondaryType";
import { ParentType } from "../types/ParentType";
import { ExperienceType } from "../types/ExperienceType";

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
        return ApiRequest.put('/student/profile/update-tertiary', data);
    },

    updateSecondaryDetails(data: SecondaryType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/profile/update-secondary', data);
    },

    updateFatherDetails(data: ParentType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/profile/update-father', data);
    },

    updateMotherDetails(data: ParentType) : Promise<AxiosResponse> {
        return ApiRequest.put('/student/profile/update-mother', data);
    },

    storeWorkExperience(data: ExperienceType) : Promise<AxiosResponse> {
        return ApiRequest.post('/student/add-work-experience', data);
    },

    updateWorkExperience(data: ExperienceType) : Promise<AxiosResponse> {
        return ApiRequest.put(`/student/${data.id}/update-work-experience`, data);
    },

    deleteWorkExperience(id?: number | string) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/student/${id}/delete-work-experience`);
    }
}