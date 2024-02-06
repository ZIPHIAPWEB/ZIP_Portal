import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";

export default {
    getAllHostCompanies() : Promise<AxiosResponse> {
        return ApiRequest.get(`/host-companies`);
    }
}