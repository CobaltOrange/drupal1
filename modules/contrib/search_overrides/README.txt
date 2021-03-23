CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

This module provides a method for users with the necessary permissions to
manually override the results being returned by Search API Solr. They will be
able to choose a specific search term, and pick which nodes should be at the
top, and also choose to exclude nodes so they will not be shown in the results.
Currently only nodes are supported.

Also note that using this module will cause Solr to ignore the contents of an
elevate.xml file for the core, if one is use.


INSTALLATION
------------

The search_overrides module is installed like any Drupal module in D8. Multiple
methods are possible, but installation via composer is recommend, especially
sites where Drupal was installed via composer.

Simply change into Drupal directory and use composer to install:

cd $DRUPAL
composer require drupal/search_overrides


REQUIREMENTS
------------

This module requires the following modules:

 * Search API (https://www.drupal.org/project/search_api)
 * Search API Solr (https://www.drupal.org/project/search_api_solr)


CONFIGURATION
-------------

 * Configure user permissions in Administration » People » Permissions:

   - Administer Search overrides

     Broad permission to create, edit, and delete all search overrides.

   - Create new Search overrides

     Create a new override entity, which defines what will appear as the top
     results for a given query, or be omitted from the results.

   - Delete Search overrides

     Delete an existing override entity.

   - Edit Search overrides

     Edit an existing override entity.

 * Manage override entities in Administration » Configuration »
   Search and metadata » Search overrides.

 * Manage override settings in Administration » Configuration »
   Search and metadata » Search overrides  » Search overrides settings. Go here
   to provide the path of your search view results page and the URL parameter of
   the fulltext exposed filter. Once this is done, the search overrides listing
   page will have additional actions to view modified or unmodified results for
   the specified query.

   Within this page, you can also specify what content will be used within the
   autocomplete to select content to promote or exclude, using the "Content to
   select from" field. The default is "Select from nodes", which will look for
   matches of the provided string within the title of all nodes in the system.

   If you choose "Select from a search index", you will see an addtiional field
   which you can use to specify which Solr index will be queried. In this mode
   the provided string runs a real-time search against the specified index. The
   benefit to this approach is that all content in the index can be used to
   promote or exclude (including taxonomy terms and media entities, for example)
   and no nodes that are excluded from search (for example, because of content
   type or publish state) can be chosen.

 * This module also adds a field to the node edit form, to give an editor the
   ability to promote or sxclude the node for particular search queries.


MAINTAINERS
-----------

 * Current Maintainer: Martin Anderson-Clutz (mandclu) - https://www.drupal.org/users/mandclu
