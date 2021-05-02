<?php


namespace App\Geneo;

use App\Models\Contact as Model;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\{Mail, Storage};

class Contact
{
    private Model $model;

    public function __construct(Model $contact)
    {
        $this->model = $contact;
    }

    /**
     * Creates new contact record in table
     * @param array $payload
     * @return static|null
     */
    public static function createNewContact(array $payload): ?self
    {
        if (isset($payload['attachment'])) {
            [
                'name' => $payload['file_name'],
                'link' => $payload['file_link']
            ] = self::fileUpload($payload['attachment']);
            unset($payload['attachment']);
        }

        $contact = Model::create($payload);
        self::sendEmail($payload);
        return new static($contact);
    }

    /**
     * Upload file attachment if any
     * @param $attachment
     * @return array
     */
    public static function fileUpload($attachment): array
    {
        $name = $attachment->getClientOriginalName();
        $path = $attachment->storePublicly('public/contact/attachments');
        $link = config('app.url') . Storage::url($path);

        return [
            'name' => $name,
            'link' => $link
        ];
    }

    /**
     * Send email notification when contact is submitted
     * @param $payload
     * @return mixed
     */
    public static function sendEmail($payload)
    {
        return Mail::to(config('geneo.receiver_email'))
            ->queue(new ContactFormMail($payload));
    }

    public function getModel(): Model
    {
        return $this->model;
    }

}
