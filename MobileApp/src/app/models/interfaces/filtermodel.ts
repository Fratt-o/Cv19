export interface FilterModel {
    categoria?: TipoCategoria;
    rating?: number;
    nome?: string;
    caratteristiche?: number[];
}

export type TipoCategoria = 'Ristorazione' | 'Hotel' | 'Luogo di Interesse';
