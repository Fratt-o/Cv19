export class User {
    nome?: string;
    cognome?: string;
    password?: string;
    username?: string;
    email?: string;
    isAdmin?: number;
    avatar?: string;

    constructor(utente: User) {
        this.nome = utente.nome;
        this.cognome = utente.cognome;
        this.password = utente.password;
        this.username = utente.username;
        this.avatar = utente.avatar;
        this.isAdmin = utente.isAdmin;
        this.email = utente.email;
    }
}
