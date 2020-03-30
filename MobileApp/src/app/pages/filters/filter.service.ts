import { Injectable } from '@angular/core';
import {FilterModel} from '../../models/interfaces/filtermodel';


@Injectable({
  providedIn: 'root'
})
export class FilterService {

  private filter: FilterModel;
  constructor() { }

  saveFilter(filter: FilterModel) {
    this.filter = filter;
  }

  removeFilter(): void {
    this.filter = undefined;
  }

  getFilter(): FilterModel {
    return this.filter;
  }

  hasFilter(): boolean {
    return this.filter !== undefined;
  }
}
