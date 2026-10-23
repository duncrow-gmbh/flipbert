## release Infos: 
for Contao ^5.3  please use flipbert: ^2.0<br>
for Contao ^4.13 please use flipbert: ^1.7

## FlipBert | PDF Flipbook for Contao

Your PDF reader for Contao websites - FlipBert is your perfect PDF reader for your Contao website. Everything is set and maintained in the Contao backend. This is how it works: Upload the PDF in the Contao backend, generate the flipbook directly in the CMS backend and you can enter it as an element. Choose between two different designs and decide for yourself where the navigation of your PDF flip catalog should go. You also have the option of deciding whether you want to display just a flipbook or an entire PDF selection on your website.


## Upgrade notes: new icon classes (2.0.9 / 1.7.3)

Since version **2.0.9** (Contao 5) and **1.7.3** (Contao 4), FlipBert no longer ships Font Awesome or the Themify icon font. All buttons now use SVG icons from `bundles/flipbert/icons/` (Contao 4: `bundles/duncrowgmbhflipbert/icons/`).

**If you have overridden the icons in your own CSS** (e.g. `.fa-chevron-right:before { content: "…" }` or `.ti-book:before`), these selectors no longer match. Please update them to the new classes:

| Button | Old class(es) | New class |
|---|---|---|
| next / alternative next | `far fa-chevron-right` | `flipbert-icon-chevron-right` |
| previous / alternative previous | `far fa-chevron-left` | `flipbert-icon-chevron-left` |
| last page | `far fa-chevron-double-right` | `flipbert-icon-chevron-double-right` |
| first page | `far fa-chevron-double-left` | `flipbert-icon-chevron-double-left` |
| share | `fas fa-share-alt` | `flipbert-icon-share` |
| help | `ti-help-alt` | `flipbert-icon-help` |
| more | `ti-more-alt` | `flipbert-icon-more` |
| download | `far fa-file-download` | `flipbert-icon-file-download` |
| zoom in | `far fa-search-plus` | `flipbert-icon-search-plus` |
| zoom out | `far fa-search-minus` | `flipbert-icon-search-minus` |
| fullscreen | `far fa-expand-arrows-alt` | `flipbert-icon-expand-arrows-alt` |
| fit to screen | `ti-arrows-corner` | `flipbert-icon-arrows-corner` |
| thumbnails | `fas fa-th-large` | `flipbert-icon-th-large` |
| outline | `far fa-list` | `flipbert-icon-list` |
| close (lightbox, side menu) | `far fa-times` | `flipbert-icon-close` |
| double page | `ti-book` | `flipbert-icon-book` |
| single page | `ti-file` | `flipbert-icon-file` |
| sound | `far fa-volume` | `flipbert-icon-volume` |
| share: Facebook | `fab fa-facebook-f` | `flipbert-icon-facebook` |
| share: Google | `fab fa-google-plus-g` | `flipbert-icon-google` |
| share: Twitter / X | `fab fa-twitter` | `flipbert-icon-x-twitter` |
| share: e-mail | `far fa-envelope` | `flipbert-icon-envelope` |
| autoplay: play | `far fa-play` | `flipbert-icon-play` |
| autoplay: pause | `far fa-pause` | `flipbert-icon-pause` |
| outline tree toggle | Themify glyph on `.df-outline-toggle:before` | unchanged selector, now an SVG |

Other changes that may affect custom CSS:

- The generic classes `far`, `fas`, `fab` are no longer set on the buttons. Each button now has exactly **one** icon class.
- The icon is drawn in `:before` as a CSS mask filled with `currentColor`. To change the color, set `color` on the button, just like before.
- The rule for `.df-ui-btn.svg-inline--fa` has been removed.
- If your website relied on FlipBert to load Font Awesome or Themify for other elements, you now have to include these fonts yourself.

**Use your own icon:** replace the mask image of the class:

```css
.flipbert-icon-chevron-right:before {
    -webkit-mask-image: url("/files/my-theme/icons/arrow-right.svg");
    mask-image: url("/files/my-theme/icons/arrow-right.svg");
}
```

**Use your own icon font instead:** remove the mask and set the glyph again:

```css
.flipbert-icon-chevron-right:before {
    -webkit-mask-image: none;
    mask-image: none;
    background: none;
    width: auto;
    height: auto;
    font-family: "My Icon Font";
    content: "\e001";
}
```

## Infos: 

https://flipbert.at
