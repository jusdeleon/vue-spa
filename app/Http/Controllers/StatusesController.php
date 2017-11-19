<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\User;

class StatusesController extends Controller
{
	public function index()
	{
		return Status::with('user')->latest()->get();
	}

	public function store()
	{
		$status = User::first()->statuses()->create(request()->only(['body']));

		return $status->load('user');
	}
}
