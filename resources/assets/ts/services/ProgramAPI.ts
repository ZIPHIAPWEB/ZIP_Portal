import { AxiosResponse } from 'axios';
import { ApiRequest } from './ApiRequest';

export default {
    getPrograms(): Promise<AxiosResponse> {
        return ApiRequest.get('/programs');
    }
}