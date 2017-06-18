<?php

namespace BusinessLogic;

use DataLayer\CommentDALFactory;
use BusinessLogic\PrivilegeManager;
use Domain\Comment;

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
    
    public static function getComment($id){
        return CommentDALFactory::getDAL()->get($id);
    }
    
    public static function deleteComment($comment){
        if (PrivilegeManager::isAuthenticatedUserOriginator($comment->getOriginator())) {
            CommentDALFactory::getDAL()->delete($comment->getId());
        }
    }
    
    public static function addComment($discussionId, $text){
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd()){
            CommentDALFactory::getDAL()->add(new Comment(-1, $discussionId, AuthentificationManager::getAuthenticatedUser()->getUsername(), $text, date('Y-m-d H:i:s')));
        }
    }
}
