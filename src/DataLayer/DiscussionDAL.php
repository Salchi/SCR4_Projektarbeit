<?php

namespace DataLayer;

interface DiscussionDAL {

    function getWithPagination($from, $to);
    function getNumberOfDiscussions();
    function get($id);
}
