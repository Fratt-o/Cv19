import { Component } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { AccessPage } from '../../../authentication/access/access.page';
import {RegisterComponent} from '../../../authentication/access/register/register.component';

@Component({
  selector: 'modalRegister',
  templateUrl: './modalRegister.component.html',
  styleUrls: ['./modalRegister.component.scss'],
})
export class ModalRegisterComponent  {

  constructor(public modalCtrl: ModalController) { }
  async showModal() {
    const modal = await this.modalCtrl.create({
      component: RegisterComponent,
      backdropDismiss: true,
      cssClass: 'login-authentication',
      animated: true,
      showBackdrop: true
    });
    return await modal.present();
    }
  }



