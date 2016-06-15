<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Mail\AgentMailRequest;
use App\Http\Requests\Requests\Mail\MailPropertyToFriendRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Traits\User\UsersFilesReleaser;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    use UsersFilesReleaser;
    public $userTransformer = null;
    public $usersJsonRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->usersJsonRepo = (new UsersJsonRepoProvider())->repo();
    }

    public function mailToFriend(MailPropertyToFriendRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.mail_property_to_friend',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user['to'])->subject('Property42');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }

    public function mailAgent(AgentMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.agent_mail',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user['Email'], $user['Name'])->subject('Property42');
        });

        return redirect()->back();
    }
}
