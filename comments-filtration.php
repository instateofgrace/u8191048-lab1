<?php
require 'User.php';
require 'Comment.php';

$comments = [];
for ($i = 0; $i < 10; $i++) {
    $user = new User($i, "user{$i}", "user{$i}@mail.com", "password{$i}");

    $daysToSub = $i * 5;
    $user->created_at = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', strtotime("-{$daysToSub} day")));
    $comment = new Comment($user, "This is a comment with index{$i}");
    $comments[$i] = $comment;
}

$filterParam = $_GET['date_from'];
if ($filterParam === NULL) {
   $filterParam = "2022-05-28";
}
$filterParamDate = DateTime::createFromFormat('Y-m-d', $filterParam);

foreach($comments as $comment) {
    if ($comment->user->created_at >= $filterParamDate) {
        echo $comment->getCommentHTML(), '<br><br>';
    }
}
