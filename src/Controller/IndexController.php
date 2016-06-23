<?php
/**
 * Maverick Base
 *
 * @author Alec Carpenter <aleccarpenter@quickenloans.com>
 */
declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class IndexController extends AbstractController
{
    protected function doAction()
    {
        $this->render('index', [
            'handlerLocation' => __FILE__
        ]);
    }
}
