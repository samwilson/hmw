Contributing
============

## Building and deploying

How to build the book, tree, and website
(after installing Basildon with `composer install`):

1. Update the date in `tree/tree.svg`
2. Export `assets/tree.png` and `assets/tree.pdf` from Inkscape
3. Build the book: `./book/typeset.sh`
5. Build the website: `composer build`
6. Send to Netlify: `composer deploy`

## LaTeX information

Biography headers (the `Full Name` should match what's in the tree, i.e. "name at birth"):

    \biohead{Full Name}{Photo caption, if applicable.}
    \index{Last, Name For Index}

Reference a biography with:

    \bioref{File_Name}

Index entries:

    \idx{text to display and index}

Page references:

    \p{LABEL} outputs e.g. "p. 3" with an escaped space after the full stop

    \photo{filename}{Caption.}

## Tree conventions

Names: 11 pt; dates: 8 pt; all serif.

Crossing paths:

![Paths crossing](tree/path-jumping.png)

## Archive items

Items are in sequentially-numbered markdown files in `content/items/`.
A template for them is in `_item_template.md`.
