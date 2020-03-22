The H.M. Wilson Archives
========================

Genealogical research about the ancestors of the children of H. Margaret Wilson
and and the descendents of her grandparents.

For more information, please contact [Sam Wilson](https://samwilson.id.au/).

## Building and deploying

How to build the book, tree, and website:

1. Update the date in `tree/tree.svg`
1. Export `assets/tree.png` and `assets/tree.pdf` from Inkscape
2. Build the book: `./book/typeset.sh`
1. Send to Netlify: `netlify deploy --dir output --prod`

## LaTeX information

Biography headers:

	\biohead{Full Name}{Photo caption, if applicable.}

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

```
---
template: item
title: 
author: 
image: 
license: pd|cc-by
date: 
date_precision: day|month|year|circa
storage_location: 
tags:
  - 
---
```
