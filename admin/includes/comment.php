<?php

class Comment extends DatabaseService
{
    public $id;
    public $photoId;
    public $author;
    public $body;

    protected static $tableName = "comments";
    protected static $tableFields = ['id','photoId', 'author', 'body'];

    public static function makeComment($photoId, $author, $body)
    {
        if (!empty($photoId) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->photoId = $photoId;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    }

    public static function getComment($photoId=0)
    {

        $sql = "SELECT * FROM " . self::$tableName . " WHERE ";
        $sql .= "photoId= " . $photoId . " ORDER BY photoId ASC";

        return self::getQuery($sql);
    }
}
