import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { Observable, of} from 'rxjs';
import { Structure} from '../models/structure';
import { map} from 'rxjs/operators';
import {environment} from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})

export class RetrieverService {

  constructor( private httpClient: HttpClient)  { }

  hasMoreAttractions = true;
  attractionSelector(nomeLuogo: string): Observable<Structure[]> {
    return this.httpClient.get<Structure[]>('http://localhost:3000/point-of-interests?name_like=' + nomeLuogo);
  }

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
    return this.httpClient.get<Structure>('http://localhost:3000/point-of-interests/' + id).pipe(
        map((struttura) => {
            return new Structure(struttura);
        })
    );
  }

}

export interface StructureResponse {
    error: boolean;
    data: any;
    status: {
        hasMoreItems: boolean;
    };
}

export interface AttractionsListModel {
    filter?: FilterModel;
    pagination: {
        pageSize: number;
        page: number;
    };
}

export interface FilterModel {
    categoria?: TipoCategoria;
    caratteristiche?: number[];
}

export enum EnumCategorie {
    Ristorante = 'Ristorante',
    Hotel = 'Hotel',
    Attrazioni = 'Luogo di Interesse'
}

export type TipoCategoria = 'Ristorante' | 'Hotel' | 'Luogo di Interesse';

