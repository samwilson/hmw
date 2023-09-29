Contributing
============

## Building and deploying

How to build the book, tree, and website
(after installing Basildon with `composer install`):

1. Update the date in `tree/tree.svg`
2. Export the tree and build the website: `composer build`
3. Send to Netlify: `composer deploy`

## Tree conventions

Names: 11 pt; dates: 8 pt; all serif.

Crossing paths:

![Paths crossing](tree/path-jumping.png)

## Archive items

Items are in sequentially-numbered markdown files in `content/items/`.
A template for them is in `_item_template.md`.
