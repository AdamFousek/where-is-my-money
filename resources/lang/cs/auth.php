<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Tyto údaje nejsou v naší databázi.',
    'password' => 'Nesprávné heslo.',
    'throttle' => 'Příliš mnoho pokusů o přihlášení. Zkuste to prosím za :seconds vteřin.',

    'errorMessage' => 'Omlouváme se, něco je špatně.',

    'confirm' => [
        'description' => 'Prosím, potvrďte Vaše heslo pro přístup do aplikace.',
        'confirm' => 'Potvrdit',
        'password' => 'Heslo',
    ],

    'forgot' => [
        'description' => 'Zapomněli jste heslo? Není problém, stačí napsat Váš email a my Vám milerádi pošleme odkaz na resetování hesla.',
        'email' => 'E-mail',
        'send' => 'Odeslat odkaz pro reset hesla',
    ],

    'login' => [
        'email' => 'Emailová adresa',
        'password' => 'Heslo',
        'remember' => 'Zapamatovat si mě',
        'forgot' => 'Zapomenuté heslo?',
        'login' => 'Přihlásit se',
    ],

    'register' => [
        'username' => 'Uživatelské jméno',
        'email' => 'Emailová adresa',
        'password' => 'Heslo',
        'confirmPassword' => 'Potvrzení hesla',
        'already' => 'Již jste registrován?',
        'register' => 'Zaregistrovat',
    ],

    'reset' => [
        'email' => 'Emailová adresa',
        'password' => 'Heslo',
        'confirmPassword' => 'Potvrzení hesla',
        'reset' => 'Resetovat heslo',
    ],

    'twoFactor' => [
        'description' => 'Potvrďte přístup ke svému účtu zadáním ověřovacího kódu poskytnutého vaší aplikací ověřovatele.',
        'recoveryDescription' => 'Potvrďte přístup do svého účtu zadáním jednoho ze svých nouzových kódů pro obnovení.',
        'code' => 'Autorizační kód',
        'codeBtn' => 'Použít obnovovací kód',
        'recoveryCode' => 'Obnovovací kód',
        'recoveryCodeBtn' => 'Použít autorizační kód',
        'login' => 'Přihlásit se',
    ],

    'verify' => [
        'verifyDescription' => 'Děkujeme za přihlášení! Než začnete, mohli byste ověřit svou e-mailovou adresu kliknutím na odkaz, který jsme vám právě poslali e-mailem? Pokud jste e-mail neobdrželi, rádi vám zašleme další.',
        'verifySent' => 'Na e-mailovou adresu, kterou jste uvedli při registraci, byl odeslán nový ověřovací odkaz.',
        'repeat' => 'Poslat odkaz znovu',
        'logout' => 'Odhlásit se'
    ]
];
