export interface ServerResponse {
    error?: boolean;
    data?: any;
    status?: {
        hasMoreItems: boolean;
    };
}
