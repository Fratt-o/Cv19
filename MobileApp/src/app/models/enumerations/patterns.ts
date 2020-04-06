export  class ValidationPatterns {
    static email: string = '^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$';
    static password: string = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$';
    static username: string = '^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$';
}