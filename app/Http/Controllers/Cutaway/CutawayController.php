<?php


namespace App\Http\Controllers\Cutaway;



use App\Http\Requests\UserProfileCreateRequest;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CutawayController extends BaseController
{

    /**
     * Display user profile
     *
     * @param  Request  $request
     * @param  string  $link
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $link)
    {
        $user = User::findByUsername($link);

        if ($user) {
            $canEdit = Gate::allows('edit_profile', $user->profile);
            return view('cutaway.show', compact('user', 'canEdit'));
        }

        $user = User::findByHash($link);

        if ($user->username) {
            return redirect('/' . $user->username);
        }

        if (Auth::check()) {
            return redirect('/' . Auth::user()->username);
        }

        if (!$user) {
            abort(404);
        }

        return view('auth.register')->with('hash', $user->hash);


    }

    public function edit($profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $contacts = Contact::all();
        if (!Gate::allows('edit_profile', $profile)) {
            abort(403);
        }
        return view('cutaway.edit', compact('profile', 'contacts'));
    }

    public function profile($profileId)
    {
        $profile = Profile::findOrFail($profileId);

        if (!Gate::allows('edit_profile', $profile)) {
            abort(403);
        }
        return view('cutaway.profile', compact('profile'));
    }

    public function save(UserProfileCreateRequest $request, $profileId)
    {
        $profile = Profile::findOrFail($profileId);


        if (!Gate::allows('edit_profile', $profile)) {
            abort(403);
        }


        $data = $request->all();

        if ($request->file('user_img')) {
            $data['user_img'] = $request->file('user_img')->store('user_img');
        }

        $result = $profile->update($data);

        $profile->user->fill(['username' => $data['username']]);
        $profile->user->save();

        if ($result) {
            return redirect()
                ->route('edit', $profile->id);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }


    }

    public function contacts(Request $request, $profileId)
    {
        $contacts = $request->post();
        $data = [];

        $profileId = $contacts[0]['profile_id'];
        foreach ($contacts as $key => $contact) {

            /*$update_query = "UPDATE contact_profile SET order_button = {$contact['order']}";
            \DB::statement($update_query);*/

            $data[$key]['contact_id'] = $contact['contact_id'];
            $data[$key]['profile_id'] = $contact['profile_id'];

            $data[$key]['order_button'] = $contact['order'];
            $data[$key]['link'] = $contact['link'];
            $data[$key]['text'] = $contact['text'];
            $data[$key]['slug'] = $contact['slug'];
        }


        $result = \DB::table('contact_profile')->where('profile_id', $profileId)->delete();
        if ($result) {
           $t = \DB::table('contact_profile')->insert($data);

        }
        return response()->json($data);
    }

    public function addContact(Request $request, $profileId, $contactId)
    {
        $profile = Profile::find($profileId);

        if (!Gate::allows('edit_profile', $profile)) {
            abort(403);
        }
        $data = [
            'profile_id' => $profileId,
            'contact_id' => $contactId,
            'order_button' => 0,
            'slug' => time(),
        ];
        $result = \DB::table('contact_profile')->insert($data);

        if ($result) {
            return back();
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }


    }

    public function editContact(Request $request, $profileId, $contactId)
    {
        $profile = Profile::find($profileId);

        if (!Gate::allows('edit_profile', $profile)) {
            abort(403);
        }

        $contact = \DB::table('contact_profile')->where(['profile_id' => $profileId, 'slug' => $contactId])->first();
        $contactOrigin = Contact::where('id', $contact->contact_id)->first();

        return view('cutaway.edit-contact', compact('profile', 'contact', 'contactOrigin'));
    }

    public function saveContact(Request $request, $profileId, $id)
    {
        $data = [
            'link' => $request->post('link'),
            'text' => $request->post('text'),
        ];

        $result = \DB::table('contact_profile')->where(['profile_id' => $profileId, 'slug' => $id])->update($data);
        $profile = Profile::find($profileId);
        return redirect()->route('edit', $profile->id);


    }

    public function deleteContact(Request $request, $profileId, $id)
    {
        $result = \DB::table('contact_profile')->where(['profile_id' => $profileId, 'slug' => $id])->delete();
        $profile = Profile::find($profileId);
        return redirect()->route('edit', $profile->id);
    }

}
