## Bootstrap
Each page that uses the navbar must have Bootstrap loaded in the HEAD tag. This means loading the Bootstrap CSS file, the dropdown CSS file, and a JS file:

```html
<!-- Bootstrap core CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/dropdown.css" rel="stylesheet">

<!-- Custom styles for the current page go here -->

<script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
```
The reason this isn't just included in navbar.php is the navbar is loaded after the HEAD tag and any custom styles won't override the Bootstrap styles if they're loaded before them. 

If you're using Bootstrap in a page then you also need to include some JS files at the end of the BODY tag:

```html
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
```

## Fonts
Some of the pages use Google Fonts. These are font files hosted by Google. To include them in a page, just link the correct CSS file URL and then set the font-family attribute in your custom CSS file. navbar.php automatically includes the two fonts it uses, so that's where those are set if you were wondering.

## Common Styles
Pretty much every page except the home page should use the same basic style. This style is in commonstyles.css and can be overriden by per-page styles for more control. All this stylesheet does right now is make the background dark gray and the text white.
