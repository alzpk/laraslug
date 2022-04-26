# Laraslug
Small package that makes the use of uuid easy in laravel

### Installation

To install this package, run the following composer command, inside your laravel project.

```bash
composer require alzpk/larauuid
```

### Usage

To use this package simply use `Alzpk\Larauuid` inside your model.

**Example:**
```php
namespace App\Models;

use Alzpk\Larauuid\Larauuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Larauuid;
}
```

**Remember to use uuid on the migrations like so:**

```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('message');
            $table->timestamps();
        });
    }
```
