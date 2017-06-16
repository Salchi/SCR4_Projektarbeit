<?php

namespace DataLayer;

interface CommentDAL {

    function getAllForDiscussion($discussionId);
    function getAllCommentsWithPaginationWith($searchString, $offset, $numOfElements);
    function getNumberOfCommentsWith($searchString);
}
