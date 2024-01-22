import { AxiosResponse } from "axios"
import { ApiRequest } from "./ApiRequest"

export default {
    getSuperadminStudents() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/students');
    },
    activateUserAccount(userId : string | number) {
        return ApiRequest.put(`/sa/user/${userId}/activate`);
    },
    deactivateUserAccount(userId : string | number) {
        return ApiRequest.put(`/sa/user/${userId}/deactivate`);
    },
    getSuperadminCoords() : Promise<AxiosResponse> {
        return ApiRequest.get('/sa/coords');
    }
}