import { Component } from '@angular/core';
import { ModalController, NavController, ToastController } from '@ionic/angular';
import { RegisterComponent } from './register/register.component';
import { NgForm } from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import {AuthService} from '../../services/auth.service';
import { ValidationPatterns } from 'src/app/models/enumerations/patterns';
@Component({
  selector: 'access',
  templateUrl: './access.page.html',
  styleUrls: ['./access.page.scss']
})
export class AccessPage {
  constructor(
      private modalController: ModalController,
      private navCtrl: NavController,
      private authService: AuthService,
      private toastController: ToastController) {
  }
  validationPatterns = ValidationPatterns; 
  loginError: boolean;
  // fabio.mar@live.it
  // 1234

  //TODO: Aggiungere nell'html la validazione dell'email
  login(form: NgForm) {
    if (!form.valid) {
      return;
    }
    console.log(form);
    const email = form.controls.email.value;
    const password = form.controls.password.value;
    this.authService.login(email, password).subscribe((res) => {
      this.loginError = false;
      this.modalController.dismiss();
      this.presentToast('Login effettuato con successo', 'success');
    }, () => {
      this.loginError = true;
      this.presentToast('Login fallito', 'danger'); 
    });
  }

  dismissModal() {
    this.modalController.dismiss();
  }

  async presentToast(message: string, type: string) {
    const toast = await this.toastController.create({
      message: message,
      duration: 2000,
      color: type
    });
    toast.present();
  }
}
