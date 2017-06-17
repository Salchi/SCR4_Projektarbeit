<?php

namespace BusinessLogic;

use DataLayer\DiscussionDALFactory;
use BusinessLogic\PrivilegeManager;
use Domain\Discussion;

class DiscussionManager {

    const PAGE_SIZE = 5;

    private function __construct() {
        
    }

    public static function getAllPostsOnPage($pageNumber) {
        return DiscussionDALFactory::getDAL()->getWithPagination(max(--$pageNumber, 0) * self::PAGE_SIZE, self::PAGE_SIZE);
    }

    public static function getNumberOfPages() {
        return ceil(DiscussionDALFactory::getDAL()->getNumberOfDiscussions() / self::PAGE_SIZE);
    }

    public static function getDiscussion($id) {
        return DiscussionDALFactory::getDAL()->get($id);
    }

    public static function deleteDiscussion($discussion) {
        if (PrivilegeManager::isAuthenticatedUserOriginator($discussion->getOriginator())) {
            DiscussionDALFactory::getDAL()->delete($discussion->getId());
        }
    }
    
    public static function addDiscussion($name){
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd()){
            DiscussionDALFactory::getDAL()->add(new Discussion(-1, $name, 
                    AuthentificationManager::getAuthenticatedUser()->getUsername(), array()));
        }
    }

}
