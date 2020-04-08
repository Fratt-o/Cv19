export  class ValidationPatterns {
    static email: string = '^(?=[a-zA-Z0-9][a-zA-Z0-9@._%+-]{5,253}$)[a-zA-Z0-9._%+-]{1,64}@(?:(?=[a-zA-Z0-9-]{1,63}\.)[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*\.){1,8}[A-Za-z]{2,63}$';
    static password: string = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$'; //almeno un carattere minuscolo, uno maiuscolo e un numero, minimo 8 caratteri
    static username: string = '^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{3,}$';
}