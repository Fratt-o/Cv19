import { Component } from '@angular/core';
import {ModalController, NavController} from '@ionic/angular';
import {AuthService, RegisterModel} from '../../../services/auth.service';
import {NgForm} from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent {

  constructor(private modalController: ModalController,
              private navCtrl: NavController,
              private authService: AuthService) {}
  error = false;
  register(form: NgForm) {
    if (!form.valid) {
      return;
    }
    console.log(form);
    const nome = form.controls.name.value;
    const cognome = form.controls.surname.value;
    const email = form.controls.email.value;
    const password = form.controls.password.value;
    const username = form.controls.username.value;

    const registerModel: RegisterModel = {
      email,
      nome,
      password,
      cognome,
      username
    };
    this.error = false;
    this.authService.register(registerModel).subscribe((registrationOk: boolean) => {
      // Se registrationOk = true, allora error deve essere false; e viceversa
      this.error = !registrationOk;
      if (!this.error) {
        this.modalController.dismiss();
      }
    });
  }
}
