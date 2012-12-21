# gravatar-chyrp
================================

gravatar-chyrp is a simple gravatar module for [Chyrp ](http://chyrp.net/) blogging engine.

Module is based on [Gravatar class ](https://github.com/muddylemon/gravatar) by Lance Kidwell. 

Usage: 

Inside your twig template

```twig
    {% if enabled_modules.gravatar %}
    <div class="author_photo">
        <img src="${ post.author.email | get_gravatar }" />
    </div>
    {% endif %}
```

After installing Module, in Chyrp admin settings you can adjust:
* Gravatar size
* Gravatar rating
* Gravatar fall-back image
* Gravatar safe connection (https)