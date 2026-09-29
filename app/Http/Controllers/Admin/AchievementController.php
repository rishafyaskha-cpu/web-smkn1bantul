<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAchievementRequest;
use App\Http\Requests\Admin\UpdateAchievementRequest;
use App\Models\Achievement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AchievementController extends Controller
{
    public function index(): View
    {
        return view('admin.achievements.index', [
            'achievements' => Achievement::ordered()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.achievements.form', [
            'achievement' => new Achievement([
                'is_published' => true,
                'is_featured' => false,
            ]),
        ]);
    }

    public function store(StoreAchievementRequest $request): RedirectResponse
    {
        $achievement = Achievement::create($request->validated());

        return redirect()
            ->route('admin.achievements.index')
            ->with('status', "Prestasi \"{$achievement->title}\" berhasil dibuat.");
    }

    public function edit(Achievement $achievement): View
    {
        return view('admin.achievements.form', [
            'achievement' => $achievement,
        ]);
    }

    public function update(UpdateAchievementRequest $request, Achievement $achievement): RedirectResponse
    {
        $achievement->update($request->validated());

        return redirect()
            ->route('admin.achievements.index')
            ->with('status', "Prestasi \"{$achievement->title}\" berhasil diperbarui.");
    }

    public function destroy(Achievement $achievement): RedirectResponse
    {
        $title = $achievement->title;

        $achievement->delete();

        return redirect()
            ->route('admin.achievements.index')
            ->with('status', "Prestasi \"{$title}\" berhasil dihapus.");
    }
}
