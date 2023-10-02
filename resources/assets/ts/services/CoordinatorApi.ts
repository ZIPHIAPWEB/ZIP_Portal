import { AxiosResponse } from "axios"
import { ApiRequest } from "./ApiRequest"

export default {
    getCoordStudents() : Promise<AxiosResponse> {
        return ApiRequest.get('/coord/get-students');
    }
}