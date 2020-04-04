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
    reviews?: Review[];

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

export class Review {
    id?: string;
    title?: string;
    name ?: string;
    email?: string;
    text?: string;
    rating?: number;
    avatar?: string;

    constructor(recensione: any) {
        this.title = recensione.titolo;
        this.name = recensione.nomeMostrato;
        this.text = recensione.testo;
        this.rating = recensione.voto;
        this.email = recensione.fkutente;
        this.avatar = recensione.avatar;
    }
}
