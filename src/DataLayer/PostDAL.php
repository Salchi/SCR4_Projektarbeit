<?php

namespace DataLayer;

interface PostDAL {

    function getWithPagination($from, $to);
}
