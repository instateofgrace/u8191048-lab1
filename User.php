<?php 
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User
{
    
    public function __construct(public int $id,  public string $name, public string $email, public string $password, public DateTime $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive(array(
            'message' => 'ID must be a positive number'
        )));
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => '{{ value }} is not a valid email address.'
        )));
        $metadata->addPropertyConstraint('name', new Assert\Length(array(
            'min'        => 6,
            'minMessage' => 'Name length must be greater than 6',
        )));
        $metadata->addPropertyConstraint('password', new Assert\Length(array(
            'min'        => 8,
            'minMessage' => 'Password length must be greater than 8',
        )));
    }

    public function getCreatedAsString(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}

