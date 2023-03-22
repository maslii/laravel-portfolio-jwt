<?php

namespace App\Http\Controllers;

use App\Http\Requests\Portfolio\ShowRequest;
use App\Http\Requests\Portfolio\StoreRequest;
use App\Http\Requests\Portfolio\UpdateRequest;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\ShowPortfolioResource;
use App\Services\PortfolioService;

class PortfolioController extends Controller
{
    public function store(StoreRequest $request, PortfolioService $service)
    {
        return PortfolioResource::collection(
            $service->store($request)
        );
    }

    public function update(UpdateRequest $request, PortfolioService $service)
    {
        return PortfolioResource::collection(
            $service->update($request)
        );
    }

    public function show(ShowRequest $request, PortfolioService $service)
    {
        return ShowPortfolioResource::collection(
            $service->show($request)
        );
    }
}
