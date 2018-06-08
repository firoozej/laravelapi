# Laravel-based Api Acting As a Graphql Server

- [Laravel](https://github.com/laravel/laravel).
- [Laravel GraphQL](https://github.com/Folkloreatelier/laravel-graphql).

## Structure
Working codes are defined as services instead of controllers (Look in Services Folder)

## Note
You need to Add below lines to vendor\folklore\graphql\src\Folklore\GraphQL\GraphQLController.php After $headers = config('graphql.headers', []);

$cookies = Cookie::getQueuedCookies();
foreach($cookies as $key => $cookie) {
    $headers['set-cookie'] = $cookie->__toString();
}

## License
licensed under the [MIT license](https://opensource.org/licenses/MIT).
