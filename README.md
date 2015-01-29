# SimpleATF ( Simple Acceptance Testing Framework )

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/taskforcedev/SimpleATF?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/taskforcedev/SimpleATF.svg?branch=master)](https://travis-ci.org/taskforcedev/SimpleATF)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/taskforcedev/SimpleATF/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/taskforcedev/SimpleATF/?branch=master) [![Code Climate](https://codeclimate.com/github/taskforcedev/SimpleATF/badges/gpa.svg)](https://codeclimate.com/github/taskforcedev/SimpleATF)

Project Status: In Development / Alpha

## Installation

To install SimpleATF simply clone the repo and follow the instructions on screen which will take you through migrating your database and registering your user account.

By default the application will use sqlite but please feel free to configure your own database by changing the file app/config/database.php

## Tests

Currently Implemented Tests

- hasText: This tests that the text specified exists anywhere on the page.
- hasStatusCode: Test if the http status code for the page is as expected.
- hasJson: This tests the json key exists and that it's value matches the requirements.
- hasJsonKey: This tests only that the json key exists.

Tests Currently In Development

- idHasTest: 


## Feedback

For feature requests or suggestions please raise an issue on github.

For code improvements please feel free to raise a pull request with the altered code and any Comments on how the improvements will benefit the project. 