import { AxiosResponse } from "axios"
import { ApiRequest, ApiRequestWithFile } from "./ApiRequest"
import { IVisaSponsor } from "../store/studentVisaSponsor";
import { IVisaInterview } from "../store/studentVisaInterview";
import { IStudentPdosCfoSchedule } from "../store/studentPdosCfoSchedule";

export default {
    acknowledgeStudentPayment(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/student/${userId}/payment/${requirementId}`);
    },

    downloadExportedData(program : string[] | string, status: string, from : string, to : string) : Promise<AxiosResponse> {
        return ApiRequest.post(`/coord/export-student`, { program, status, from, to });
    },

    getSelectedStudent(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-selected-student/${userId}`);
    },
    
    //Student Prelim Req
    getSelectedStudentPrelimRequirement(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/preliminary`);
    },

    uploadSelectedStudentPrelimRequirement(userId : string | number, requirementId : string | number | undefined, file : File) : Promise<AxiosResponse> {
        
        let formData = new FormData();
        formData.append('file', file);

        return ApiRequestWithFile.post(`/coord/student/${userId}/preliminary/${requirementId}`, formData);
    },

    downloadSelectedStudentPrelimRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/preliminary/${requirementId}`);
    },

    removeSelectedStudentPrelimRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/coord/student/${userId}/preliminary/${requirementId}`);
    },

    //Student Additional Req
    getSelectedStudentAdditionalRequirement(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/additional`);
    },

    uploadSelectedStudentAdditionalRequirement(userId : string | number, requirementId : string | number | undefined, file : File) : Promise<AxiosResponse> {
        
        let formData = new FormData();
        formData.append('file', file);

        return ApiRequestWithFile.post(`/coord/student/${userId}/additional/${requirementId}`, formData);
    },

    downloadSelectedStudentAdditionalRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/additional/${requirementId}`);
    },

    removeSelectedStudentAdditionalRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/coord/student/${userId}/additional/${requirementId}`);
    },

    //Student visa sponsor req
    getSelectedStudentVisaSponsorRequirement(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/sponsor`);
    },

    uploadSelectedStudentVisaSponsorRequirement(userId : string | number, requirementId : string | number | undefined, file : File) : Promise<AxiosResponse> {

        let formData = new FormData();
        formData.append('file', file);

        return ApiRequestWithFile.post(`/coord/student/${userId}/sponsor/${requirementId}`, formData);
    },

    downloadSelectedStudentVisaSponsorRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/sponsor/${requirementId}`);
    },

    removeSelectedStudentVisaSponsorRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/coord/student/${userId}/sponsor/${requirementId}`);
    },

    getSelectedStudentPaymentRequirement(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/payment`);
    },

    downloadSelectedStudentPaymentRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/student/${userId}/payment/${requirementId}`);
    },

    removeSelectedStudentPaymentRequirement(userId : string | number, requirementId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.delete(`/coord/student/${userId}/payment/${requirementId}`);
    },

    getSelectedStudentHostInfo(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-student-host-info/${userId}`);
    },

    getSelectedStudentInterviewInfo(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-student-interview-info/${userId}`);
    },

    getSelectedStudentPdosCfoInfo(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-student-pdos-cfo-info/${userId}`);
    },

    getSelectedStudentFlightDetails(userId : string | number) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-student-flight-info/${userId}`);
    },

    getCoordStudents(program : string | string[]) : Promise<AxiosResponse> {
        return ApiRequest.get(`/coord/get-students?program=${program}`);
    },

    getCoordStudentsStats(program? : string) : Promise<AxiosResponse> {
        let forFilter = ``;

        if (!(program == '' || program == undefined)) {
            forFilter += `?program=${program}`
        }

        return ApiRequest.get(`/coord/get-statistics${forFilter}`);
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

    getSearchStudentLastName(program : string | string[], toBeSearch : string) {

        return ApiRequest.get(`/coord/get-students?program=${program}&search=${toBeSearch}`);
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
    },

    updateStudentProgramStatus(userId : string | number, status : string) : Promise<AxiosResponse> {

        return ApiRequest.put(`/coord/update-student-program-status/${userId}`, { status: status});
    },

    updateStudentProgramCompliance(userId : string | number, status : string) : Promise<AxiosResponse> {

        return ApiRequest.put(`/coord/update-student-program-compliance/${userId}`, { status : status});
    },

    updateStudentHostInfo(userId : string | number, data : IVisaSponsor) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/update-student-host-info/${userId}`, data);
    },

    updateStudentInterviewInfo(userId : string | number, data : IVisaInterview) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/update-student-interview-info/${userId}`, data);
    },

    updateStudentPdosCfoInfo(userId : string | number, data : IStudentPdosCfoSchedule) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/update-student-pdos-cfo-info/${userId}`, data);
    },

    updateStudentFlightInfo(userId : string | number, data : any) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/update-student-flight-info/${userId}`, data);
    },

    cancelStudentStatus(userId : string | number, data: any) : Promise<AxiosResponse> {
        return ApiRequest.put(`/coord/cancel-student/${userId}`, { reason: data});
    }
}