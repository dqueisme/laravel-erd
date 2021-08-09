<?php

namespace Kevincobain2000\LaravelERD\Controllers;

use Route;
use Closure;
use Kevincobain2000\LaravelERD\LaravelERD;
use Illuminate\Routing\Controller;

class LaravelERDController extends Controller
{
    private $laravelERD;

    public function __construct(LaravelERD $laravelERD)
    {
        $this->laravelERD = $laravelERD;
    }

    public function index()
    {
        $namespace       = config('laravel-erd.namespace') ?? 'App\Models\\';
        $modelsPath      = config('laravel-erd.models_path') ?? base_path('app/Models');
        $linkDataArray   = $this->laravelERD->getLinkDataArray($namespace, $modelsPath);
        $nodeDataArray   = $this->laravelERD->getNodeDataArray($namespace, $modelsPath);

        // pretty print array to json
        $docs = json_encode(
            [
                "link_data" => $linkDataArray,
                "node_data" => $nodeDataArray,
            ],
            JSON_PRETTY_PRINT
        );
        return view('erd::index')->with(compact('docs'));
    }

}
