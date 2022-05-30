<?php
require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Validator\Validation;

require 'User.php';

$validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();

function checkValidity(User $user): void {
    global $validator;

    $errors = $validator->validate($user);

    if (0 < count($errors)) {
        echo "User info is invalid<br>";
        foreach ($errors as $error) {
            echo $error->getMessage().'<br>';
        }

        echo '<hr>';
    }
    else {
        echo "User info is valid!<br><hr>";
    }
}

$validUserInfo = new User(1, "validuser", "valid@user.com", "validpass");
checkValidity($validUserInfo);

$invalidIdUserInfo = new User(-1, "invaliduser", "invalid@user.com", "invalidpass");
checkValidity($invalidIdUserInfo);

$invalidPasswordUserInfo = new User(2, "invalidpassuser", "invalidpass@user.com", "1");
checkValidity($invalidPasswordUserInfo);

$invalidEmailUserInfo = new User(3, "invalidmailuser", "invalidmailuser", "invalidmail");
checkValidity($invalidEmailUserInfo);

$completelyInvalidUserInfo = new User(-1, "in",  "inv", "inv");
checkValidity($completelyInvalidUserInfo);

