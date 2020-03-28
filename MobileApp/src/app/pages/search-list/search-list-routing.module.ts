import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {StructureDetailComponent} from '../structure-detail/structure-detail.component';
import { SearchListPage } from './search-list.page';

const routes: Routes = [
  {
    path: '',
    component: SearchListPage
  },
  {
    path: 'details/:id',
    component: StructureDetailComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SearchListPageRoutingModule {}
