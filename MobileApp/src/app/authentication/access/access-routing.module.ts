import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {RegisterComponent} from './register/register.component';
import { AccessPage } from './access.page';
import {StructureDetailComponent} from '../../pages/structure-detail/structure-detail.component';

const routes: Routes = [
  {
    path: '',
    component: AccessPage
  },
  {
    path: 'register',
    component: RegisterComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AccessPageRoutingModule {}
