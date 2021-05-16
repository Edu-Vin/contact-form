<?php

namespace App\Repositories\Contact;

use App\Contracts\Contact\ContactInterface;
use App\Entities\Contact\ContactEntity;
use App\Notifications\NewContact;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ContactRepository extends BaseRepository implements ContactInterface
{

    public function __construct(App $app)
    {
        parent::__construct($app);

    }

    public function create($data = [])
    {
        if (isset($data['attachment'])) {
            $file = $data['attachment'];
            $fileName = $file->getClientOriginalName();
            $uploadUrl = Storage::disk('local')->put('uploads', $file);
            $data['attachment'] = $uploadUrl;
            $data['fileName'] = $fileName;
        }

        $this->model->create($data);

        $data['body'] = $data['message'];
        unset($data['message']);

        Notification::route('mail', getenv('ADMIN_MAIL'))
            ->notify(new NewContact($data));

        return true;

    }

    protected function getClass(): string
    {
        return ContactEntity::class;
    }

}
