import { Component } from '@angular/core';
import {ModalController, NavController} from '@ionic/angular';
import {AuthService} from '../../../services/auth.service';
import {NgForm} from '@angular/forms';
import {RegisterModel} from '../../../models/interfaces/registermodel';
import { PhotoService } from 'src/app/services/photo.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent {

  constructor(private modalController: ModalController,
              private navCtrl: NavController,
              private authService: AuthService,
              public photoService: PhotoService) {}
  error = false;
  photo: any;
  photoBase64: any;
  async register(form: NgForm) {
    if (!form.valid) {
      return;
    }
    console.log(form);
    const nome = form.controls.name.value;
    const cognome = form.controls.surname.value;
    const email = form.controls.email.value;
    const password = form.controls.password.value;
    const username = form.controls.username.value;

    const imageFile = await fetch(this.photo.webPath).then(r => r.blob());

    const formData = new FormData();
    formData.append('email', email);
    formData.append('nome', nome);
    formData.append('password', password);
    formData.append('cognome', cognome);
    formData.append('username', username);
    formData.append('file', imageFile, `${email}.jpg`);
    const registerModel: RegisterModel = {
      email,
      nome,
      password,
      cognome,
      username,
      avatar: imageFile
    };
    this.error = false;
    this.authService.register(formData).subscribe((registrationOk: boolean) => {
      // Se registrationOk = true, allora error deve essere false; e viceversa
      this.error = !registrationOk;
      if (!this.error) {
        this.modalController.dismiss();
      }
    });

    
  }

  async takePhoto() {
    this.photo = await this.photoService.takePhoto();
    this.photoBase64 = await this.photoService.toBase64(this.photo.webPath);
  }

  async pickFromGallery() {
    this.photo = await this.photoService.pickFromGallery();
    this.photoBase64 = await this.photoService.toBase64(this.photo.webPath);
  }
}


