import csv
with open('STOCKTAKESHEET.txt', 'r') as in_file:
    stripped = (line.strip() for line in in_file)
    lines = (line.split("\t") for line in stripped if line)
    with open('STOCKTAKESHEET.csv', 'w',newline='\n') as out_file:
        writer = csv.writer(out_file)
        writer.writerows(lines)

