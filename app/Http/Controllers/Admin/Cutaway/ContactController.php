<?php

namespace App\Http\Controllers\Admin\Cutaway;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminContactCreateRequest;
use App\Http\Requests\AdminContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $paginator = (new Contact())->select()->paginate(10);

        return view('admin.cutaway.contacts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.cutaway.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminContactCreateRequest $request)
    {
        $data = $request->input();

        $data['logo'] = $request->file('logo')->store('logo');

        $item = (new Contact())->create($data);

        if ($item) {
            return redirect()
                ->route('admin.cutaway.contacts.show', $item->id)
                ->with(['success' => 'Контакт добавлен']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $item = Contact::findOrFail($id);

        return view('admin.cutaway.contacts.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $item = Contact::findOrFail($id);

        return view('admin.cutaway.contacts.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminContactUpdateRequest $request, $id)
    {
        $item = Contact::find($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена."])
                ->withInput();
        }

        $data = $request->all();

        $urlImg = $item->logo;

        if (isset($data['logo'])) {
            $urlImg = $request->file('logo')->store('logo');
        }

        $data['logo'] = $urlImg;

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.cutaway.contacts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = Contact::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.cutaway.contacts.index')
                ->with(['success' => "Пользователь с id[$id] удален"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
