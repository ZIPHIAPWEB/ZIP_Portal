import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";

export default {
    getDegrees(): Promise<AxiosResponse> {
        return ApiRequest.get('/degrees');
    }
}