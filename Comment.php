<?php
require 'User.php';

class Comment
{
    
    public function __construct(public User $user, public string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getCommentHTML(): string
    {
        return "
            Registered: {$this->user->getCreatedAsString()}
            <br>
            {$this->text}
        ";
    }
} 
