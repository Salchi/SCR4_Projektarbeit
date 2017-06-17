<?php

namespace DataLayer;

interface CommentDAL {

    function getAllForDiscussion($discussionId);
    function getAllCommentsWithPaginationWith($searchString, $offset, $numOfElements);
    function getNumberOfCommentsWith($searchString);
    function getNewestComment();
    function get($id);
    function delete($id);
}
