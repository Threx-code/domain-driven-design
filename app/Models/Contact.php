<?php declare(strict_types=1);

namespace App\Models;

use App\Casts\Email;
use App\Casts\Name;
use App\Observers\ContactObserver;
use Domains\Network\ValueObjects\EmailObject;
use Domains\Network\ValueObjects\NameObject;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property NameObject first_name
 * @property NameObject last_name
 * @property NameObject middle_name
 * @property EmailObject $email
 * @property string $phone
 */

#[ObservedBy(ContactObserver::class)]
final class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'email' => Email::class,
            'first_name' => Name::class,
            'last_name' => Name::class,
            'middle_name' => Name::class,
        ];
    }

}
