<?php


namespace App\Geneo;

use App\Models\Contact as Model;
use Illuminate\Support\Facades\Storage;

class Contact
{
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
        }

        $contact = Model::create($payload);
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

}
