<?php

namespace App\Http\Responders\Coinbase;

use App\Domain\Collections\Utils\GoalCollection;
use Illuminate\Http\Request;

class GoalsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(
        GoalCollection $goalCollection
    ) {
        return view(
            'goals.index',
            [
                'goalCollection' => $goalCollection
            ]
        );
    }
}
