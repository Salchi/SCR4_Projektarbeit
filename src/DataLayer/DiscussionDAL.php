<?php

namespace DataLayer;

interface DiscussionDAL {

    function getWithPagination($offset, $numOfElements);
    function getNumberOfDiscussions();
    function get($id);
    function delete($id);
}
