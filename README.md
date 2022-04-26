# Laraslug
Small package that makes it easy to create slug for laravel models

### Installation

To install this package, run the following composer command, inside your laravel project.

```bash
composer require alzpk/laraslug
```

### Usage

To use this package simply use `Alzpk\Laraslug` inside your model.

**Example:**
```php
namespace App\Models;

use Alzpk\Laraslug\Laraslug;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Laraslug;
}
```

**The example above expects your model to have at least one of each columns listed below:**

_Slug column (the column name, which should hold the slug value):_
- slug

_Slug value column (the column name, which holds the value that should be slugged):_
- title
- name

### Advanced usage

If you want to customize one or more of the columns, and perhaps want a prefix for the slug, you can make use of these variables, inside your model:
- Custom slug column: `private string $slugColumn`
- Custom slug value column: `private string $slugValueColumn`
- Add prefix to the slug: `private string $slugPrefix`

**Example:**

Here we have an example of a migration and model, called `Post` that has the columns `subject` and `uri`.

```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('uri');
            $table->timestamps();
        });
    }
```

To make the slug work now we simply have to add `private string $slugColumn` and `private string $slugValueColumn` to the model.

```php
namespace App\Models;

use Alzpk\Laraslug\Laraslug;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Laraslug;
    
    private string $slugColumn = 'uri';
    private string $slugValueColumn = 'subject';
}
```

**Prefix:**

If we want to add a prefix to our slug, we just need to add `private string $slugPrefix` to our model.

```php
namespace App\Models;

use Alzpk\Laraslug\Laraslug;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Laraslug;
    
    private string $slugPrefix = 'prefix';
}
```

This would then make a slug like so "prefix-VALUE".
