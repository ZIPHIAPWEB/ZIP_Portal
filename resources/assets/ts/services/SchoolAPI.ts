import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";
import { SchoolType } from "@/types/SchoolType";

export default {
    getSchools(): Promise<AxiosResponse<SchoolType[]>> {
        return ApiRequest.get('/schools');
    }
}