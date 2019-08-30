=== Diviner Archive ===
Contributors: graemehoffman
Tags: archive,fields,search
Requires at least: 5.0
Tested up to: 5.2.1
Requires PHP: 7.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Set up a basic archive. Manage your meta data. Add video or audio or photos as needed. Rejoice.


== Description ==
DIVINER is a free and open-source Wordpress plugin for small to mid-size institutions with public archiving needs. DIVINER 1.0 is a digital platform built for archiving, organizing, and presenting large amounts of photographs, audio, video, and documents - or all four! DIVINER might be right for your organization if you have a collection of humanities materials you would like to share with the public (for example, a collection of 3,000 photographs of a large farm in the early 1900s; or thousands of audio clips and interviews related to immigration in Wisconsin).

We plan to have future releases, and are currently working with organizations, big AND small, from around the United States to populate their own installations of DIVINER. Check back soon for examples of how people are using DIVINER for their own projects - from historical photo archives to special projects on immigration in the US!

This plugin creates a new Archive Item content type with an admin interface for adding meta fields. The fields can be of several different flavors: Text, Date, Advanced Custom Field, Taxonomy, and Select. During the initial setup you set up these fields and config them. Once setup is complete you can start adding archive items as documents, photos, videos, audio, or mixed format with all your intended meta information. Each archive item single page displays the main media elements before the content and then all the meta field data after the content.

The plugin also provides a shortcode ([diviner_browse_page]) which can be added to any page and which generates a responsive real time multifacet search experience for exploring your archive. This Browse experience includes a search bar, and sorting options, as well as search facets per each field. Search returns are updated in real time and appear in a paginated grid the facets.

To improve performance, this plugin is designed to work well with the ElasticPress plugin.


== Installation ==
1) Download and activate plugin.
2) Go to Diviner General Settings to add permissions statement to the bottom all archive Items
3) Go to Diviner Manager Fields to set up meta fields to be associated with your archive items (ex: Photographer Name)
4) Create Archive Items
5) Navigate to the your archive items and view the meta fields and feature media (image, audio, video, document)


== Frequently Asked Questions ==
= Why use a Text field?  =

Use text fields for information you wish to assign to each archive item. Example: serial number, catalog number, internal title, secondary description etc.

= Why use a Date field?  =

Use a date field if you would like your audience to be able to filter by a date range, by year, decade, or by century. Ex: if you want to sort a collection of a thousand photos from the 20th century into decades.

= Why use a Select field?  =

Use a select field to assign a piece of information that comes from a very small list of pre-set choices to each of your archive item. Examples: Art Format, with the choices being Painting, Sculpture, or Digital.

= Why use a Advanced Custom field?  =

For categories with many choices (20+) and which you would like to be able to elaborate on and attach auxiliary information, use the Advanced Detail Field. A good example would be if you wished to sort your materials by their creator (photographer, author, etc.) – for each creator, this type of field allows you to create an “entry” for that creator. Other examples: donor, institution. Internally, this field manages what is typically called a custom post type in wordpress vernacular.

= Why use a Taxonomy field?  =

Use a taxonomy field for categories you want to sort your materials by (ex: by location, such as by county, by neighborhood, or by room in a museum). You will have to create the choices in this category (ex: by county; Clinton, Essex, Warren, and Jefferson). Taxonomy fields are best suited to a category with fewer than twenty choices, which do not need further explanation to a viewer.

= What is this modal window in browse experience =

If you check this box in the general settings, a small window appears when you click on the archive item thumbnail in the search return grid. This window provides an initial summary of the archive item details.

= What is the permissions statement =

This will appear at the bottom of each Archive Item single page. This field is intended to provide some basic information of the copyright and permissions regarding the media in your archive.

= How do I customize the display? =

There are several filters for outputting the content. They are diviner_render_document_download, diviner_render_video_oembed, diviner_render_photo, diviner_render_audio, and diviner_render_audio_oembed

= How is the data maintained in the backend? =

All field data is kept in the post meta table. Archive Single data is a custom post type.



== Screenshots ==
1. Example single archive item
2. Diviner General Settings
3. Diviner Field Management
4. Browse Experience

== Changelog ==
= 0.5 =
First release