<?php

namespace BusinessLogic;

use DataLayer\CommentDALFactory;

class CommentManager {
    const PAGE_SIZE = 5; 
    
    public static function getAllCommentsOnPageWith($searchString, $pageNumber){
        return CommentDALFactory::getDAL()->getAllCommentsWithPaginationWith($searchString, max(--$pageNumber, 0) * self::PAGE_SIZE, self::PAGE_SIZE);
    }
    
    public static function getNumberOfComments($searchString){
        return CommentDALFactory::getDAL()->getNumberOfCommentsWith($searchString);
    }
    
    public static function getNewestComment(){
        return CommentDALFactory::getDAL()->getNewestComment();
    }
}
