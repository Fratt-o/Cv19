import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { Observable, of, throwError, forkJoin} from 'rxjs';
import {Review, Structure} from '../models/class/structure';
import {catchError, map} from 'rxjs/operators';
import {environment} from '../../environments/environment';
import {AttractionsListModel} from '../models/interfaces/attractionlistmodel';
import {Caratteristica} from '../models/interfaces/caratteristica';
import {ServerResponse} from '../models/interfaces/serverResponse';

@Injectable({
  providedIn: 'root'
})

export class RetrieverService {

  constructor( private httpClient: HttpClient)  { }

  hasMoreAttractions = true;

  getAttractions(model: AttractionsListModel): Observable<Structure[]> {
      const url = `${environment.apiBaseUrl}/Struttura/read.php`;
      return this.httpClient.post<ServerResponse>(url, model).pipe(
          map((res: ServerResponse) => {
              this.hasMoreAttractions = res.status.hasMoreItems;
              if (!res.error) {
                  return res.data;
              } else {
                  return [];
              }
          }),
        map((strutture: Structure[]) => {
          return strutture.map( str => new Structure(str));
        })
    );
  }

  structureDetail(id: number): Observable<Structure> {
      const url =  `${environment.apiBaseUrl}/Struttura/detail.php?idStruttura=${id}`;
      
      

      const structureDetail = this.httpClient.get<ServerResponse>(url);
      
    return forkJoin([structureDetail,this.getReviews(id)]).pipe(
      map(([structureRes, reviews]) => {
        if(!structureRes.error) {
          if(structureRes.data) {
            const structure = new Structure(structureRes.data);
            structure.reviews = reviews;
            return structure;
          } else {
            throwError(new Error('Nessuna struttura trovata'));
          }
        } else {
          throwError(new Error('Si è verificato un errore'));
        }

        
      })
    )
  }

    getReviews(idStruttura: number): Observable<Review[]> {
      const url =  `${environment.apiBaseUrl}/Recensioni/read.php?idStruttura=${idStruttura}`;
      return this.httpClient.get<ServerResponse>(url).pipe(
            map((reviewsRes) => {
              if(!reviewsRes.error) {
                return (reviewsRes.data || []).map(review => new Review(review));
              } else {
                return [];
              }
            }),
            catchError(() => {
              return of([]);
            })
        );
    }

  getCaratteristiche(): Observable<Caratteristica[]> {
      return this.httpClient.get<any>(`${environment.apiBaseUrl}/Caratteristiche/read.php`).pipe(
          map( (res: any) => {
              if (res.error !== true) {
                  return res.data;
              } else {
                  return [];
              }
          }),
          catchError((err) => {
            return of([]);
          })
      );
  }

}
