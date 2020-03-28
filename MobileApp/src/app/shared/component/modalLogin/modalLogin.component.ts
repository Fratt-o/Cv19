import { Component } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { AccessPage } from '../../../authentication/access/access.page';
import {AuthService} from '../../../services/auth.service';

@Component({
  selector: 'modalLogin',
  templateUrl: './modalLogin.component.html',
  styleUrls: ['./modalLogin.component.scss'],
})
export class ModalLoginComponent  {

  constructor(public modalCtrl: ModalController, private authService: AuthService) { }

  async showModal() {
    const modal = await this.modalCtrl.create({
      component: AccessPage,
      backdropDismiss: true,
      cssClass: 'login-authentication',
      animated: true,
      showBackdrop: true
    });
    return await modal.present();
    }
  }



