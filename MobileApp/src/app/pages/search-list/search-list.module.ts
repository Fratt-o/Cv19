import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SearchListPageRoutingModule } from './search-list-routing.module';

import { SearchListPage } from './search-list.page';
import { StructureDetailComponent } from '../structure-detail/structure-detail.component';
import {ModalLoginComponent} from '../../shared/component/modalLogin/modalLogin.component';
import {ModalFiltersComponent} from '../filters/modalFilters/modalFilters.component';
import {FiltersComponent} from '../filters/filters.component';


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SearchListPageRoutingModule,
    // SharedModule
  ],
  entryComponents: [FiltersComponent],
  declarations: [SearchListPage, StructureDetailComponent, ModalLoginComponent, ModalFiltersComponent, FiltersComponent]
})
export class SearchListPageModule {}
