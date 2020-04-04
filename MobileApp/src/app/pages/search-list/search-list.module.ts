import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SearchListPageRoutingModule } from './search-list-routing.module';

import { SearchListPage } from './search-list.page';
import { StructureDetailComponent } from '../structure-detail/structure-detail.component';
import {ModalLoginComponent} from '../../shared/component/modalLogin/modalLogin.component';
import {ModalFiltersComponent} from '../filters/modalFilters/modalFilters.component';
import {FiltersComponent} from '../filters/filters.component';
import {SharedModule} from '../../shared/shared.module';
import {PopoverComponent} from '../../shared/component/popover/popover.component';
import { ReviewFormComponent } from '../structure-detail/review-form/review-form.component';
import { HttpClientModule } from '@angular/common/http';


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    IonicModule,
    SearchListPageRoutingModule,
    SharedModule,
    HttpClientModule
  ],
  entryComponents: [FiltersComponent, PopoverComponent],
  declarations: [SearchListPage, StructureDetailComponent, ModalLoginComponent, ModalFiltersComponent, FiltersComponent, PopoverComponent, ReviewFormComponent]
})
export class SearchListPageModule {}
