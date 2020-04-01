import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { Observable, of} from 'rxjs';
import {Reviews, Structure} from '../models/class/structure';
import {catchError, map} from 'rxjs/operators';
import {environment} from '../../environments/environment';
import {AttractionsListModel} from '../models/interfaces/attractionlistmodel';
import {Caratteristica} from '../models/interfaces/caratteristica';
import {StructureResponse} from '../models/interfaces/structureresponse';

@Injectable({
  providedIn: 'root'
})

export class RetrieverService {

  constructor( private httpClient: HttpClient)  { }

  hasMoreAttractions = true;

  getAttractions(model: AttractionsListModel): Observable<Structure[]> {
      const url = `${environment.apiBaseUrl}/Struttura/read.php`;
      return this.httpClient.post<StructureResponse>(url, model).pipe(
          map((res: StructureResponse) => {
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
      //const url =  `${environment.apiBaseUrl}/Recensioni/detail.php?idStruttura=${idStruttura}`;
    return this.httpClient.get<Structure>('http://localhost:3000/point-of-interests/' + id).pipe(
        map((struttura) => {
            return new Structure(struttura);
        })
    );
  }

    getReviews(idStruttura: number): Observable<Reviews[]> {
      const url =  `${environment.apiBaseUrl}/Recensioni/read.php?idStruttura=${idStruttura}`;
      return this.httpClient.get<Reviews[]>(url).pipe(
            map((reviews) => {
                return reviews.map(review => new Reviews(review));
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
