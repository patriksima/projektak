<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class Helper
{
    public static function getRowClass($deadline, $status)
    {
        $class = '';

        if ($deadline != '') {
            $now = new Carbon();
            $deadline = new Carbon($deadline);
            if ($deadline < $now) {
                $class = 'mdl-color--red-100';
            }
            if ($deadline == $now) {
                $class = 'mdl-color--orange-100';
            }
        } else {
            $class = 'mdl-color-text--red-500';
        }

        switch ($status) {
            case 'Čeká se na klienta':
                $class = 'mdl-color--green-100';
                break;
            case 'Pauza':
                $class = 'mdl-color-text--grey-500';
                break;
        }

        return $class;
    }

    public static function getInboxRowClass($created)
    {
        $class = '';

        if ($created != '') {
            $now = new Carbon();
            $created = new Carbon($created);
            $interval = $created->diff($now);
            if ($interval->days < 30) {
                $class = 'mdl-color--red-200';
            }
            if ($interval->days < 7) {
                $class = 'mdl-color--red-100';
            }
            if ($interval->days == 0) {
                $class = 'mdl-color--green-100';
            }
        }

        return $class;
    }

    public static function getProjectRowClass($deadline, $status)
    {
        $class = '';

        if ($deadline != '') {
            $now = new Carbon();
            $deadline = new Carbon($deadline);
            $interval = (int) $now->diff($deadline)->format('%r%a');
            if ($interval < 0) {
                $class = 'mdl-color--red-300';
            }
            if ($interval == 0) {
                $class = 'mdl-color--red-200';
            }
            if ($interval > 1) {
                $class = 'mdl-color--red-100';
            }
            if ($interval > 7) {
                $class = 'mdl-color--orange-100';
            }
            if ($interval > 14) {
                $class = 'mdl-color--green-100';
            }
            if ($interval > 30) {
                $class = 'mdl-color--green-300';
            }
        }

        switch ($status) {
            case 'inactive':
                $class = 'mdl-color-text--grey-500';
                break;
        }

        return $class;
    }

    public static function getOrderByClass($column)
    {
        $class = 'sortable';

        $orderBy = Input::get('orderBy', 'created_at');
        $orderDir = Input::get('orderDir', 'desc');

        if ($orderBy == $column) {
            if ($orderDir == 'asc') {
                $class .= ' mdl-data-table__header--sorted-ascending';
            } else {
                $class .= ' mdl-data-table__header--sorted-descending';
            }
        }

        return $class;
    }

    public static function getOrderDir($column)
    {
        $dir = 'desc';

        $orderBy = Input::get('orderBy', 'created_at');
        $orderDir = Input::get('orderDir', 'desc');

        if ($orderBy == $column) {
            if ($orderDir == 'asc') {
                $dir = 'desc';
            } else {
                $dir = 'asc';
            }
        }

        return $dir;
    }
}
