export interface FilterModel {
    categoria?: TipoCategoria;
    rating?: number;
    caratteristiche?: number[];
}

export type TipoCategoria = 'Ristorazione' | 'Hotel' | 'Luogo di Interesse';
