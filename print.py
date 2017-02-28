#!/usr/bin/python
# print.py
# Written by Brennan Macaig for SteamScout
# Copyright (C) Brennan Macaig and Concord Robotics 2017
#
# print.py takes in one argument (a file path) and prints that file.
# It returns nothing useful, and can't check the status of a print.
# This is because prints in Linux are simply written to a directory with no "spooler".
# This code can't check the status of the print because there is none reported.
import os
from pathlib import Path
import time

_pName = "" # The system name of the printer (fetch using http://superuser.com/questions/177445/how-to-list-printer-names-acceptable-for-use-with-lpr)


# Print a file to the printer
# Cannot know if there was an error while printing.
# It just tries it's best.
def printFile(s):
    os.system("lpr -P " + _pName + " " + s)

# The main function
# Checks number of arguments and then runs printFile
def main():
    args = sys.argv[1:]
    if (len(args) > 1) or (len(args) == 0):
        # Error out, more than one argument
        print("This program only takes exactly one argument - a path to a file.\nPlease check your syntax and try again.")
        return
    else
        someFile = Path(str(args[0]))
        if someFile.is_file():
            # It's a file, print it
            printFile(args[0])
        else:
            print("Argument is not a file.\nPlease check your syntax and try again.")
            return
