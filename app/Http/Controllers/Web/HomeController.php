<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Cinematography\Repository as Cienematographies;
use Illuminate\Contracts\View\View;

/**
 * Web home controller.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszynski99@gmail.com>
 * @version 1.0.0
 */
class HomeController extends Controller
{
    /**
     * Cinematographies repository.
     *
     * @var \App\Repositories\Cinematography\Repository
     */
    protected $cinematographies;

    /**
     * Web home controller constructor.
     *
     * @param \App\Repositories\Cinematography\Repository $cinematographies
     */
    public function __construct(Cienematographies $cinematographies)
    {
        $this->cinematographies = $cinematographies;
    }

    /**
     * Return home index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('web.home.index')->with([
            'cinematographies' => $this->cinematographies->allActive(),
        ]);
    }
}