#!/bin/bash

cd $(dirname $0)

#pdflatex main
#makeindex main
##bibtex main
#pdflatex main
#pdflatex main

latexmk

#latex main
#dvipdf main.dvi
#dvips -o Main.ps Main.dvi
#ps2pdf Main.ps
#rm *.dvi *.log *.aux *.toc

mv main.pdf ../assets/book.pdf

convert -resize 100x100 ../assets/book.pdf[0] ../assets/book_titlepage.png
