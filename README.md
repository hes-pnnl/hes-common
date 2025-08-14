HES Common
==========
This project is the home of PHP code that is used in multiple Home Energy Score projects.
Any classes and functions that are identical in both applications should be moved into
this repository so that duplication can be eliminated and code maintenance simplified.

The project is a Composer package, and you can add it to a project as a dependency by
adding the project repository to your composer.json:

    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/hes-pnnl/hes-common.git"
        }
    ]
    
You must then also add a dependency to the Composer package to your requirements list:

    "require": {
        ...
        "pnnl/hes-common": "~1.0",
        ...
    }

Exceptions/
-----------
It is good practice to throw custom exception classes whenever doing so makes error
handling more graceful, for example by providing categories of exceptions that have
similar characteristics and can likely be handled similarly. Any custom exception
classes that are shared between multiple Home Energy Score projects go in this folder.

Helpers/
--------
Static (as opposed to services, which are stateful) utility classes that collect functions
related to some model or task. For example, the EmailHelper provides utility functions 
associated with generating and sending email.

Basically, if you have logic that doesn't properly belong in a model, repository, or 
controller class, it probably belongs in a Service or a Helper. By HES conventions, helpers
are static (they are never instantiated, their methods are static, you should never use
$this in them), and services are stateful.

Models/
-------
Data container classes, usually but not always representing a database record. The convention
in Home Energy Score is for all model class properties to be private or protected, with
access provided by getter and fluent setter methods.

Services/
---------
Instantiated (as opposed to helpers, which are not) utility classes that collect functions
related to some model or task. For example, the BuildingService provides a collection of
utility functions related to working with the Building model class.

Basically, if you have logic that doesn't properly belong in a model, repository, or 
controller class, it probably belongs in a Service or a Helper. By HES conventions, services 
are stateful (they are instantiated, their methods are non-static, you are allowed to use 
$this in them), and helpers are not.