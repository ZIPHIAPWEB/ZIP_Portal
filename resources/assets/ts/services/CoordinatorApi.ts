import { AxiosResponse } from "axios"
import { ApiRequest } from "./ApiRequest"

export default {
    getSelectedStudent(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-selected-student/${userId}`);
    },

    getCoordStudents(program : string | string[]) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-students?program=${program}`);
    },

    getFilteredCoordStudents(program : string | string[], from : string, to : string, status : string) : Promise<AxiosResponse> {
        let forFilter = ``;

        if (!(from == '' || from == null)) {
            forFilter += `&from_date=${from}`;
        }

        if (!(to == '' || to == null)) {
            forFilter += `&to_date=${to}`
        }

        if (!(status == '' || to == null)) {
            forFilter += `&status=${status}`
        }
        
        return ApiRequest.get(`/coord/get-students?program=${program}` + forFilter);
    },

    getPaginatedResult(page : number, program : string | string[], from : string, to : string, status : string) {
        let forFilter = ``;

        if (!(from == '' || from == null)) {
            forFilter += `&from_date=${from}`;
        }

        if (!(to == '' || to == null)) {
            forFilter += `&to_date=${to}`
        }

        if (!(status == '' || to == null)) {
            forFilter += `&status=${status}`
        }
        
        return ApiRequest.get(`/coord/get-students?page=${page}&program=${program}` + forFilter);
    },

    updateStudentProgram(userId : string | number, programId : number | string) : Promise<AxiosResponse> {

        return ApiRequest.put(`/coord/update-student-program/${userId}`, { programId: programId });
    }
}