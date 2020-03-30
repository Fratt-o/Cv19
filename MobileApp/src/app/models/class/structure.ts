export class Structure {
    id?: number;
    name?: string;
    description?: string;
    rating?: string;
    image?: string;
    cap?: string;
    city?: string;
    type?: string;
    phone?: string;
    province?: string;
    address?: string;
    email?: string;
    latitude?: string;
    longitude?: string;
    reviews?: Reviews;

    constructor(struttura: any) {
        this.name = struttura.nomestruttura;
        this.id = struttura.idstruttura;
        this.description = struttura.descrizione;
        this.rating = struttura.mediavoto;
        this.cap = struttura.cap;
        this.city = struttura.citta;
        this.type = struttura.categoria;
        this.province = struttura.provincia;
        this.address = struttura.indirizzo;
        this.reviews = struttura.reviews;
        this.image = struttura.immagine;
        this.phone = struttura.telefono;
        this.latitude = struttura.latitudine;
        this.longitude = struttura.longitudine;
    }
}

export class Reviews {
    id?: string;
    title?: string;
    name ?: string;
    text?: string;
    rating?: number;

    constructor(recensione: Reviews) {
        this.id = recensione.id;
        this.title = recensione.title;
        this.name = recensione.name;
        this.text = recensione.text;
        this.rating = recensione.rating;
    }
}
