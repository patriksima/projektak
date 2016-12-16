<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Public discussion endpoint.
     *
     * @param  string  $resource
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function public($resource, $id)
    {
        $channel = $resource.'.'.$id;

        return view('discussion.index', compact('channel'));
    }

    /**
     * Internal discussion endpoint.
     *
     * @param  string  $resource
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function internal($resource, $id)
    {
        $channel = $resource.'.'.$id.'.internal';

        return view('discussion.index', compact('channel'));
    }
}
