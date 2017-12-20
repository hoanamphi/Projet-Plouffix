# Flash : A jQuery plugin for flash messages #
`jq-flash` is a lightweight jQuery plugins that aims to give you access to minimalistic and stylish flash messages.
What do I mean by "flash messages" ? These are, typically, the kind of messages displayed to the user when they successfully achieve an action (ex: "You are now logged in").

## How to install jq-flash ? ##
1. Grab the library :
	-  `npm install --save jq-flash`
	- download zip from [github](https://github.com/Voltra/jq-flash)
2. Set up the stylesheets in the following order :
	1.  reset stylesheet (it is recommended to use the given reset.css)
	2.  `dist/flash.css`
3. Load the JS dependencies in the following order :
	1. jQuery
4. Load the jQuery plugin
	- node : `require("path/to/jq-flash")(/*jQuery*/);`
	- load via AMD/UMD
	- script tag
        
        **WARNING**
        The actual library is in {installation path}/dist/
  
## How to use jq-flash ? ##
`jq-flash` is quite straight forward, you can either use it dynamically or statically (or even both :O).

### Static usage ###
To use a flash message statically, use the following structure (first in body tag, stack them if needed):
```html
<div class="flash flash-folded">
    <p>Your message here</p>
    <button class="flash-close">&#x2716;</button>
</div>
<!-- note that &#x2716; is a nice ✖ that fits perfectly-->
```

### Dynamic usage ###
You can trigger a new flash message using jQuery:
```javascript
$.flash("my message", "my_type");
```

This will insert at the top of the body tag the following structure:
```html
<div class="flash flash-folded flash-my_type">
    <p>my message</p>
    <button class="flash-close">&#x2716;</button>
</div>
```
And will automatically unfold it to please your eyes!

### For both usage ###
Note that, whenever you close the flash message, there's a delay of 2s before it is removed from the DOM.
As you can see, you can use custom classes to define a number of additional CSS rules.

## How to customize jq-flash ? ##
You might have noticed that `$.flash(message, ?type)` needs a message but also authorizes you to pass along a type that is actually used to construct a class name : with `x` as your type, the generated class name is `flash-x`.

You can then use a custom rule to modify the colors of the flash message (there are already two examples, `flash-success` and `flash-failure`):
```css
.flash-x{
  --flash-bg: pink;
  --flash-textColor: yellow;
  --flash-boxShadow: unset;
  --flash-textShadow: 10px 10px #00ff00;
}
```

`jq-flash` comes with 3 built-in settings : the default one (no type specified), `flash-success` and `flash-failure` (a very basic demo is included).

***WARNING: *** If you modify any other CSS property (like transition for instance), you might need to use the keyword `!important` to prioritize your modified version.

## Is it responsive my good sir ? ##
If you use it as intended (at the very top of the body tag) then yes it is completely responsive, the text breaks on a new line if there would be overflow on the x-axis and the paragraph becomes scrollable if there's too much text for it to handle.

## Q&A ##
This section is empty for now, feel free to ask any questions, they might end up here :D!

## Show time ! ##
`jq-flash` is really handy if you use something like Slim+SlimViews+Twig for you back-end !
For instance, here is my general purpose `flash.twig` file:
```
{% if flash.global %}
    <div class="flash flash-folded">
        <p>{@ flash.global @}</p>
        <button class="flash-close materialShadow">&#x2716;</button>
    </div>
{% endif %}

{% if flash.success %}
<div class="flash  flash-folded flash-success">
    <p>{@ flash.success @}</p>
    <button class="flash-close materialShadow">&#x2716;</button>
</div>
{% endif %}

{% if flash.failure %}
<div class="flash  flash-folded flash-failure">
    <p>{@ flash.failure @}</p>
    <button class="flash-close materialShadow">&#x2716;</button>
</div>
{% endif %}
```
This allows me to use `$app->flash("failure", "Incorrect password")` and gets the job done in no time !

## Personnal recommendations ##
I'd like to emphatize on the fact that this plugin was conceived to be used with Roboto (built-in for most browsers) and the special character `&#x2176;`.

I'll probably drop a new CSS library called `material-shadows` (this part will be updated once released) that will allow you to use a variety of different inset shadows for your flash messages, I pulled out the best one yet for this plugin ;)!

An interesting behavior is that they stack on top of each other, which is pretty nice with dem shadows :3 !