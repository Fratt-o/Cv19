import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import * as jwt_decode from 'jwt-decode';
import {User} from '../models/class/user';
import {Observable, of} from 'rxjs';
import {catchError, map, tap} from 'rxjs/operators';
import {RegisterResponse} from '../models/interfaces/registeresponse';
import {RegisterModel} from '../models/interfaces/registermodel';
import {LoginResponse} from '../models/interfaces/loginresponse';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  currentUser: User;
  constructor(private httpClient: HttpClient) { }

  isAuthenticated(): boolean {
    return this.currentUser !== undefined;
  }

  login(email: string, password: string): Observable<LoginResponse> {
    const url = `${environment.apiBaseUrl}/${environment.apiLoginUrl}`;
    return this.httpClient.post<LoginResponse>(url, {
      email,
      password
    }).pipe(
        // Tap significa 'fai qualcosa prima di restituire l'observable al sottoscrittore
        tap((risposta: LoginResponse) =>  {
          this.saveCurrentUser(risposta.jwt);
          localStorage.setItem('token', risposta.jwt);
        })
    );
  }

  register(registerModel: FormData): Observable<boolean> {
    const url = `${environment.apiBaseUrl}/${environment.apiRegisterUrl}`;
    return this.httpClient.post<RegisterResponse>(url, registerModel).pipe(
        map((risposta: RegisterResponse) => {
          if (!risposta) {
            return false;
          }
          // Error = false -> Registrazione andata a buon fine
          return !risposta.error;
        }),
        catchError(() => {
          return of(false);
        })
    );

  }

  logout(): void {
    localStorage.removeItem('token');
    this.currentUser = undefined;
  }

  getUsername(): string {
    return this.currentUser.username;
  }

  /*getUsername(): string {
    return this.currentUser.avatar;
  }*/

  saveCurrentUser(jwt: string): void {
    const jwtDecodificato =  jwt_decode(jwt);
    this.currentUser = new User({
      username: jwtDecodificato.data.username,
      email: jwtDecodificato.data.email
      // avatar: jwtDecodificato.data.avatar
    });
  }

  checkCurrentUser(): void {
    const jwt = localStorage.getItem('token');
    if (jwt !== null)  {
      this.saveCurrentUser(jwt);
    }
  }

}
