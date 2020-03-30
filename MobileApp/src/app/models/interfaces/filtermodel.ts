export interface FilterModel {
    categoria?: TipoCategoria;
    caratteristiche?: number[];
}

export type TipoCategoria = 'Ristorazione' | 'Hotel' | 'Luogo di Interesse';
