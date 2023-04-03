import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";

export default {
    getSchools(): Promise<AxiosResponse> {
        return ApiRequest.get('/schools');
    }
}