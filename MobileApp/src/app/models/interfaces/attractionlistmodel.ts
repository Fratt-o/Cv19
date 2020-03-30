import {FilterModel} from './filtermodel';

export interface AttractionsListModel {
    filter?: FilterModel;
    pagination: {
        pageSize: number;
        page: number;
    };
}
