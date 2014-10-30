pdflatex main
makeindex main
#bibtex main
pdflatex main
pdflatex main

#latex main
#dvipdf main.dvi
#dvips -o Main.ps Main.dvi
#ps2pdf Main.ps
#rm *.dvi *.log *.aux *.toc

cp main.pdf ../hmw-pages/book.pdf
