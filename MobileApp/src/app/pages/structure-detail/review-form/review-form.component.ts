import { Component, OnInit, Input } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ServerResponse } from 'src/app/models/interfaces/serverResponse';

@Component({
  selector: 'app-review-form',
  templateUrl: './review-form.component.html',
  styleUrls: ['./review-form.component.scss'],
})
export class ReviewFormComponent implements OnInit {

  form: FormGroup;
  rating: number;
  @Input() idStruttura: number;
  reviewSent = false;
  constructor(private formBuilder: FormBuilder, private httpClient: HttpClient) {
    this.form = this.formBuilder.group({
      title: ['', Validators.required],
      description: [''],
      username: [false]
    });
   }

  ngOnInit() {}

  sendReview() {
    if(this.form.invalid) {
      return;
    }
    const data = {
      titolo: this.form.get('title').value,
      testo: this.form.get('description').value,
      mostraUsername: this.form.get('username').value,
      voto: this.rating,
      struttura: this.idStruttura
    }
    const url =  `${environment.apiBaseUrl}/Recensioni/writerecensione.php`;
    const headers = {
      headers: {
        'Authorization': `Bearer ${this.retrieveJWT()}`
      }
    }
    this.httpClient.post(url, data, headers).subscribe((res: ServerResponse) => {
      if(!res.error){
        this.form.reset();
        this.reviewSent = true;
        setTimeout(() => {
          this.reviewSent = false;
        }, 5000);
      } else {

      }
    }, (err) => {

    });
  }

  setRating(val: number) {
    this.rating = val;
  }

  retrieveJWT() {
    return localStorage.getItem('token');
  }
}
