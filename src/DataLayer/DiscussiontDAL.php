<?php

namespace DataLayer;

interface DiscussionDAL {

    function getWithPagination($from, $to);
}
