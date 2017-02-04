<?php

namespace Zix\Core\Http\Controllers\Logs;

use Illuminate\Http\Request;
use Zix\Core\Libraries\LogViewer\LaravelLogViewer;
use Zix\Core\Support\Traits\ApiResponses;
use Storage;

class LogsController
{
    use ApiResponses;
    /**
     * @var LaravelLogViewer
     */
    private $logs;

    /**
     * LogsController constructor.
     * @param LaravelLogViewer $logs
     */
    public function __construct(LaravelLogViewer $logs)
    {
        $this->logs = $logs;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithData([
            'logs' => $this->logs->all(),
            'files' => $this->logs->getFiles(),
            'current_file' => $this->logs->getFileName()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}