<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PublisherDataTable;

class PublisherController extends Controller
{
    public function index(PublisherDataTable $dataTable)
    {
        return $dataTable->render('publish-master');
    }
}
