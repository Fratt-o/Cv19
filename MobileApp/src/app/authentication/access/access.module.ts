import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';
import { RegisterComponent } from './register/register.component';
import { AccessPage } from './access.page';
import { AccessPageRoutingModule } from './access-routing.module';
import {ModalRegisterComponent} from '../../shared/component/modalRegister/modalRegister.component';
import {HttpClientModule} from '@angular/common/http';
import { SharedModule } from 'src/app/shared/shared.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AccessPageRoutingModule,
    HttpClientModule,
    SharedModule
  ],
  declarations: [AccessPage, RegisterComponent, ModalRegisterComponent]
})
export class AccessPageModule {}
