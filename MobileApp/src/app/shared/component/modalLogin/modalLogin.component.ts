import { Component } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { AccessPage } from '../../../authentication/access/access.page';
import {AuthService} from '../../../services/auth.service';
import { PopoverController } from '@ionic/angular';
import {PopoverComponent} from '../popover/popover.component';

@Component({
  selector: 'modalLogin',
  templateUrl: './modalLogin.component.html',
  styleUrls: ['./modalLogin.component.scss'],
})
export class ModalLoginComponent  {

  constructor(public modalCtrl: ModalController,
              private authService: AuthService,
              public popoverController: PopoverController) { }

  async showModal() {
    const modal = await this.modalCtrl.create({
      component: AccessPage,
      //backdropDismiss: true,
      cssClass: 'login-authentication',
      animated: true,
      showBackdrop: true,
      swipeToClose: true,
    });
    return await modal.present();
    }

  async showPopover() {
    const popover = await this.popoverController.create({
      component: PopoverComponent,
      translucent: true,
      animated: true
    });
    return await popover.present();
  }
  }




