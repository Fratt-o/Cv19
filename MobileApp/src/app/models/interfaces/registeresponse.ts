import {RegisterModel} from './registermodel';

export interface RegisterResponse {
    error: boolean;
    register?: RegisterModel;
    error_msg?: string;
}
