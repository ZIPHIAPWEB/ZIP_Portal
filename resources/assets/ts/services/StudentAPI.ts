import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";

export default {
    getStudentProfile() : Promise<AxiosResponse> {
        return ApiRequest.get('/student/profile');
    }
}