Contributing
============

## Building and deploying

How to build the book, tree, and website:

1. Update the date in `tree/tree.svg`
2. Export `assets/tree.png` and `assets/tree.pdf` from Inkscape
3. Build the book: `./book/typeset.sh`
4. Build the website: `basildon .`
5. Send to Netlify: `netlify deploy --dir output --prod`

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
itemtype: Photograph|CreativeWork|Article|DigitalDocument|ArchiveComponent|Manuscript
title: 
author: 
images:
  - commons: 
    flickr: 
    caption: 
license: pd|cc-by|copyright
date: 
date_precision: day|month|year|circa
storage_location: 
tags:
  - 
description: 
---
```
