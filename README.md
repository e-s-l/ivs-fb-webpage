# IVS Feedback Webpage

## About:

Minimal webpage (= html table generated by php scripts) front
for Auscope's IVS Feedback summary table.

See the related repo:
https://github.com/tiegemccarthy/stationFeedbackDB

## Program:

Given the database (see the above repo) create a colour-coded table.

The colour-coding uses a very simple (at this stage) quantative assessment
method.

Otherwise, all pretty self explanatory. Some hacks for presentation (looking at
you 'Date' (actually data & time)).

Configuration file removed from upload but example given in comments.

JS used to monitor changes to the checkboxes, one of which unhides the extra
tab's (sites), while the other reloads the database without filtering for the
most important columns.


## TODO

- Create a better colouring coding method.


