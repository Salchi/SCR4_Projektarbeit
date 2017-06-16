<?php

namespace BusinessLogic;

use DataLayer\DiscussionDALFactory;

class DiscussionManager {
    
    const PAGE_SIZE = 5;

    private function __construct() {
        
    }

    public static function getAllPostsOnPage($pageNumber){
        return DiscussionDALFactory::getDAL()->getWithPagination(max(--$pageNumber, 0) * self::PAGE_SIZE, self::PAGE_SIZE);
    }
    
    public static function getNumberOfPages(){
        return ceil(DiscussionDALFactory::getDAL()->getNumberOfDiscussions() / self::PAGE_SIZE);
    }
    
    public static function getDiscussion($id){
        return DiscussionDALFactory::getDAL()->get($id);
    }
}
